<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArtistMusic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminSongController extends Controller
{
    /**
     * Display a listing of all songs with pagination.
     */
    public function index(Request $request)
    {
        $query = ArtistMusic::with('user');

        // Filter featured / non-featured
        if ($request->filled('featured')) {
            if ($request->featured === '1') {
                $query->where('is_featured', true);
            } elseif ($request->featured === '0') {
                $query->where('is_featured', false);
            }
        }

        // Simple search by name or artist name/email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($uq) use ($search) {
                        $uq->where('name', 'like', "%{$search}%")
                           ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        $songs = $query->latest('created_at')->paginate(20);

        $totalSongs = ArtistMusic::count();
        $featuredCount = ArtistMusic::where('is_featured', true)->count();

        return view('admin.songs.index', compact('songs', 'totalSongs', 'featuredCount'));
    }

    /**
     * Toggle featured flag for a song.
     */
    public function toggleFeatured(Request $request, $id)
    {
        try {
            $song = ArtistMusic::findOrFail($id);

            $song->is_featured = $song->is_featured ? 0 : 1;
            $song->save();

            $status = $song->is_featured ? 'marked as featured' : 'removed from featured';

            return redirect()->back()->with('success', "Track \"{$song->name}\" {$status}.");
        } catch (\Exception $e) {
            Log::error('Song featured toggle error', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors('Could not update featured status for this track.');
        }
    }
}

