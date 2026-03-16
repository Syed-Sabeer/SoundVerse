<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ArtistMusic;
use App\Models\User;
use App\Models\UserPlaylist;
use App\Models\UserCollection;
use App\Models\UserSubscription;
use App\Models\ArtistSubscription;
use App\Models\ArtistSubscriptionPlan;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PlaylistController extends Controller
{
    /**
     * Show the create playlist page
     */
    public function showCreatePlaylist()
    {
        if (!auth()->check()) {
            return redirect()->route('user.login')->with('error', 'Please login to create a playlist');
        }
        
        return view('frontend.playlist.create');
    }

    /**
     * Search for music by name (public endpoint)
     */
    public function searchMusic(Request $request): JsonResponse
    {
        try {
            \Log::info('Music search request received', ['query' => $request->get('q')]);
            
            $query = $request->get('q', '');
            
            if (empty($query)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Search query is required',
                    'data' => []
                ], 400);
            }

            // Check if ArtistMusic model exists and has data
            $musicCount = ArtistMusic::count();
            \Log::info('Total music records in database: ' . $musicCount);

            $musics = ArtistMusic::with('user')
                ->where('name', 'LIKE', '%' . $query . '%')
                ->limit(20)
                ->get();

            \Log::info('Found ' . $musics->count() . ' music records for query: ' . $query);

            $musicData = $musics->map(function ($music) {
                $thumbnailUrl = $music->thumbnail_image_url;
                \Log::info('Music thumbnail URL', [
                    'music_id' => $music->id,
                    'thumbnail_image' => $music->thumbnail_image,
                    'thumbnail_url' => $thumbnailUrl
                ]);
                
                return [
                    'id' => $music->id,
                    'name' => $music->name,
                    'artist' => $music->user->name ?? 'Unknown Artist',
                    'thumbnail' => $thumbnailUrl,
                    'music_file' => $music->music_file_url,
                    'listeners' => $music->listeners,
                ];
            });

            \Log::info('Processed music data', ['count' => $musicData->count()]);

            return response()->json([
                'success' => true,
                'message' => 'Music search completed',
                'data' => $musicData
            ]);
        } catch (\Exception $e) {
            \Log::error('Music search error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'query' => $request->get('q')
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Error searching music: ' . $e->getMessage(),
                'data' => []
            ], 500);
        }
    }

    /**
     * Create a new playlist (public endpoint for testing)
     */
    public function createPlaylist(Request $request): JsonResponse
    {
        try {
            \Log::info('Playlist creation request received', [
                'playlist_name' => $request->get('playlist_name'),
                'music_ids' => $request->get('music_ids')
            ]);

            $request->validate([
                'playlist_name' => 'required|string|max:300',
                'music_ids' => 'required|array|min:1',
                'music_ids.*' => 'required|integer|exists:artist_musics,id'
            ]);

            // Get user ID from authenticated user
            $userId = auth()->id();
            
            if (!$userId) {
                \Log::warning('Playlist creation attempted without authentication');
                return response()->json([
                    'success' => false,
                    'message' => 'You must be logged in to create a playlist'
                ], 401);
            }

            // Check playlist creation limit based on subscription
            $user = \App\Models\User::find($userId);
            if (!$user->canCreatePlaylist()) {
                $limit = $user->getPlaylistLimit();
                $currentCount = $user->playlists()->distinct('playlist_name')->count('playlist_name');
                return response()->json([
                    'success' => false,
                    'message' => "You have reached your playlist limit of {$limit}. Current playlists: {$currentCount}. Please upgrade your plan to create unlimited playlists."
                ], 403);
            }

            $playlistData = [];
            foreach ($request->music_ids as $musicId) {
                $playlistData[] = [
                    'user_id' => $userId,
                    'music_id' => $musicId,
                    'playlist_name' => $request->playlist_name,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            \Log::info('Inserting playlist data', ['count' => count($playlistData)]);
            UserPlaylist::insert($playlistData);
            \Log::info('Playlist data inserted successfully');

            return response()->json([
                'success' => true,
                'message' => 'Playlist created successfully',
                'data' => [
                    'playlist_name' => $request->playlist_name,
                    'songs_count' => count($request->music_ids)
                ]
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Playlist creation validation error', [
                'errors' => $e->errors(),
                'request_data' => $request->all()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Playlist creation error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to create playlist: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Check if user can create more playlists
     */
    public function checkPlaylistLimit(Request $request): JsonResponse
    {
        try {
            $userId = auth()->id();
            
            if (!$userId) {
                return response()->json([
                    'success' => false,
                    'message' => 'You must be logged in'
                ], 401);
            }

            $user = \App\Models\User::find($userId);
            $canCreate = $user->canCreatePlaylist();
            $limit = $user->getPlaylistLimit();
            $currentCount = $user->playlists()->distinct('playlist_name')->count('playlist_name');

            return response()->json([
                'success' => true,
                'can_create' => $canCreate,
                'limit' => $limit,
                'current_count' => $currentCount,
                'message' => $canCreate 
                    ? "You can create playlists. Current: {$currentCount}" . ($limit ? "/{$limit}" : " (unlimited)") 
                    : "You have reached your playlist limit of {$limit}. Current: {$currentCount}. Please upgrade to create unlimited playlists."
            ]);
        } catch (\Exception $e) {
            \Log::error('Check playlist limit error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error checking playlist limit'
            ], 500);
        }
    }

    /**
     * Get user's playlists
     */
    public function getUserPlaylists(Request $request): JsonResponse
    {
        try {
            // Get user ID from authenticated user or session
            $userId = auth()->id() ?? session('user_id', 1);

            $playlists = UserPlaylist::with(['music.user'])
                ->where('user_id', $userId)
                ->get()
                ->groupBy('playlist_name')
                ->map(function ($songs, $playlistName) {
                    if ($songs->isEmpty()) {
                        return null;
                    }
                    
                    $totalDuration = $songs->sum('music.listeners') * 3; // Estimate 3 minutes per song
                    $hours = floor($totalDuration / 60);
                    $minutes = $totalDuration % 60;
                    
                    return [
                        'playlist_name' => $playlistName,
                        'songs_count' => $songs->count(),
                        'duration' => $hours > 0 ? "{$hours}h {$minutes}m" : "{$minutes}m",
                        'created_at' => $songs->first()->created_at,
                        'thumbnail' => $songs->first()->music->thumbnail_image_url ?? null,
                        'songs' => $songs->map(function ($playlist) {
                            return [
                                'id' => $playlist->music->id,
                                'name' => $playlist->music->name,
                                'artist' => $playlist->music->user->name ?? 'Unknown Artist',
                                'thumbnail' => $playlist->music->thumbnail_image_url,
                                'music_file' => $playlist->music->music_file_url,
                                'listeners' => $playlist->music->listeners,
                            ];
                        })
                    ];
                })
                ->filter() // Remove null entries
                ->values();

            return response()->json([
                'success' => true,
                'message' => 'Playlists retrieved successfully',
                'data' => $playlists
            ]);
        } catch (\Exception $e) {
            \Log::error('Get playlists error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving playlists: ' . $e->getMessage(),
                'data' => []
            ], 500);
        }
    }

    /**
     * Get playlist details with songs
     */
    public function getPlaylistDetails(Request $request, $playlistName): JsonResponse
    {
        try {
            // Get user ID from authenticated user or session
            $userId = auth()->id() ?? session('user_id', 1);

            $playlist = UserPlaylist::with(['music.user'])
                ->where('user_id', $userId)
                ->where('playlist_name', $playlistName)
                ->get();

            if ($playlist->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Playlist not found'
                ], 404);
            }

            $totalDuration = $playlist->sum('music.listeners') * 3; // Estimate 3 minutes per song
            $hours = floor($totalDuration / 60);
            $minutes = $totalDuration % 60;

            $playlistData = [
                'playlist_name' => $playlistName,
                'songs_count' => $playlist->count(),
                'duration' => $hours > 0 ? "{$hours}h {$minutes}m" : "{$minutes}m",
                'created_at' => $playlist->first()->created_at,
                'thumbnail' => $playlist->first()->music->thumbnail_image_url ?? null,
                'songs' => $playlist->map(function ($playlistItem) {
                    return [
                        'id' => $playlistItem->music->id,
                        'name' => $playlistItem->music->name,
                        'artist' => $playlistItem->music->user->name ?? 'Unknown Artist',
                        'thumbnail' => $playlistItem->music->thumbnail_image_url,
                        'music_file' => $playlistItem->music->music_file_url,
                        'listeners' => $playlistItem->music->listeners,
                        'added_at' => $playlistItem->created_at,
                    ];
                })
            ];

            return response()->json([
                'success' => true,
                'message' => 'Playlist details retrieved successfully',
                'data' => $playlistData
            ]);
        } catch (\Exception $e) {
            \Log::error('Get playlist details error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving playlist details: ' . $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    /**
     * Get all songs with pagination and search
     */
    public function getAllSongs(Request $request): JsonResponse
    {
        try {
            $query = $request->get('q', '');
            $page = $request->get('page', 1);
            $perPage = $request->get('per_page', 20);
            $userId = auth()->id();

            $songsQuery = ArtistMusic::with('user');

            if (!empty($query)) {
                $songsQuery->where('name', 'LIKE', '%' . $query . '%');
            }

            $songs = $songsQuery->paginate($perPage, ['*'], 'page', $page);

            // Get user's playlists to show which songs are in which playlists (only if user is authenticated)
            $userPlaylists = collect();
            if ($userId) {
                $userPlaylists = UserPlaylist::where('user_id', $userId)
                    ->get()
                    ->groupBy('music_id')
                    ->map(function ($playlists) {
                        return $playlists->pluck('playlist_name')->toArray();
                    });
            }

            // Get user's subscription features for HD audio
            $hasHDAudio = false;
            if (auth()->check()) {
                $hasHDAudio = auth()->user()->hasUserFeature('high_quality');
            }

            $songsData = $songs->map(function ($song) use ($userPlaylists, $hasHDAudio) {
                return [
                    'id' => $song->id,
                    'name' => $song->name,
                    'artist' => $song->user->name ?? 'Unknown Artist',
                    'thumbnail' => $song->thumbnail_image_url,
                    'music_file' => $song->music_file_url,
                    'listeners' => $song->listeners,
                    'isrc_code' => $song->isrc_code, // Add ISRC code
                    'duration' => '3:45', // Placeholder duration
                    'in_playlists' => $userPlaylists->get($song->id, []),
                    'created_at' => $song->created_at->format('Y-m-d H:i:s'),
                ];
            });

            return response()->json([
                'success' => true,
                'message' => 'Songs retrieved successfully',
                'data' => $songsData,
                'pagination' => [
                    'current_page' => $songs->currentPage(),
                    'last_page' => $songs->lastPage(),
                    'per_page' => $songs->perPage(),
                    'total' => $songs->total(),
                    'has_more' => $songs->hasMorePages(),
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Get all songs error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving songs: ' . $e->getMessage(),
                'data' => []
            ], 500);
        }
    }

    /**
     * Add song to playlist
     */
    public function addSongToPlaylist(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'music_id' => 'required|exists:artist_musics,id',
                'playlist_name' => 'required|string|max:300',
            ]);

            $userId = auth()->id();
            $musicId = $request->music_id;
            $playlistName = $request->playlist_name;

            // Check if song is already in playlist
            $existing = UserPlaylist::where('user_id', $userId)
                ->where('music_id', $musicId)
                ->where('playlist_name', $playlistName)
                ->first();

            if ($existing) {
                return response()->json([
                    'success' => false,
                    'message' => 'Song is already in this playlist'
                ], 400);
            }

            UserPlaylist::create([
                'user_id' => $userId,
                'music_id' => $musicId,
                'playlist_name' => $playlistName,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Song added to playlist successfully'
            ]);
        } catch (\Exception $e) {
            \Log::error('Add song to playlist error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error adding song to playlist: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove song from playlist
     */
    public function removeSongFromPlaylist(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'music_id' => 'required|exists:artist_musics,id',
                'playlist_name' => 'required|string|max:300',
            ]);

            $userId = auth()->id();
            $musicId = $request->music_id;
            $playlistName = $request->playlist_name;

            $deleted = UserPlaylist::where('user_id', $userId)
                ->where('music_id', $musicId)
                ->where('playlist_name', $playlistName)
                ->delete();

            if ($deleted) {
                return response()->json([
                    'success' => true,
                    'message' => 'Song removed from playlist successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Song not found in playlist'
                ], 404);
            }
        } catch (\Exception $e) {
            \Log::error('Remove song from playlist error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error removing song from playlist: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get user's playlist names for dropdown
     */
    public function getUserPlaylistNames(Request $request): JsonResponse
    {
        try {
            $userId = auth()->id();

            $playlistNames = UserPlaylist::where('user_id', $userId)
                ->distinct()
                ->pluck('playlist_name')
                ->sort()
                ->values();

            return response()->json([
                'success' => true,
                'message' => 'Playlist names retrieved successfully',
                'data' => $playlistNames
            ]);
        } catch (\Exception $e) {
            \Log::error('Get playlist names error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving playlist names: ' . $e->getMessage(),
                'data' => []
            ], 500);
        }
    }

    /**
     * Add song to favorites
     */
    public function addToFavorites(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'music_id' => 'required|exists:artist_musics,id',
            ]);

            $userId = auth()->id();
            $musicId = $request->music_id;

            // Check if already in favorites
            $existing = UserCollection::where('user_id', $userId)
                ->where('music_id', $musicId)
                ->first();

            if ($existing) {
                return response()->json([
                    'success' => false,
                    'message' => 'Song is already in your favorites'
                ], 400);
            }

            UserCollection::create([
                'user_id' => $userId,
                'music_id' => $musicId,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Song added to favorites successfully'
            ]);
        } catch (\Exception $e) {
            \Log::error('Add to favorites error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error adding song to favorites: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove song from favorites
     */
    public function removeFromFavorites(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'music_id' => 'required|exists:artist_musics,id',
            ]);

            $userId = auth()->id();
            $musicId = $request->music_id;

            $deleted = UserCollection::where('user_id', $userId)
                ->where('music_id', $musicId)
                ->delete();

            if ($deleted) {
                return response()->json([
                    'success' => true,
                    'message' => 'Song removed from favorites successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Song not found in favorites'
                ], 404);
            }
        } catch (\Exception $e) {
            \Log::error('Remove from favorites error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error removing song from favorites: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Toggle favorite status (add if not favorited, remove if favorited)
     */
    public function toggleFavorite(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'music_id' => 'required|exists:artist_musics,id',
            ]);

            $userId = auth()->id();
            $musicId = $request->music_id;

            $existing = UserCollection::where('user_id', $userId)
                ->where('music_id', $musicId)
                ->first();

            if ($existing) {
                // Remove from favorites
                $existing->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Song removed from favorites',
                    'is_favorited' => false
                ]);
            } else {
                // Add to favorites
                UserCollection::create([
                    'user_id' => $userId,
                    'music_id' => $musicId,
                ]);
                return response()->json([
                    'success' => true,
                    'message' => 'Song added to favorites',
                    'is_favorited' => true
                ]);
            }
        } catch (\Exception $e) {
            \Log::error('Toggle favorite error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error toggling favorite status: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Check if songs are favorited by user
     */
    public function checkFavorites(Request $request): JsonResponse
    {
        try {
            $userId = auth()->id();
            $musicIds = $request->get('music_ids', []);

            if (empty($musicIds)) {
                return response()->json([
                    'success' => true,
                    'data' => []
                ]);
            }

            $favorites = UserCollection::where('user_id', $userId)
                ->whereIn('music_id', $musicIds)
                ->pluck('music_id')
                ->toArray();

            return response()->json([
                'success' => true,
                'data' => $favorites
            ]);
        } catch (\Exception $e) {
            \Log::error('Check favorites error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error checking favorites: ' . $e->getMessage(),
                'data' => []
            ], 500);
        }
    }

    public function getUserFavorites(Request $request)
    {
        try {
            $userId = auth()->id();
            $page = $request->get('page', 1);
            $perPage = $request->get('per_page', 20);
            
            $favorites = UserCollection::where('user_id', $userId)
                ->with(['music' => function($query) {
                    $query->select('id', 'name', 'driver_id', 'thumbnail_image', 'music_file', 'video_file');
                }, 'music.user' => function($query) {
                    $query->select('id', 'name');
                }])
                ->orderBy('created_at', 'desc')
                ->paginate($perPage, ['*'], 'page', $page);
            
            $songs = $favorites->map(function($favorite) {
                return [
                    'id' => $favorite->music->id,
                    'name' => $favorite->music->name,
                    'artist' => $favorite->music->user ? $favorite->music->user->name : 'Unknown Artist',
                    'thumbnail' => $favorite->music->thumbnail_image_url,
                    'music_file' => $favorite->music->music_file_url,
                    'video_file' => $favorite->music->video_file_url,
                    'duration' => '0:00', // Default duration since it's not in the table
                    'added_at' => $favorite->created_at->format('Y-m-d H:i:s')
                ];
            });
            
            return response()->json([
                'success' => true,
                'data' => $songs,
                'pagination' => [
                    'current_page' => $favorites->currentPage(),
                    'last_page' => $favorites->lastPage(),
                    'per_page' => $favorites->perPage(),
                    'total' => $favorites->total()
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching favorites: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getLatestFavorites(Request $request)
    {
        try {
            $userId = auth()->id();
            $limit = $request->get('limit', 6);
            
            $favorites = UserCollection::where('user_id', $userId)
                ->with(['music' => function($query) {
                    $query->select('id', 'name', 'driver_id', 'thumbnail_image', 'music_file', 'video_file');
                }, 'music.user' => function($query) {
                    $query->select('id', 'name');
                }])
                ->orderBy('created_at', 'desc')
                ->limit($limit)
                ->get();
            
            $songs = $favorites->map(function($favorite) {
                return [
                    'id' => $favorite->music->id,
                    'name' => $favorite->music->name,
                    'artist' => $favorite->music->user ? $favorite->music->user->name : 'Unknown Artist',
                    'thumbnail' => $favorite->music->thumbnail_image_url,
                    'music_file' => $favorite->music->music_file_url,
                    'video_file' => $favorite->music->video_file_url,
                    'duration' => '0:00', // Default duration since it's not in the table
                    'added_at' => $favorite->created_at->format('Y-m-d H:i:s')
                ];
            });
            
            return response()->json([
                'success' => true,
                'data' => $songs,
                'total_count' => UserCollection::where('user_id', $userId)->count()
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching latest favorites: ' . $e->getMessage()
            ], 500);
        }
    }

    public function purchaseSubscription(Request $request)
    {
        try {
            $userId = auth()->id();
            if (!$userId) {
                // For testing purposes, use a default user ID
                $userId = 1; // You can change this to any existing user ID for testing
                \Log::info('Using default user ID for testing: ' . $userId);
            }

            $request->validate([
                'plan_id' => 'required|integer|exists:user_subscription_plans,id',
                'plan_type' => 'required|string',
                'price' => 'required|numeric|min:0',
                'duration' => 'required|integer|min:1',
                'payment_method' => 'required|string|in:stripe,google-pay,apple-pay,paypal,square',
                'payment_method_name' => 'nullable|string',
                'payment_method_id' => 'nullable|string' // For Stripe payment method ID
            ]);

            $user = User::find($userId);
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 404);
            }

            // Process payment
            $paymentService = new PaymentService();
            $paymentResult = $paymentService->processPayment(
                $request->payment_method,
                $request->price,
                'GBP',
                $request->payment_method_id
            );

            if (!$paymentResult['success']) {
                return response()->json([
                    'success' => false,
                    'message' => 'Payment failed: ' . ($paymentResult['error'] ?? 'Unknown error')
                ], 400);
            }

            // Use the plan_id from request
            $subscriptionPlanId = $request->plan_id;

            // Create subscription record in user_subscriptions table
            $subscription = UserSubscription::create([
                'user_id' => $userId,
                'usersubscription_id' => $subscriptionPlanId,
                'usersubscription_date' => now(),
                'usersubscription_duration' => $request->duration, // Duration in days
                'payment_method' => $request->payment_method,
                'payment_id' => $paymentResult['transaction_id'] ?? null
            ]);

            // Calculate subscription end date
            $endDate = now()->addDays($request->duration);

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Subscription purchased successfully',
                'subscription' => [
                    'id' => $subscription->id,
                    'subscription_plan_id' => $subscriptionPlanId,
                    'plan_type' => $request->plan_type,
                    'price' => $request->price,
                    'duration' => $request->duration,
                    'payment_method' => $request->payment_method,
                    'payment_method_name' => $request->payment_method_name ?? $request->payment_method,
                    'payment_transaction_id' => $paymentResult['transaction_id'] ?? null,
                    'start_date' => $subscription->usersubscription_date->format('Y-m-d H:i:s'),
                    'end_date' => $endDate->format('Y-m-d H:i:s'),
                    'days_remaining' => $request->duration
                ]
            ]);

        } catch (\Exception $e) {
            \Log::error('Subscription purchase error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to purchase subscription: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Purchase artist subscription
     */
    public function purchaseArtistSubscription(Request $request)
    {
        try {
            $userId = auth()->id();
            if (!$userId) {
                $userId = 1; // For testing purposes
                \Log::info('Using default user ID for testing: ' . $userId);
            }

            $request->validate([
                'plan_id' => 'required|integer|exists:artist_subscription_plans,id',
                'plan_type' => 'required|string',
                'price' => 'required|numeric|min:0',
                'duration' => 'required|integer|min:1',
                'payment_method' => 'required|string|in:stripe,google-pay,apple-pay,paypal,square',
                'payment_method_name' => 'nullable|string',
                'payment_method_id' => 'nullable|string' // For Stripe payment method ID
            ]);

            $user = User::find($userId);
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 404);
            }

            // Check if user is an artist
            if (!$user->is_artist) {
                return response()->json([
                    'success' => false,
                    'message' => 'Only artists can purchase artist subscriptions'
                ], 403);
            }

            // Process payment
            $paymentService = new PaymentService();
            $paymentResult = $paymentService->processPayment(
                $request->payment_method,
                $request->price,
                'GBP',
                $request->payment_method_id
            );

            if (!$paymentResult['success']) {
                return response()->json([
                    'success' => false,
                    'message' => 'Payment failed: ' . ($paymentResult['error'] ?? 'Unknown error')
                ], 400);
            }

            // Use the plan_id from request
            $subscriptionPlanId = $request->plan_id;

            // Create subscription record in artist_subscriptions table
            $subscription = ArtistSubscription::create([
                'user_id' => $userId,
                'artist_subscription_plan_id' => $subscriptionPlanId,
                'subscription_date' => now(),
                'subscription_duration' => $request->duration, // Duration in days
                'payment_method' => $request->payment_method,
                'payment_id' => $paymentResult['transaction_id'] ?? null
            ]);

            // Calculate subscription end date
            $endDate = now()->addDays($request->duration);

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Artist subscription purchased successfully',
                'subscription' => [
                    'id' => $subscription->id,
                    'subscription_plan_id' => $subscriptionPlanId,
                    'plan_type' => $request->plan_type,
                    'price' => $request->price,
                    'duration' => $request->duration,
                    'payment_method' => $request->payment_method,
                    'payment_method_name' => $request->payment_method_name ?? $request->payment_method,
                    'payment_transaction_id' => $paymentResult['transaction_id'] ?? null,
                    'start_date' => $subscription->subscription_date->format('Y-m-d H:i:s'),
                    'end_date' => $endDate->format('Y-m-d H:i:s'),
                    'days_remaining' => $request->duration
                ]
            ]);

        } catch (\Exception $e) {
            \Log::error('Artist subscription purchase error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to purchase artist subscription: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get user's current subscription
     */
    public function getUserSubscription(Request $request)
    {
        try {
            $userId = auth()->id();
            if (!$userId) {
                // For testing purposes, use a default user ID
                $userId = 1;
            }

            $subscription = UserSubscription::where('user_id', $userId)
                ->with('subscriptionPlan')
                ->latest()
                ->first();

            if (!$subscription) {
                return response()->json([
                    'success' => true,
                    'subscription' => null,
                    'message' => 'No active subscription found'
                ]);
            }

            return response()->json([
                'success' => true,
                'subscription' => [
                    'id' => $subscription->id,
                    'subscription_plan_id' => $subscription->usersubscription_id,
                    'plan_title' => $subscription->subscriptionPlan->title ?? 'Unknown Plan',
                    'plan_price' => $subscription->subscriptionPlan->price ?? 0,
                    'start_date' => $subscription->usersubscription_date->format('Y-m-d H:i:s'),
                    'end_date' => $subscription->end_date->format('Y-m-d H:i:s'),
                    'duration' => $subscription->usersubscription_duration,
                    'days_remaining' => $subscription->days_remaining,
                    'is_active' => $subscription->isActive(),
                    'payment_method' => $subscription->payment_method,
                    'payment_id' => $subscription->payment_id
                ]
            ]);

        } catch (\Exception $e) {
            \Log::error('Get user subscription error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to get subscription: ' . $e->getMessage()
            ], 500);
        }
    }

}


