<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MonthlyPlay;
use App\Models\ArtistMusic;
use App\Models\StreamStat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MonthlyPlayController extends Controller
{
    /**
     * Track a play for a specific song
     */
    public function trackPlay(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'music_id' => 'required|integer|exists:artist_musics,id'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 400);
            }

            $userId = Auth::id();
            $musicId = $request->music_id;

            if (!$userId) {
                // For testing purposes, use user ID 1 if not authenticated
                $userId = 1;
                Log::info('MonthlyPlayController: Using fallback user ID for testing', ['user_id' => $userId]);
            }

            // Verify the music exists
            $music = ArtistMusic::find($musicId);
            if (!$music) {
                return response()->json([
                    'success' => false,
                    'message' => 'Music not found'
                ], 404);
            }

            Log::info('MonthlyPlayController: Tracking play', [
                'user_id' => $userId,
                'music_id' => $musicId,
                'music_name' => $music->name,
                'artist' => $music->artist
            ]);

            // Increment play count in monthly_plays table
            $monthlyPlay = MonthlyPlay::incrementPlay($userId, $musicId);

            // Also log to stream_stats table for royalty calculation
            // Mark as complete if stream duration is significant (e.g., >= 30 seconds)
            $streamDuration = (int) $request->get('stream_duration', 0);
            $isComplete = $streamDuration >= 30; // Consider complete if 30+ seconds

            // Only create/update stream stat if duration > 0 (when song ends)
            // If duration is 0, it's just a play start - we'll track it when song ends
            if ($streamDuration > 0) {
                // Check if there's an existing incomplete stream from this user for this song (within last 10 minutes)
                // This handles the case where song started (duration 0) and now ended (actual duration)
                $existingStream = StreamStat::where('music_id', $musicId)
                    ->where('user_id', $userId)
                    ->where('stream_duration', 0)
                    ->where('created_at', '>=', now()->subMinutes(10))
                    ->orderBy('created_at', 'desc')
                    ->first();
                
                if ($existingStream) {
                    // Update existing stream with actual duration
                    $existingStream->update([
                        'stream_duration' => $streamDuration,
                        'is_complete' => $isComplete,
                        'streamed_at' => now(),
                    ]);
                    
                    Log::info('MonthlyPlayController: Updated existing stream stat', [
                        'music_id' => $musicId,
                        'duration' => $streamDuration,
                        'is_complete' => $isComplete
                    ]);
                } else {
                    // Create new stream stat
                    StreamStat::create([
                        'music_id' => $musicId,
                        'artist_id' => $music->driver_id,
                        'user_id' => $userId,
                        'stream_duration' => $streamDuration,
                        'ip_address' => $request->ip(),
                        'is_complete' => $isComplete,
                        'streamed_at' => now(),
                    ]);
                    
                    Log::info('MonthlyPlayController: Stream stat logged', [
                        'music_id' => $musicId,
                        'duration' => $streamDuration,
                        'is_complete' => $isComplete
                    ]);
                }
            }

            // Increment listeners count on the music track
            $music->increment('listeners');

            return response()->json([
                'success' => true,
                'message' => 'Play tracked successfully',
                'data' => [
                    'monthly_play_id' => $monthlyPlay->id,
                    'current_plays' => $monthlyPlay->plays,
                    'month' => $monthlyPlay->month,
                    'year' => $monthlyPlay->year,
                    'music_name' => $music->name,
                    'artist' => $music->user->name ?? 'Unknown',
                    'stream_logged' => true,
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('MonthlyPlayController: Error tracking play', [
                'user_id' => Auth::id(),
                'music_id' => $request->music_id ?? null,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error tracking play: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get user's monthly play statistics
     */
    public function getUserMonthlyStats(Request $request)
    {
        try {
            $userId = Auth::id();
            $month = $request->get('month', now()->month);
            $year = $request->get('year', now()->year);

            if (!$userId) {
                // For testing purposes, use user ID 1 if not authenticated
                $userId = 1;
            }

            Log::info('MonthlyPlayController: Getting user monthly stats', [
                'user_id' => $userId,
                'month' => $month,
                'year' => $year
            ]);

            $totalPlays = MonthlyPlay::getUserMonthlyPlays($userId, $month, $year);
            $topSongs = MonthlyPlay::getUserTopSongs($userId, $month, $year, 10);
            $monthlyStats = MonthlyPlay::getUserMonthlyStats($userId, $year);
            $allTimeStats = MonthlyPlay::getUserAllTimeStats($userId);

            return response()->json([
                'success' => true,
                'data' => [
                    'current_month' => [
                        'month' => $month,
                        'year' => $year,
                        'total_plays' => $totalPlays,
                        'top_songs' => $topSongs
                    ],
                    'yearly_stats' => $monthlyStats,
                    'all_time_stats' => $allTimeStats
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('MonthlyPlayController: Error getting user monthly stats', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error getting monthly stats: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get music's monthly play statistics
     */
    public function getMusicMonthlyStats(Request $request, $musicId)
    {
        try {
            $month = $request->get('month', now()->month);
            $year = $request->get('year', now()->year);

            Log::info('MonthlyPlayController: Getting music monthly stats', [
                'music_id' => $musicId,
                'month' => $month,
                'year' => $year
            ]);

            $music = ArtistMusic::find($musicId);
            if (!$music) {
                return response()->json([
                    'success' => false,
                    'message' => 'Music not found'
                ], 404);
            }

            $totalPlays = MonthlyPlay::getMusicMonthlyPlays($musicId, $month, $year);
            $monthlyStats = MonthlyPlay::where('music_id', $musicId)
                ->where('year', $year)
                ->selectRaw('month, SUM(plays) as total_plays')
                ->groupBy('month')
                ->orderBy('month')
                ->get();

            return response()->json([
                'success' => true,
                'data' => [
                    'music' => [
                        'id' => $music->id,
                        'name' => $music->name,
                        'artist' => $music->artist
                    ],
                    'current_month' => [
                        'month' => $month,
                        'year' => $year,
                        'total_plays' => $totalPlays
                    ],
                    'yearly_stats' => $monthlyStats
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('MonthlyPlayController: Error getting music monthly stats', [
                'music_id' => $musicId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error getting music monthly stats: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get top played songs globally for a month
     */
    public function getTopSongs(Request $request)
    {
        try {
            $month = $request->get('month', now()->month);
            $year = $request->get('year', now()->year);
            $limit = $request->get('limit', 20);

            Log::info('MonthlyPlayController: Getting top songs', [
                'month' => $month,
                'year' => $year,
                'limit' => $limit
            ]);

            $topSongs = MonthlyPlay::with('music')
                ->where('month', $month)
                ->where('year', $year)
                ->selectRaw('music_id, SUM(plays) as total_plays')
                ->groupBy('music_id')
                ->orderBy('total_plays', 'desc')
                ->limit($limit)
                ->get();

            return response()->json([
                'success' => true,
                'data' => [
                    'month' => $month,
                    'year' => $year,
                    'top_songs' => $topSongs
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('MonthlyPlayController: Error getting top songs', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error getting top songs: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get monthly analytics for admin
     */
    public function getMonthlyAnalytics(Request $request)
    {
        try {
            $year = $request->get('year', now()->year);

            Log::info('MonthlyPlayController: Getting monthly analytics', [
                'year' => $year
            ]);

            $analytics = MonthlyPlay::where('year', $year)
                ->selectRaw('
                    month,
                    SUM(plays) as total_plays,
                    COUNT(DISTINCT user_id) as unique_users,
                    COUNT(DISTINCT music_id) as unique_songs,
                    AVG(plays) as avg_plays_per_record
                ')
                ->groupBy('month')
                ->orderBy('month')
                ->get();

            $yearlyTotal = MonthlyPlay::where('year', $year)
                ->selectRaw('
                    SUM(plays) as total_plays,
                    COUNT(DISTINCT user_id) as unique_users,
                    COUNT(DISTINCT music_id) as unique_songs
                ')
                ->first();

            return response()->json([
                'success' => true,
                'data' => [
                    'year' => $year,
                    'monthly_analytics' => $analytics,
                    'yearly_total' => $yearlyTotal
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('MonthlyPlayController: Error getting monthly analytics', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error getting monthly analytics: ' . $e->getMessage()
            ], 500);
        }
    }
}