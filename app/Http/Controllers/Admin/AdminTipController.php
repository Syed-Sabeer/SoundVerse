<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArtistTip;
use App\Models\ArtistWallet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminTipController extends Controller
{
    /**
     * Display all tips
     */
    public function index(Request $request)
    {
        $query = ArtistTip::with(['user', 'artist']);

        // Filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('artist_id')) {
            $query->where('artist_id', $request->artist_id);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $tips = $query->latest('created_at')->paginate(20);
        $artists = User::where('is_artist', true)->orderBy('name')->get();
        $users = User::where('is_artist', false)->orderBy('name')->get();

        // Statistics
        $stats = [
            'total_tips' => ArtistTip::count(),
            'total_amount' => ArtistTip::sum('amount'),
            'pending_count' => ArtistTip::where('status', 'pending')->count(),
            'sent_count' => ArtistTip::where('status', 'sent_to_artist')->count(),
            'failed_count' => ArtistTip::where('status', 'failed')->count(),
            'cancelled_count' => ArtistTip::where('status', 'cancelled')->count(),
        ];

        return view('admin.tips.index', compact('tips', 'artists', 'users', 'stats'));
    }

    /**
     * View tip details (Admin can view all tips for monitoring)
     * Note: Tips are now sent directly to artists, so this is just for viewing/history
     */
    public function show($tipId)
    {
        $tip = ArtistTip::with(['user', 'artist'])->findOrFail($tipId);
        return view('admin.tips.show', compact('tip'));
    }
}
