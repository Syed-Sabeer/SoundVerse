<?php

namespace App\Http\Controllers;

use App\Models\ArtistFollower;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArtistFollowController extends Controller
{
    /**
     * Toggle artist subscription/follow for the current user.
     */
    public function toggle(Request $request)
    {
        $request->validate([
            'artist_id' => 'required|integer|exists:users,id',
        ]);

        $user = Auth::user();
        $artistId = (int) $request->artist_id;

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'You must be logged in to subscribe to an artist.',
            ], 401);
        }

        if ($user->id === $artistId) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot subscribe to yourself.',
            ], 400);
        }

        $artist = User::where('id', $artistId)
            ->where('is_artist', true)
            ->firstOrFail();

        $existing = ArtistFollower::where('artist_id', $artistId)
            ->where('follower_id', $user->id)
            ->first();

        if ($existing) {
            $existing->delete();

            return response()->json([
                'success' => true,
                'status' => 'unsubscribed',
                'message' => 'You have unsubscribed from ' . ($artist->name ?? $artist->username ?? 'this artist') . '.',
            ]);
        }

        ArtistFollower::create([
            'artist_id' => $artistId,
            'follower_id' => $user->id,
        ]);

        // Notify artist about new subscriber
        try {
            app('notificationService')->notifyUsers(
                [$artist],
                ($user->name ?? $user->username ?? 'A user') . ' subscribed to your artist profile.',
                'New Subscriber',
                'subscription'
            );
        } catch (\Throwable $e) {
            // Fail silently – notifications are optional
        }

        return response()->json([
            'success' => true,
            'status' => 'subscribed',
            'message' => 'You are now subscribed to ' . ($artist->name ?? $artist->username ?? 'this artist') . '.',
        ]);
    }
}

