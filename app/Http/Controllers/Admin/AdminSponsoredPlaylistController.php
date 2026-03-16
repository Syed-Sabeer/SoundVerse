<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BrandPartnership;
use App\Models\SponsoredPlaylist;
use App\Models\BrandCollaboration;
use App\Models\User;
use Illuminate\Http\Request;

class AdminSponsoredPlaylistController extends Controller
{
    public function partnerships(Request $request)
    {
        $query = BrandPartnership::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('partnership_type')) {
            $query->where('partnership_type', $request->partnership_type);
        }

        $partnerships = $query->latest()->paginate(20);

        return view('admin.sponsored-playlists.partnerships', compact('partnerships'));
    }

    public function createPartnership()
    {
        return view('admin.sponsored-playlists.create-partnership');
    }

    public function storePartnership(Request $request)
    {
        $validated = $request->validate([
            'brand_name' => 'required|string|max:255',
            'brand_logo' => 'nullable|image|max:5120',
            'contact_name' => 'required|string|max:255',
            'contact_email' => 'required|email',
            'contact_phone' => 'nullable|string|max:50',
            'partnership_type' => 'required|in:sponsored_playlist,feature_sponsorship,event_sponsorship,exclusive_content,other',
            'description' => 'nullable|string',
            'budget' => 'nullable|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
        ]);

        if ($request->hasFile('brand_logo')) {
            $validated['brand_logo'] = $request->file('brand_logo')->store('brand_logos', 'public');
        }

        $validated['created_by'] = auth()->id();
        $validated['status'] = 'pending';

        BrandPartnership::create($validated);

        return redirect()->route('admin.sponsored-playlists.partnerships')
            ->with('success', 'Brand partnership created successfully.');
    }

    public function playlists(Request $request)
    {
        $query = SponsoredPlaylist::with(['brandPartnership', 'curator']);

        if ($request->filled('brand_partnership_id')) {
            $query->where('brand_partnership_id', $request->brand_partnership_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $playlists = $query->latest()->paginate(20);
        $partnerships = BrandPartnership::where('status', 'active')->get();

        return view('admin.sponsored-playlists.playlists', compact('playlists', 'partnerships'));
    }

    public function createPlaylist()
    {
        $partnerships = BrandPartnership::where('status', 'active')->get();
        return view('admin.sponsored-playlists.create-playlist', compact('partnerships'));
    }

    public function storePlaylist(Request $request)
    {
        $validated = $request->validate([
            'brand_partnership_id' => 'required|exists:brand_partnerships,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'playlist_image' => 'nullable|image|max:5120',
            'curator_id' => 'nullable|exists:users,id',
            'is_featured' => 'boolean',
        ]);

        if ($request->hasFile('playlist_image')) {
            $validated['playlist_image'] = $request->file('playlist_image')->store('sponsored_playlists', 'public');
        }

        $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;
        $validated['status'] = 'draft';

        SponsoredPlaylist::create($validated);

        return redirect()->route('admin.sponsored-playlists.playlists')
            ->with('success', 'Sponsored playlist created successfully.');
    }

    public function addMusicToPlaylist(Request $request, $playlistId)
    {
        $playlist = SponsoredPlaylist::findOrFail($playlistId);

        $validated = $request->validate([
            'music_id' => 'required|exists:artist_musics,id',
            'position' => 'nullable|integer|min:0',
        ]);

        \App\Models\SponsoredPlaylistItem::updateOrCreate(
            [
                'playlist_id' => $playlistId,
                'music_id' => $validated['music_id'],
            ],
            [
                'position' => $validated['position'] ?? 0,
            ]
        );

        return back()->with('success', 'Music added to playlist successfully.');
    }

    public function collaborations(Request $request)
    {
        $query = BrandCollaboration::with(['brandPartnership', 'artist']);

        if ($request->filled('brand_partnership_id')) {
            $query->where('brand_partnership_id', $request->brand_partnership_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $collaborations = $query->latest()->paginate(20);
        $partnerships = BrandPartnership::where('status', 'active')->get();
        $artists = User::where('is_artist', true)->get();

        return view('admin.sponsored-playlists.collaborations', compact('collaborations', 'partnerships', 'artists'));
    }

    public function createCollaboration()
    {
        $partnerships = BrandPartnership::where('status', 'active')->get();
        $artists = User::where('is_artist', true)->get();
        return view('admin.sponsored-playlists.create-collaboration', compact('partnerships', 'artists'));
    }

    public function storeCollaboration(Request $request)
    {
        $validated = $request->validate([
            'brand_partnership_id' => 'required|exists:brand_partnerships,id',
            'artist_id' => 'required|exists:users,id',
            'collaboration_type' => 'required|in:exclusive_content,featured_artist,event_appearance,social_media,other',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content_url' => 'nullable|url',
            'compensation_amount' => 'nullable|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
        ]);

        $validated['status'] = 'pending';

        BrandCollaboration::create($validated);

        return redirect()->route('admin.sponsored-playlists.collaborations')
            ->with('success', 'Brand collaboration created successfully.');
    }
}
