<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ArtistMusic;
use App\Models\UserOfflineDownload;
use App\Models\DownloadStat;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DownloadController extends Controller
{
    /**
     * Download a song (with subscription check)
     */
    public function download(Request $request, $musicId)
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'You must be logged in to download songs'
                ], 401);
            }

            $music = ArtistMusic::findOrFail($musicId);
            
            if (!$music->music_file) {
                return response()->json([
                    'success' => false,
                    'message' => 'This song is not available for download'
                ], 404);
            }

            // Check if user has offline download feature
            if (!$user->hasUserFeature('offline_downloads')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Offline downloads are only available for Premium and Super Listener subscribers. Please upgrade your plan.'
                ], 403);
            }

            // Check download limit
            $limit = $user->getOfflineDownloadLimit();
            if ($limit !== null) {
                $currentDownloads = UserOfflineDownload::where('user_id', $user->id)->count();
                if ($currentDownloads >= $limit) {
                    return response()->json([
                        'success' => false,
                        'message' => "You have reached your offline download limit of {$limit} songs. Please remove some downloads or upgrade to Super Listener for unlimited downloads."
                    ], 403);
                }
            }

            // Check if already downloaded
            $existingDownload = UserOfflineDownload::where('user_id', $user->id)
                ->where('music_id', $musicId)
                ->first();

            if (!$existingDownload) {
                // Get file size
                $filePath = storage_path('app/public/' . $music->music_file);
                $fileSize = file_exists($filePath) ? filesize($filePath) : null;

                // Create download record
                UserOfflineDownload::create([
                    'user_id' => $user->id,
                    'music_id' => $musicId,
                    'file_size' => $fileSize,
                ]);

                // Log download stat
                DownloadStat::create([
                    'music_id' => $musicId,
                    'artist_id' => $music->driver_id,
                    'user_id' => $user->id,
                    'ip_address' => $request->ip(),
                    'downloaded_at' => now(),
                ]);
            }

            // Return file for download
            $filePath = storage_path('app/public/' . $music->music_file);
            
            if (!file_exists($filePath)) {
                return response()->json([
                    'success' => false,
                    'message' => 'File not found on server'
                ], 404);
            }
            
            // Clean filename for download
            $filename = preg_replace('/[^a-zA-Z0-9._-]/', '_', $music->name) . '.mp3';
            
            // Return file download response with proper headers to handle ID3 tags
            // Use standard download() method which handles binary files correctly
            return response()->download($filePath, $filename, [
                'Content-Type' => 'audio/mpeg',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ])->deleteFileAfterSend(false);

        } catch (\Exception $e) {
            Log::error('Download error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error processing download: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get user's download count and limit
     */
    public function getDownloadStats(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'You must be logged in'
                ], 401);
            }

            $hasOfflineFeature = $user->hasUserFeature('offline_downloads');
            $limit = $user->getOfflineDownloadLimit();
            $currentDownloads = UserOfflineDownload::where('user_id', $user->id)->count();

            return response()->json([
                'success' => true,
                'has_offline_feature' => $hasOfflineFeature,
                'current_downloads' => $currentDownloads,
                'download_limit' => $limit,
                'can_download' => $hasOfflineFeature && ($limit === null || $currentDownloads < $limit),
            ]);

        } catch (\Exception $e) {
            Log::error('Get download stats error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error getting download stats'
            ], 500);
        }
    }

    /**
     * Remove a downloaded song
     */
    public function removeDownload(Request $request, $musicId): JsonResponse
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'You must be logged in'
                ], 401);
            }

            $deleted = UserOfflineDownload::where('user_id', $user->id)
                ->where('music_id', $musicId)
                ->delete();

            if ($deleted) {
                return response()->json([
                    'success' => true,
                    'message' => 'Download removed successfully'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Download not found'
            ], 404);

        } catch (\Exception $e) {
            Log::error('Remove download error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error removing download'
            ], 500);
        }
    }

    /**
     * Get user's downloaded songs
     */
    public function getMyDownloads(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'You must be logged in'
                ], 401);
            }

            $downloads = UserOfflineDownload::where('user_id', $user->id)
                ->with(['music.user'])
                ->latest('downloaded_at')
                ->get();

            $songs = $downloads->map(function($download) {
                return [
                    'id' => $download->music->id,
                    'name' => $download->music->name,
                    'artist' => $download->music->user->name ?? 'Unknown Artist',
                    'thumbnail' => $download->music->thumbnail_image_url,
                    'music_file' => $download->music->music_file_url,
                    'downloaded_at' => $download->downloaded_at->format('Y-m-d H:i:s'),
                    'file_size' => $download->file_size,
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $songs,
                'total' => $songs->count(),
            ]);

        } catch (\Exception $e) {
            Log::error('Get downloads error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error getting downloads'
            ], 500);
        }
    }
}
