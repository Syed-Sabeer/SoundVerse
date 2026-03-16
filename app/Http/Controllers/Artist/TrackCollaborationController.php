<?php

namespace App\Http\Controllers\Artist;

use App\Http\Controllers\Controller;
use App\Models\TrackCollaboration;
use App\Models\OwnershipSplit;
use App\Models\ArtistMusic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TrackCollaborationController extends Controller
{
    public function index()
    {
        $artistId = Auth::id();

        // Get collaborations where user is involved
        $collaborations = TrackCollaboration::whereHas('ownershipSplits', function($query) use ($artistId) {
            $query->where('artist_id', $artistId);
        })
        ->orWhere('primary_artist_id', $artistId)
        ->with(['music', 'primaryArtist', 'ownershipSplits.artist'])
        ->latest()
        ->paginate(20);

        return view('artist.collaborations.index', compact('collaborations'));
    }

    public function create($musicId)
    {
        $music = ArtistMusic::where('driver_id', Auth::id())->findOrFail($musicId);

        // Check if collaboration already exists
        if ($music->collaboration) {
            return redirect()->route('artist.collaborations.edit', $music->collaboration->id)
                ->with('info', 'This track already has a collaboration setup.');
        }

        $artists = User::where('is_artist', true)
            ->where('id', '!=', Auth::id())
            ->get();

        return view('artist.collaborations.create', compact('music', 'artists'));
    }

    public function store(Request $request, $musicId)
    {
        $music = ArtistMusic::where('driver_id', Auth::id())->findOrFail($musicId);

        // Check if collaboration already exists
        if ($music->collaboration) {
            return back()->withInput()->with('error', 'This track already has a collaboration. Please edit the existing one.');
        }

        $validated = $request->validate([
            'collaboration_type' => 'required|in:feature,collaboration,remix,producer',
            'artists' => 'required|array|min:1',
            'artists.*.artist_id' => 'required|exists:users,id',
            'artists.*.ownership_percentage' => 'required|numeric|min:0|max:100',
            'artists.*.role' => 'nullable|string|max:100',
            'artists.*.contribution_type' => 'nullable|in:vocals,instrumental,production,lyrics,composition,mixing,mastering,other',
        ]);

        // Calculate total ownership percentage
        $totalOwnership = array_sum(array_column($validated['artists'], 'ownership_percentage'));
        $primaryArtistOwnership = 100 - $totalOwnership;

        if ($primaryArtistOwnership < 0) {
            return back()->withInput()->with('error', 'Total ownership percentage cannot exceed 100%.');
        }

        DB::beginTransaction();
        try {
            // Create collaboration
            $collaboration = TrackCollaboration::create([
                'music_id' => $musicId,
                'primary_artist_id' => Auth::id(),
                'collaboration_type' => $validated['collaboration_type'],
                'total_ownership_percentage' => 100.00,
                'status' => 'pending',
            ]);

            // Add primary artist split
            OwnershipSplit::create([
                'collaboration_id' => $collaboration->id,
                'artist_id' => Auth::id(),
                'ownership_percentage' => $primaryArtistOwnership,
                'is_primary' => true,
                'approved_by_artist' => true,
                'approved_at' => now(),
            ]);

            // Add collaborator splits
            foreach ($validated['artists'] as $artistData) {
                OwnershipSplit::create([
                    'collaboration_id' => $collaboration->id,
                    'artist_id' => $artistData['artist_id'],
                    'ownership_percentage' => $artistData['ownership_percentage'],
                    'role' => $artistData['role'] ?? null,
                    'contribution_type' => $artistData['contribution_type'] ?? null,
                    'is_primary' => false,
                    'approved_by_artist' => false,
                ]);
            }

            DB::commit();

            return redirect()->route('artist.collaborations.show', $collaboration->id)
                ->with('success', 'Collaboration created successfully! Pending approval from collaborators.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Failed to create collaboration: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $collaboration = TrackCollaboration::with([
                'music', 
                'primaryArtist', 
                'ownershipSplits.artist', 
                'revenueDistributions' => function($query) {
                    $query->where('artist_id', Auth::id());
                }
            ])
            ->findOrFail($id);

            // Check if user is part of this collaboration
            $isPartOf = $collaboration->ownershipSplits->contains('artist_id', Auth::id());
            if (!$isPartOf && $collaboration->primary_artist_id !== Auth::id()) {
                abort(403, 'You are not part of this collaboration.');
            }

            // Get revenue distributions for current user
            $userRevenue = $collaboration->revenueDistributions()
                ->where('artist_id', Auth::id())
                ->latest('period_date')
                ->paginate(20);

            // Ensure we have the music relationship loaded
            if (!$collaboration->music) {
                return redirect()->route('artist.portal')
                    ->with('error', 'The track associated with this collaboration no longer exists.');
            }

            // Ensure we have the primaryArtist relationship loaded
            if (!$collaboration->primaryArtist) {
                return redirect()->route('artist.portal')
                    ->with('error', 'The primary artist for this collaboration no longer exists.');
            }

            // Debug: Log collaboration data
            \Log::info('Collaboration show page data', [
                'collaboration_id' => $collaboration->id,
                'music_id' => $collaboration->music_id,
                'music_name' => $collaboration->music->name ?? 'N/A',
                'primary_artist_id' => $collaboration->primary_artist_id,
                'primary_artist_name' => $collaboration->primaryArtist->name ?? 'N/A',
                'ownership_splits_count' => $collaboration->ownershipSplits->count(),
                'revenue_distributions_count' => $collaboration->revenueDistributions->count(),
                'user_revenue_count' => $userRevenue->count(),
                'user_id' => Auth::id()
            ]);

            return view('artist.collaborations.show', compact('collaboration', 'userRevenue'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('artist.portal')
                ->with('error', 'Collaboration not found.');
        } catch (\Exception $e) {
            \Log::error('Error loading collaboration: ' . $e->getMessage(), [
                'collaboration_id' => $id,
                'user_id' => Auth::id(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('artist.portal')
                ->with('error', 'An error occurred while loading the collaboration. Please try again.');
        }
    }

    public function approveSplit($collaborationId, $splitId)
    {
        $collaboration = TrackCollaboration::findOrFail($collaborationId);
        $split = OwnershipSplit::where('collaboration_id', $collaborationId)
            ->where('artist_id', Auth::id())
            ->findOrFail($splitId);

        $split->update([
            'approved_by_artist' => true,
            'approved_at' => now(),
        ]);

        // Check if all splits are approved and ownership is complete
        if ($collaboration->areAllSplitsApproved() && $collaboration->isOwnershipComplete()) {
            $collaboration->update([
                'status' => 'active',
                'is_verified' => true,
                'verified_at' => now(),
            ]);
        }

        return back()->with('success', 'Ownership split approved successfully!');
    }

    public function rejectCollaboration($id)
    {
        $collaboration = TrackCollaboration::findOrFail($id);

        // Check if user is a collaborator (not primary artist)
        $split = $collaboration->ownershipSplits()
            ->where('artist_id', Auth::id())
            ->where('is_primary', false)
            ->first();

        if (!$split) {
            abort(403, 'You cannot reject this collaboration.');
        }

        // Remove this artist's split
        $split->delete();

        // Update collaboration status
        if ($collaboration->ownershipSplits()->where('is_primary', false)->count() === 0) {
            $collaboration->delete();
            return redirect()->route('artist.collaborations.index')
                ->with('success', 'Collaboration rejected and removed.');
        }

        // Recalculate primary artist ownership
        $remainingTotal = $collaboration->ownershipSplits()
            ->where('is_primary', false)
            ->sum('ownership_percentage');
        $primaryOwnership = 100 - $remainingTotal;

        $primarySplit = $collaboration->ownershipSplits()->where('is_primary', true)->first();
        if ($primarySplit) {
            $primarySplit->update(['ownership_percentage' => $primaryOwnership]);
        }

        return back()->with('success', 'Collaboration rejected successfully.');
    }
}
