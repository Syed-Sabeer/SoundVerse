<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtistSubscriptionPlan extends Model
{
    use HasFactory;

    protected $table = 'artist_subscription_plans';

    protected $fillable = [
        'plan_name',
        'plan_slug',
        'monthly_fee',
        'currency',
        'ideal_for',
        'description',
        'songs_per_month',
        'is_unlimited_uploads',
        'is_featured_rotation',
        'featured_rotation_weeks',
        'is_priority_search',
        'is_custom_banner',
        'is_isrc_codes',
        'is_early_access_insights',
        'is_certified_badge',
        'is_showcase_placement',
        'is_royalty_tracking',
        'is_playlist_highlighted',
        'is_advanced_analytics',
        'is_showcase_invitations',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'monthly_fee' => 'decimal:2',
        'songs_per_month' => 'integer',
        'is_unlimited_uploads' => 'boolean',
        'is_featured_rotation' => 'boolean',
        'featured_rotation_weeks' => 'integer',
        'is_priority_search' => 'boolean',
        'is_custom_banner' => 'boolean',
        'is_isrc_codes' => 'boolean',
        'is_early_access_insights' => 'boolean',
        'is_certified_badge' => 'boolean',
        'is_showcase_placement' => 'boolean',
        'is_royalty_tracking' => 'boolean',
        'is_playlist_highlighted' => 'boolean',
        'is_advanced_analytics' => 'boolean',
        'is_showcase_invitations' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get formatted monthly fee
     */
    public function getFormattedFeeAttribute()
    {
        return number_format($this->monthly_fee, 2) . ' ' . $this->currency . '/month';
    }

    /**
     * Get users subscribed to this plan
     */
    public function subscribedUsers()
    {
        return $this->hasMany(User::class, 'usersubscription_id', 'id')
            ->where('is_artist', true);
    }
}
