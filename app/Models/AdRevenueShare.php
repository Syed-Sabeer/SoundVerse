<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdRevenueShare extends Model
{
    use HasFactory;

    protected $table = 'ad_revenue_shares';

    protected $fillable = [
        'artist_id',
        'ad_id',
        'period_date',
        'total_ad_impressions',
        'total_ad_clicks',
        'total_ad_revenue',
        'artist_share_percentage',
        'artist_share_amount',
        'platform_share_amount',
        'status',
        'paid_at',
    ];

    protected $casts = [
        'total_ad_impressions' => 'integer',
        'total_ad_clicks' => 'integer',
        'total_ad_revenue' => 'decimal:2',
        'artist_share_percentage' => 'decimal:2',
        'artist_share_amount' => 'decimal:2',
        'platform_share_amount' => 'decimal:2',
        'period_date' => 'date',
        'paid_at' => 'datetime',
    ];

    public function artist()
    {
        return $this->belongsTo(User::class, 'artist_id');
    }

    public function ad()
    {
        return $this->belongsTo(Ad::class, 'ad_id');
    }
}
