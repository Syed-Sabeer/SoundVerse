<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserSubscriptionPlan;


class UserPortalController extends Controller
{

    public function index(){
        // Get all active user subscription plans, ordered by price
        $user_subscription_plans = UserSubscriptionPlan::orderByRaw('CAST(price AS DECIMAL(10,2)) ASC')->get();
        
        // Get current user's active subscription if logged in
        $currentSubscription = null;
        $currentPlan = null;
        $subscriptionFeatures = [];
        
        // User stats
        $userStats = [
            'total_playlists' => 0,
            'total_songs' => 0,
            'total_favorites' => 0,
            'total_subscribed' => 0,
        ];
        
        if (auth()->check()) {
            $user = auth()->user();
            $currentSubscription = $user->activeUserSubscription;
            
            // Calculate user stats
            $userStats['total_playlists'] = $user->playlists()->distinct('playlist_name')->count('playlist_name');
            $userStats['total_songs'] = $user->playlists()->count();
            $userStats['total_favorites'] = \App\Models\UserCollection::where('user_id', $user->id)->count();
            $userStats['total_subscribed'] = $user->subscribedArtists()->count();
            
            if ($currentSubscription && $currentSubscription->subscriptionPlan) {
                $currentPlan = $currentSubscription->subscriptionPlan;
                
                // Get feature status
                $subscriptionFeatures = [
                    'ad_free' => (bool) $currentPlan->is_ads,
                    'unlimited_playlists' => (bool) $currentPlan->is_unlimitedplaylist,
                    'playlist_limit' => $currentPlan->is_unlimitedplaylist ? null : ($currentPlan->playlist_limit ?? 3),
                    'offline_downloads' => (bool) $currentPlan->is_offline,
                    'offline_download_limit' => $currentPlan->is_offline ? ($currentPlan->offline_download_limit ?? null) : 0,
                    'high_quality' => (bool) $currentPlan->is_highquality,
                    'exclusive_content' => (bool) $currentPlan->is_exclusivecontent,
                    'tip_artists' => (bool) $currentPlan->is_tip_artists,
                    'personalized_recommendations' => (bool) $currentPlan->is_personalized_recommendations,
                    'supporter_badge' => (bool) $currentPlan->is_supporter_badge,
                    'trending_access' => (bool) ($currentPlan->is_trending_access ?? true),
                ];
            } else {
                // Free plan features
                $subscriptionFeatures = [
                    'ad_free' => false,
                    'unlimited_playlists' => false,
                    'playlist_limit' => 3,
                    'offline_downloads' => false,
                    'offline_download_limit' => 0,
                    'high_quality' => false,
                    'exclusive_content' => false,
                    'tip_artists' => false,
                    'personalized_recommendations' => false,
                    'supporter_badge' => false,
                    'trending_access' => true,
                ];
            }
        }

        // Get user's downloaded songs count for display
        $downloadedSongsCount = 0;
        $downloadLimit = null;
        if (auth()->check()) {
            $user = auth()->user();
            $downloadedSongsCount = \App\Models\UserOfflineDownload::where('user_id', $user->id)->count();
            $downloadLimit = $user->getOfflineDownloadLimit();
        }

        return view('frontend.user.user-portal', compact(
            'user_subscription_plans', 
            'currentSubscription',
            'currentPlan',
            'subscriptionFeatures',
            'userStats',
            'downloadedSongsCount',
            'downloadLimit'
        ));
    }

}