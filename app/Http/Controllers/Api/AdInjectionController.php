<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AdInjectionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdInjectionController extends Controller
{
    protected $adInjectionService;
    
    public function __construct(AdInjectionService $adInjectionService)
    {
        $this->adInjectionService = $adInjectionService;
    }
    
    /**
     * Get ad injection data for current user
     */
    public function getAdData(Request $request)
    {
        try {
            Log::info('AdInjectionController: getAdData called', [
                'url' => $request->url(),
                'method' => $request->method(),
                'headers' => $request->headers->all(),
                'user_agent' => $request->userAgent()
            ]);
            
            $userId = Auth::id();
            
            if (!$userId) {
                Log::warning('AdInjectionController: Unauthenticated user requesting ad data - treating as FREE user (show ads)');
                // Unauthenticated users = FREE users = show ads
                // Return ads for unauthenticated users instead of using fallback
                $ad = $this->adInjectionService->getRandomAd();
                $timing = $this->adInjectionService->getAdTiming();
                
                $adData = [
                    'show_ads' => true,
                    'ad' => $ad ? [
                        'id' => $ad->id,
                        'title' => $ad->title,
                        'file_url' => $ad->file_url,
                        'file' => $ad->file,
                        'link' => $ad->link,
                        'type' => $this->getAdType($ad->file)
                    ] : null,
                    'message' => $ad ? 'Free user - ads enabled' : 'Free user - no ads available'
                ];
                
                return response()->json([
                    'success' => true,
                    'data' => array_merge($adData, $timing)
                ]);
            }
            
            Log::info('AdInjectionController: Getting ad data for authenticated user', [
                'user_id' => $userId,
                'auth_user' => Auth::user() ? Auth::user()->email : 'not logged in',
                'auth_id' => Auth::id()
            ]);
            
            // Direct check for debugging
            $user = \App\Models\User::find($userId);
            if ($user) {
                $subscription = $user->activeUserSubscription;
                Log::info('AdInjectionController: User subscription check', [
                    'user_id' => $userId,
                    'has_subscription' => $subscription ? 'yes' : 'no',
                    'subscription_id' => $subscription ? $subscription->id : null,
                    'plan_id' => $subscription ? $subscription->usersubscription_id : null,
                ]);
                
                if ($subscription && $subscription->subscriptionPlan) {
                    $plan = $subscription->subscriptionPlan;
                    Log::info('AdInjectionController: Plan details', [
                        'plan_id' => $plan->id,
                        'plan_title' => $plan->title,
                        'plan_price' => $plan->price,
                        'plan_is_ads' => $plan->is_ads,
                        'plan_is_ads_raw' => $plan->getRawOriginal('is_ads'),
                    ]);
                }
            }
            
            $adData = $this->adInjectionService->getAdInjectionData($userId);
            $timing = $this->adInjectionService->getAdTiming();
            
            Log::info('AdInjectionController: Returning ad data', [
                'user_id' => $userId,
                'show_ads' => $adData['show_ads'] ?? 'not set',
                'message' => $adData['message'] ?? 'no message'
            ]);
            
            return response()->json([
                'success' => true,
                'data' => array_merge($adData, $timing)
            ]);
            
        } catch (\Exception $e) {
            Log::error('AdInjectionController: Error getting ad data', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Error loading ad data'
            ], 500);
        }
    }
    
    /**
     * Check if user should see ads
     */
    public function shouldShowAds(Request $request)
    {
        try {
            $userId = Auth::id();
            
            if (!$userId) {
                // For testing purposes, use user ID 1 if not authenticated
                $userId = 1;
            }
            
            $shouldShowAds = $this->adInjectionService->shouldShowAds($userId);
            
            return response()->json([
                'success' => true,
                'show_ads' => $shouldShowAds
            ]);
            
        } catch (\Exception $e) {
            Log::error('AdInjectionController: Error checking ad display', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Error checking ad display'
            ], 500);
        }
    }
    
    /**
     * Get random ad for injection
     */
    public function getRandomAd(Request $request)
    {
        try {
            $userId = Auth::id();
            
            if (!$userId) {
                // For testing purposes, use user ID 1 if not authenticated
                $userId = 1;
            }
            
            // Check if user should see ads
            $shouldShowAds = $this->adInjectionService->shouldShowAds($userId);
            
            $adData = $this->adInjectionService->getAdInjectionData($userId);
            $timing = $this->adInjectionService->getAdTiming();
            
            return response()->json([
                'success' => true,
                'data' => array_merge($adData, $timing)
            ]);
            
        } catch (\Exception $e) {
            Log::error('AdInjectionController: Error getting random ad', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Error loading ad'
            ], 500);
        }
    }
    
    /**
     * Determine ad type based on file extension
     */
    private function getAdType($file)
    {
        if (!$file) return 'unknown';
        
        $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        
        if (in_array($extension, ['mp4', 'avi', 'mov', 'webm', 'mkv'])) {
            return 'video';
        } elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
            return 'image';
        }
        
        return 'unknown';
    }
}
