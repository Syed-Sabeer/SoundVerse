<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class AdminArtistController extends Controller
{
    /**
     * Display a listing of all artists.
     */
    public function index(Request $request)
    {
        $query = User::where('is_artist', true)->with('profile');

        // Filter by featured status
        if ($request->filled('featured')) {
            if ($request->featured == '1') {
                $query->where('is_featured', true);
            } else {
                $query->where('is_featured', false);
            }
        }

        // Search by name or email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%");
            });
        }

        $artists = $query->latest('created_at')->paginate(20);
        $featuredCount = User::where('is_artist', true)->where('is_featured', true)->count();
        $totalArtists = User::where('is_artist', true)->count();

        return view('admin.artists.index', compact('artists', 'featuredCount', 'totalArtists'));
    }

    /**
     * Toggle featured artist status.
     */
    public function toggleFeatured(Request $request, $id)
    {
        try {
            $artist = User::where('is_artist', true)->findOrFail($id);

            $artist->is_featured = $artist->is_featured ? 0 : 1;
            $artist->save();

            $status = $artist->is_featured ? 'featured' : 'unfeatured';
            return redirect()->back()->with('success', "Artist {$status} successfully.");
        } catch (\Exception $e) {
            Log::error('Artist featured toggle error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors('Could not update featured status.');
        }
    }
}
