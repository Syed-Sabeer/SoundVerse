<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Auth\Notifications\ResetPassword;

class User  extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'email_verified_at',
        'password',
        'phone',
        'address',
        'is_active',
        'provider',
        'provider_id',
        'is_artist',
        'is_featured',
        'usersubscription_id',
        'usersubscription_date',
        'usersubscription_duration',
        'referral_code',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_artist' => 'boolean',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ];
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * Followers/subscribers of this artist
     */
    public function artistFollowers()
    {
        return $this->hasMany(ArtistFollower::class, 'artist_id');
    }

    /**
     * Artists this user is following/subscribed to
     */
    public function followingArtists()
    {
        return $this->hasMany(ArtistFollower::class, 'follower_id');
    }

    /**
     * Convenience: get follower users (many-to-many)
     */
    public function followerUsers()
    {
        return $this->belongsToMany(User::class, 'artist_followers', 'artist_id', 'follower_id');
    }

    /**
     * Convenience: artists this user has subscribed to
     */
    public function subscribedArtists()
    {
        return $this->belongsToMany(User::class, 'artist_followers', 'follower_id', 'artist_id');
    }

    public function playlists()
    {
        return $this->hasMany(UserPlaylist::class);
    }

    public function offlineDownloads()
    {
        return $this->hasMany(UserOfflineDownload::class);
    }

    public function credits()
    {
        return $this->hasOne(UserCredit::class);
    }

    public function creditTransactions()
    {
        return $this->hasMany(CreditTransaction::class);
    }

    public function referrals()
    {
        return $this->hasMany(Referral::class, 'referrer_id');
    }

    public function artistSubscription()
    {
        return $this->hasOne(ArtistSubscription::class)->latest('subscription_date');
    }

    public function artistSubscriptions()
    {
        return $this->hasMany(ArtistSubscription::class);
    }

    /**
     * Get active artist subscription
     */
    public function getActiveArtistSubscriptionAttribute()
    {
        return $this->artistSubscriptions()
            ->where('subscription_date', '<=', now())
            ->whereRaw('DATE_ADD(subscription_date, INTERVAL subscription_duration DAY) >= NOW()')
            ->with('subscriptionPlan')
            ->latest('subscription_date')
            ->first();
    }

    /**
     * Check if artist is a Certified Creator
     */
    public function isCertifiedCreator()
    {
        if (!$this->is_artist) {
            return false;
        }
        
        $subscription = $this->activeArtistSubscription;
        if (!$subscription || !$subscription->subscriptionPlan) {
            return false;
        }
        
        return (bool) $subscription->subscriptionPlan->is_certified_badge;
    }

    /**
     * Check if user has access to a specific artist feature
     */
    public function hasArtistFeature($feature)
    {
        $subscription = $this->activeArtistSubscription;
        
        if (!$subscription || !$subscription->subscriptionPlan) {
            return false;
        }
        
        $plan = $subscription->subscriptionPlan;
        
        // Features that should always be accessible (as per user request)
        $alwaysAccessible = [
            'profile_customization',
            'royalty_tracking'
        ];
        
        if (in_array($feature, $alwaysAccessible)) {
            return true;
        }
        
        // Map feature names to plan attributes
        $featureMap = [
            'unlimited_uploads' => 'is_unlimited_uploads',
            'featured_rotation' => 'is_featured_rotation',
            'priority_search' => 'is_priority_search',
            'custom_banner' => 'is_custom_banner',
            'isrc_codes' => 'is_isrc_codes',
            'early_access_insights' => 'is_early_access_insights',
            'certified_badge' => 'is_certified_badge',
            'showcase_placement' => 'is_showcase_placement',
            'playlist_highlighted' => 'is_playlist_highlighted',
            'advanced_analytics' => 'is_advanced_analytics',
            'showcase_invitations' => 'is_showcase_invitations',
        ];
        
        if (isset($featureMap[$feature])) {
            return (bool) $plan->{$featureMap[$feature]};
        }
        
        return false;
    }

    public function giftSubscriptionsSent()
    {
        return $this->hasMany(GiftSubscription::class, 'gifter_id');
    }

    public function giftSubscriptionsReceived()
    {
        return $this->hasMany(GiftSubscription::class, 'recipient_id');
    }

    /**
     * Get user subscriptions
     */
    public function userSubscriptions()
    {
        return $this->hasMany(UserSubscription::class);
    }

    /**
     * Get active user subscription
     */
    public function getActiveUserSubscriptionAttribute()
    {
        $subscriptions = $this->userSubscriptions()
            ->with('subscriptionPlan')
            ->latest('usersubscription_date')
            ->get();
        
        foreach ($subscriptions as $subscription) {
            if ($subscription->isActive()) {
                return $subscription;
            }
        }
        
        return null;
    }

    /**
     * Check if user has access to a specific feature
     */
    public function hasUserFeature($feature)
    {
        $subscription = $this->activeUserSubscription;
        
        if (!$subscription || !$subscription->subscriptionPlan) {
            // Free plan - check default features
            return $this->hasFreeFeature($feature);
        }
        
        $plan = $subscription->subscriptionPlan;
        
        // Map feature names to plan attributes
        $featureMap = [
            'ad_free' => 'is_ads',
            'unlimited_playlists' => 'is_unlimitedplaylist',
            'offline_downloads' => 'is_offline',
            'high_quality' => 'is_highquality',
            'exclusive_content' => 'is_exclusivecontent',
            'tip_artists' => 'is_tip_artists',
            'personalized_recommendations' => 'is_personalized_recommendations',
            'supporter_badge' => 'is_supporter_badge',
            'trending_access' => 'is_trending_access',
        ];
        
        if (isset($featureMap[$feature])) {
            return (bool) $plan->{$featureMap[$feature]};
        }
        
        return false;
    }

    /**
     * Check free plan features
     */
    private function hasFreeFeature($feature)
    {
        // Free plan features
        $freeFeatures = [
            'trending_access' => true, // Access trending & featured creators
        ];
        
        return $freeFeatures[$feature] ?? false;
    }

    /**
     * Get playlist limit for current subscription
     */
    public function getPlaylistLimit()
    {
        $subscription = $this->activeUserSubscription;
        
        if (!$subscription || !$subscription->subscriptionPlan) {
            return 3; // Free plan: 3 playlists
        }
        
        $plan = $subscription->subscriptionPlan;
        
        if ($plan->is_unlimitedplaylist) {
            return null; // Unlimited
        }
        
        return $plan->playlist_limit ?? 3;
    }

    /**
     * Get offline download limit for current subscription
     */
    public function getOfflineDownloadLimit()
    {
        $subscription = $this->activeUserSubscription;
        
        if (!$subscription || !$subscription->subscriptionPlan) {
            return 0; // Free plan: no offline downloads
        }
        
        $plan = $subscription->subscriptionPlan;
        
        if (!$plan->is_offline) {
            return 0;
        }
        
        // If offline_download_limit is null, it means unlimited
        return $plan->offline_download_limit ?? null;
    }

    /**
     * Check if user can create more playlists
     */
    public function canCreatePlaylist()
    {
        $limit = $this->getPlaylistLimit();
        
        if ($limit === null) {
            return true; // Unlimited
        }
        
        $currentCount = $this->playlists()->distinct('playlist_name')->count('playlist_name');
        return $currentCount < $limit;
    }

    /**
     * Get current subscription plan name
     */
    public function getCurrentSubscriptionPlanName()
    {
        $subscription = $this->activeUserSubscription;
        
        if (!$subscription || !$subscription->subscriptionPlan) {
            return 'Free Listener';
        }
        
        return $subscription->subscriptionPlan->title ?? 'Free Listener';
    }

    /**
     * Get song upload limit for current artist subscription
     */
    public function getSongUploadLimit()
    {
        if (!$this->is_artist) {
            return 0;
        }
        
        $subscription = $this->activeArtistSubscription;
        
        if (!$subscription || !$subscription->subscriptionPlan) {
            // Free plan: 3 songs per month
            return 3;
        }
        
        $plan = $subscription->subscriptionPlan;
        
        if ($plan->is_unlimited_uploads) {
            return null; // Unlimited
        }
        
        return $plan->songs_per_month ?? 3;
    }

    /**
     * Check if artist can upload more songs this month
     */
    public function canUploadSong()
    {
        if (!$this->is_artist) {
            return false;
        }
        
        $limit = $this->getSongUploadLimit();
        
        if ($limit === null) {
            return true; // Unlimited
        }
        
        $currentMonthStart = now()->startOfMonth();
        $currentMonthEnd = now()->endOfMonth();
        $uploadsThisMonth = \App\Models\ArtistMusic::where('driver_id', $this->id)
            ->whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])
            ->count();
        
        return $uploadsThisMonth < $limit;
    }

    /**
     * Get current artist subscription plan name
     */
    public function getCurrentArtistSubscriptionPlanName()
    {
        if (!$this->is_artist) {
            return 'Not an Artist';
        }
        
        $subscription = $this->activeArtistSubscription;
        
        if (!$subscription || !$subscription->subscriptionPlan) {
            return 'Starter Artist';
        }
        
        return $subscription->subscriptionPlan->plan_name ?? 'Starter Artist';
    }

    public function marketplaceItems()
    {
        return $this->hasMany(MarketplaceItem::class, 'artist_id');
    }

    public function marketplacePurchases()
    {
        return $this->hasMany(MarketplacePurchase::class, 'buyer_id');
    }

    public function qaSessions()
    {
        return $this->hasMany(ArtistQaSession::class, 'artist_id');
    }

    public function qaQuestions()
    {
        return $this->hasMany(QaQuestion::class);
    }

    public function exclusivePreviews()
    {
        return $this->hasMany(ExclusivePreview::class, 'artist_id');
    }

    public function artistWallet()
    {
        return $this->hasOne(ArtistWallet::class, 'artist_id');
    }

    public function artistEarnings()
    {
        return $this->hasMany(ArtistEarning::class, 'artist_id');
    }

    public function payoutRequests()
    {
        return $this->hasMany(PayoutRequest::class, 'artist_id');
    }

    /**
     * Get wallet balance (convenience method)
     */
    public function getWalletBalanceAttribute()
    {
        if (!$this->is_artist) {
            return 0;
        }
        $wallet = $this->artistWallet;
        return $wallet ? $wallet->available_balance : 0;
    }

    public static function generateUniqueConnectionCode()
    {
        do {
            // Generate a random 6-digit number with leading zeros if needed
            $code = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        } while (self::where('connection_code', $code)->exists());

        return $code;
    }
}
