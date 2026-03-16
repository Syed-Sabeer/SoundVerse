<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtistSubscription extends Model
{
    use HasFactory;

    protected $table = 'artist_subscriptions';

    protected $fillable = [
        'user_id',
        'artist_subscription_plan_id',
        'subscription_date',
        'subscription_duration',
        'payment_method',
        'payment_id'
    ];

    protected $casts = [
        'subscription_date' => 'datetime',
        'subscription_duration' => 'integer',
    ];

    /**
     * Get the user (artist) that owns the subscription
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the subscription plan details
     */
    public function subscriptionPlan()
    {
        return $this->belongsTo(ArtistSubscriptionPlan::class, 'artist_subscription_plan_id', 'id');
    }

    /**
     * Check if subscription is active
     */
    public function isActive()
    {
        if (!$this->subscription_date || !$this->subscription_duration) {
            return false;
        }

        $endDate = $this->subscription_date->copy()->addDays($this->subscription_duration);
        return now()->isBefore($endDate);
    }

    /**
     * Get subscription end date
     */
    public function getEndDateAttribute()
    {
        if (!$this->subscription_date || !$this->subscription_duration) {
            return null;
        }

        return $this->subscription_date->copy()->addDays($this->subscription_duration);
    }

    /**
     * Get days remaining
     */
    public function getDaysRemainingAttribute()
    {
        if (!$this->isActive()) {
            return 0;
        }

        $endDate = $this->end_date;
        return now()->diffInDays($endDate, false);
    }
}
