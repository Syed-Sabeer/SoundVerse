<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ArtistMusic;
use App\Models\UserCollection;
use App\Models\UserPlaylist;
use App\Models\StreamStat;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RecommendationController extends Controller
{
    /**
     * Get personalized recommendations for user
     */
    public function getRecommendations(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'You must be logged in'
                ], 401);
            }

            // Check if user has personalized recommendations feature
            if (!$user->hasUserFeature('personalized_recommendations')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Personalized recommendations are only available for Super Listener subscribers.',
                    'data' => []
                ], 403);
            }

            $limit = $request->get('limit', 10);

            // Get user's favorite artists
            $favoriteArtists = UserCollection::where('user_id', $user->id)
                ->with('music.user')
                ->get()
                ->pluck('music.driver_id')
                ->filter()
                ->unique()
                ->toArray();

            // Get user's favorite genres (from playlists and favorites)
            $favoriteGenres = $this->getUserFavoriteGenres($user->id);

            // Get recommendations based on:
            // 1. Similar artists to favorites
            // 2. Popular songs from favorite genres
            // 3. Trending songs
            $recommendations = ArtistMusic::with('user')
                ->where('is_featured', true)
                ->whereNotIn('id', UserCollection::where('user_id', $user->id)->pluck('music_id'))
                ->when(!empty($favoriteArtists), function($query) use ($favoriteArtists) {
                    // Prioritize songs from favorite artists
                    $query->whereIn('driver_id', $favoriteArtists)
                        ->orWhere(function($q) {
                            // Also include trending songs
                            $q->where('is_featured', true);
                        });
                })
                ->orderBy('listeners', 'desc')
                ->orderBy('created_at', 'desc')
                ->limit($limit)
                ->get();

            $songs = $recommendations->map(function($song) {
                return [
                    'id' => $song->id,
                    'name' => $song->name,
                    'artist' => $song->user->name ?? 'Unknown Artist',
                    'thumbnail' => $song->thumbnail_image_url,
                    'music_file' => $song->music_file_url,
                    'listeners' => $song->listeners,
                    'is_featured' => $song->is_featured,
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $songs,
                'total' => $songs->count(),
            ]);

        } catch (\Exception $e) {
            Log::error('Get recommendations error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error getting recommendations',
                'data' => []
            ], 500);
        }
    }

    /**
     * Get user's favorite genres based on listening history
     */
    private function getUserFavoriteGenres($userId)
    {
        // This is a placeholder - you can enhance this based on your genre system
        // For now, return empty array
        return [];
    }
}
