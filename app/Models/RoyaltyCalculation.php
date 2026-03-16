<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoyaltyCalculation extends Model
{
    use HasFactory;

    protected $table = 'royalty_calculations';

    protected $fillable = [
        'artist_id',
        'calculation_period',
        'total_streams',
        'total_downloads',
        'total_gross_revenue',
        'platform_fee_amount',
        'artist_royalty_amount',
        'royalty_percentage',
        'platform_fee_percentage',
        'status',
        'calculated_at',
        'notes',
    ];

    protected $casts = [
        'total_streams' => 'integer',
        'total_downloads' => 'integer',
        'total_gross_revenue' => 'decimal:2',
        'platform_fee_amount' => 'decimal:2',
        'artist_royalty_amount' => 'decimal:2',
        'royalty_percentage' => 'decimal:2',
        'platform_fee_percentage' => 'decimal:2',
        'calculation_period' => 'date',
        'calculated_at' => 'datetime',
    ];

    public function artist()
    {
        return $this->belongsTo(User::class, 'artist_id');
    }
}
