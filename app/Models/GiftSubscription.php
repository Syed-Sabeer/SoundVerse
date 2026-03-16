<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftSubscription extends Model
{
    use HasFactory;

    protected $table = 'gift_subscriptions';

    protected $fillable = [
        'gifter_id',
        'recipient_id',
        'subscription_plan_id',
        'gift_message',
        'duration_months',
        'amount',
        'currency',
        'payment_method',
        'payment_id',
        'status',
        'activation_date',
        'expiry_date',
        'gifted_at',
        'activated_at',
    ];

    protected $casts = [
        'duration_months' => 'integer',
        'amount' => 'decimal:2',
        'activation_date' => 'date',
        'expiry_date' => 'date',
        'gifted_at' => 'datetime',
        'activated_at' => 'datetime',
    ];

    public function gifter()
    {
        return $this->belongsTo(User::class, 'gifter_id');
    }

    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    public function subscriptionPlan()
    {
        return $this->belongsTo(UserSubscriptionPlan::class, 'subscription_plan_id');
    }
}
