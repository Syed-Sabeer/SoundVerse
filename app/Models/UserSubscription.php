<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    use HasFactory;

    protected $table = 'user_subscriptions';

    protected $fillable = [
        'user_id',
        'usersubscription_id',
        'usersubscription_date',
        'usersubscription_duration',
        'payment_method',
        'payment_id'
    ];

    protected $casts = [
        'usersubscription_date' => 'datetime',
        'usersubscription_duration' => 'integer',
    ];

    /**
     * Get the user that owns the subscription
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
        return $this->belongsTo(UserSubscriptionPlan::class, 'usersubscription_id', 'id');
    }

    /**
     * Check if subscription is active
     */
    public function isActive()
    {
        if (!$this->usersubscription_date || !$this->usersubscription_duration) {
            return false;
        }

        // Create a copy to avoid modifying the original date
        $startDate = \Carbon\Carbon::parse($this->usersubscription_date);
        $endDate = $startDate->copy()->addDays($this->usersubscription_duration);
        return now()->isBefore($endDate);
    }

    /**
     * Get subscription end date
     */
    public function getEndDateAttribute()
    {
        if (!$this->usersubscription_date || !$this->usersubscription_duration) {
            return null;
        }

        return $this->usersubscription_date->addDays($this->usersubscription_duration);
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
