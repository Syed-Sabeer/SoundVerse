<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditRedemption extends Model
{
    use HasFactory;

    protected $table = 'credit_redemptions';

    protected $fillable = [
        'user_id',
        'redemption_type',
        'item_id',
        'credits_spent',
        'value_received',
        'status',
        'redeemed_at',
        'expires_at',
    ];

    protected $casts = [
        'credits_spent' => 'decimal:2',
        'value_received' => 'decimal:2',
        'redeemed_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
