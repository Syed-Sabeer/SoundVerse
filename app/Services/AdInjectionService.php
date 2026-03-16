<?php

namespace App\Services;

use App\Models\Ad;
use App\Models\UserSubscription;
use App\Models\UserSubscriptionPlan;
use Illuminate\Support\Facades\Log;

class AdInjectionService
{
    /**
     * Check if user should see ads based on their subscription
     */
    public function shouldShowAds($userId)
    {
        try {
            Log::warning('AdInjectionService: shouldShowAds called', ['user_id' => $userId]);
            
            // DIRECT DATABASE CHECK: Verify user exists and has no subscriptions
            $user = \App\Models\User::find($userId);
            if (!$user) {
                Log::error('AdInjectionService: User not found in database', ['user_id' => $userId]);
                return true; // Default to showing ads if user not found
            }
            
            // Direct check: count active subscriptions from database
            $activeSubscriptionsCount = \App\Models\UserSubscription::where('user_id', $userId)
                ->get()
                ->filter(function($sub) {
                    return $sub->isActive();
                })
                ->count();
            
            Log::warning('AdInjectionService: Direct database check', [
                'user_id' => $userId,
                'active_subscriptions_count' => $activeSubscriptionsCount,
                'user_email' => $user->email ?? 'no email'
            ]);
            
            // If no active subscriptions, user is FREE = ALWAYS show ads
            if ($activeSubscriptionsCount === 0) {
                Log::warning('AdInjectionService: User has ZERO active subscriptions - FORCING ads to show', [
                    'user_id' => $userId,
                    'active_count' => 0,
                    'decision' => 'RETURNING TRUE - FREE USER'
                ]);
                return true; // Free users always see ads - RETURN IMMEDIATELY
            }
            
            // Get user's active subscription (only if we have active subscriptions)
            $activeSubscription = $this->getActiveSubscription($userId);
            
            // CRITICAL: If no active subscription, user is FREE = ALWAYS show ads
            if (!$activeSubscription) {
                Log::warning('AdInjectionService: User has NO active subscription - FORCING ads to show', [
                    'user_id' => $userId,
                    'subscription' => 'null',
                    'decision' => 'RETURNING TRUE - FREE USER'
                ]);
                // Double-check: make absolutely sure we return true
                return true; // Free users always see ads
            }
            
            Log::info('AdInjectionService: User has active subscription', [
                'user_id' => $userId,
                'subscription_id' => $activeSubscription->id,
                'plan_id' => $activeSubscription->usersubscription_id,
                'subscription_date' => $activeSubscription->usersubscription_date,
                'duration' => $activeSubscription->usersubscription_duration
            ]);
            
            // Get subscription plan details
            $plan = UserSubscriptionPlan::find($activeSubscription->usersubscription_id);
            
            if (!$plan) {
                Log::warning('AdInjectionService: Subscription plan not found', [
                    'user_id' => $userId,
                    'subscription_id' => $activeSubscription->usersubscription_id
                ]);
                return true; // Default to showing ads if plan not found
            }
            
            // CRITICAL: Check if this is a free plan FIRST (price = 0 or "0")
            // Price is stored as string in database, so check all formats
            $priceValue = is_numeric($plan->price) ? (float)$plan->price : 0;
            $isFreePlan = ($priceValue == 0 || $plan->price === '0' || $plan->price === 0 || trim($plan->price) === '0');
            
            // If it's a free plan, ALWAYS show ads - no exceptions
            if ($isFreePlan || stripos($plan->title, 'Free Listener') !== false) {
                Log::info('AdInjectionService: Free plan detected - FORCING ads to show', [
                    'plan_title' => $plan->title,
                    'price' => $plan->price,
                    'price_value' => $priceValue,
                    'plan_id' => $plan->id
                ]);
                return true; // Return immediately - free plans always show ads
            }
            
            // For paid plans, check is_ads field using User model's hasUserFeature method
            // This is more reliable as it uses the same logic as the rest of the app
            // is_ads field meaning in database:
            // - 1 = no ads (ad-free subscription)
            // - 0 = with ads (show ads)
            // - NULL = default to showing ads
            
            // Use User model's hasUserFeature method for consistency
            $isAdFreeFromFeature = $user->hasUserFeature('ad_free');
            
            // Also check the plan's is_ads field directly as a fallback
            $isAdsRaw = $plan->getRawOriginal('is_ads');
            if ($isAdsRaw === null) {
                $isAdsRaw = $plan->is_ads;
            }
            
            // Check if plan is ad-free: is_ads = 1 means ad-free (no ads)
            // is_ads = 0 or NULL means show ads
            $isAdFreeFromRaw = ($isAdsRaw === 1 || $isAdsRaw === '1' || $isAdsRaw === true || $isAdsRaw === 'true');
            
            // Use either method - if either says ad-free, then it's ad-free
            $isAdFree = $isAdFreeFromFeature || $isAdFreeFromRaw;
            
            // For paid plans: Show ads if plan is NOT ad-free (is_ads != 1)
            // Hide ads only if user explicitly has ad-free subscription (is_ads = 1)
            $showAds = !$isAdFree;
            
            Log::warning('AdInjectionService: Subscription plan ad setting - DETAILED CHECK', [
                'user_id' => $userId,
                'plan_id' => $plan->id,
                'plan_name' => $plan->title,
                'price' => $plan->price,
                'price_value' => $priceValue,
                'is_free_plan' => $isFreePlan,
                'is_ads_raw_value' => $isAdsRaw,
                'is_ads_original' => $plan->getRawOriginal('is_ads'),
                'is_ads_attribute' => $plan->is_ads,
                'hasUserFeature_ad_free' => $isAdFreeFromFeature,
                'isAdFreeFromRaw' => $isAdFreeFromRaw,
                'is_ad_free_final' => $isAdFree,
                'show_ads' => $showAds,
                'final_decision' => $showAds ? 'SHOW ADS' : 'HIDE ADS'
            ]);
            
            return $showAds;
            
        } catch (\Exception $e) {
            Log::error('AdInjectionService: Error checking ad display', [
                'user_id' => $userId,
                'error' => $e->getMessage()
            ]);
            return true; // Default to showing ads on error
        }
    }
    
    /**
     * Get a random ad for injection
     */
    public function getRandomAd()
    {
        try {
            $ad = Ad::visible()
                ->inRandomOrder()
                ->first();
                
            if (!$ad) {
                Log::warning('AdInjectionService: No visible ads found');
                return null;
            }
            
            Log::info('AdInjectionService: Selected random ad', [
                'ad_id' => $ad->id,
                'title' => $ad->title,
                'file' => $ad->file
            ]);
            
            return $ad;
            
        } catch (\Exception $e) {
            Log::error('AdInjectionService: Error getting random ad', [
                'error' => $e->getMessage()
            ]);
            return null;
        }
    }
    
    /**
     * Get user's active subscription
     */
    private function getActiveSubscription($userId)
    {
        try {
            // Use the User model's activeUserSubscription attribute for consistency
            $user = \App\Models\User::find($userId);
            if (!$user) {
                Log::warning('AdInjectionService: User not found', ['user_id' => $userId]);
                return null;
            }
            
            // Get all subscriptions for this user
            $allSubscriptions = $user->userSubscriptions()->get();
            Log::info('AdInjectionService: All user subscriptions', [
                'user_id' => $userId,
                'total_subscriptions' => $allSubscriptions->count(),
                'subscription_ids' => $allSubscriptions->pluck('id')->toArray()
            ]);
            
            $subscription = $user->activeUserSubscription;
                
            if ($subscription) {
                Log::info('AdInjectionService: Found active subscription', [
                    'user_id' => $userId,
                    'subscription_id' => $subscription->id,
                    'plan_id' => $subscription->usersubscription_id,
                    'start_date' => $subscription->usersubscription_date,
                    'duration' => $subscription->usersubscription_duration,
                    'is_active_check' => $subscription->isActive() ? 'yes' : 'no'
                ]);
            } else {
                Log::info('AdInjectionService: No active subscription found - user is FREE', [
                    'user_id' => $userId,
                    'all_subscriptions_count' => $allSubscriptions->count()
                ]);
            }
            
            return $subscription;
            
        } catch (\Exception $e) {
            Log::error('AdInjectionService: Error getting active subscription', [
                'user_id' => $userId,
                'error' => $e->getMessage()
            ]);
            return null;
        }
    }
    
    /**
     * Get ad injection data for frontend
     */
    public function getAdInjectionData($userId)
    {
        try {
            Log::warning('AdInjectionService: getAdInjectionData START', ['user_id' => $userId]);
            
            $shouldShowAds = $this->shouldShowAds($userId);
            
            Log::warning('AdInjectionService: getAdInjectionData - shouldShowAds result', [
                'user_id' => $userId,
                'should_show_ads' => $shouldShowAds,
                'type' => gettype($shouldShowAds)
            ]);
            
            if (!$shouldShowAds) {
                Log::warning('AdInjectionService: User has ad-free subscription, not showing ads', [
                    'user_id' => $userId,
                    'should_show_ads_value' => $shouldShowAds,
                    'should_show_ads_type' => gettype($shouldShowAds)
                ]);
                return [
                    'show_ads' => false,
                    'message' => 'Premium user - no ads'
                ];
            }
            
            Log::warning('AdInjectionService: User SHOULD see ads, getting ad data', ['user_id' => $userId]);
            
            // User should see ads - get a random ad
            $ad = $this->getRandomAd();
            
            if (!$ad) {
                // Even if no ads are available, we should still indicate that ads should be shown
                // This allows the frontend to handle the "no ads available" case gracefully
                Log::warning('AdInjectionService: User should see ads but no ads available in database', ['user_id' => $userId]);
                return [
                    'show_ads' => true, // Still return true so system knows to show ads
                    'ad' => null,
                    'message' => 'No ads available at the moment'
                ];
            }
            
            Log::info('AdInjectionService: Returning ad data', [
                'user_id' => $userId,
                'ad_id' => $ad->id,
                'ad_title' => $ad->title
            ]);
            
            return [
                'show_ads' => true,
                'ad' => [
                    'id' => $ad->id,
                    'title' => $ad->title,
                    'file_url' => $ad->file_url,
                    'file' => $ad->file, // Include file path for fallback
                    'link' => $ad->link,
                    'type' => $this->getAdType($ad->file)
                ]
            ];
            
        } catch (\Exception $e) {
            Log::error('AdInjectionService: Error getting ad injection data', [
                'user_id' => $userId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            // On error, default to showing ads (safer for free users)
            return [
                'show_ads' => true,
                'ad' => null,
                'message' => 'Error loading ads'
            ];
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
    
    /**
     * Calculate ad injection timing (random intervals)
     */
    public function getAdTiming()
    {
        // Random ad intervals between 2-8 minutes (120-480 seconds)
        $minInterval = 120; // 2 minutes
        $maxInterval = 480; // 8 minutes
        
        $nextAdIn = rand($minInterval, $maxInterval);
        
        Log::info('AdInjectionService: Calculated ad timing', [
            'next_ad_in_seconds' => $nextAdIn,
            'next_ad_in_minutes' => round($nextAdIn / 60, 1)
        ]);
        
        return [
            'next_ad_in_seconds' => $nextAdIn,
            'next_ad_in_minutes' => round($nextAdIn / 60, 1),
            'min_interval' => $minInterval,
            'max_interval' => $maxInterval
        ];
    }
}
