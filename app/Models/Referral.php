<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    use HasFactory;

    protected $table = 'referrals';

    protected $fillable = [
        'referrer_id',
        'referred_id',
        'referral_code',
        'credits_earned',
        'status',
        'completed_at',
        'rewarded_at',
    ];

    protected $casts = [
        'credits_earned' => 'decimal:2',
        'completed_at' => 'datetime',
        'rewarded_at' => 'datetime',
    ];

    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_id');
    }

    public function referred()
    {
        return $this->belongsTo(User::class, 'referred_id');
    }
}
