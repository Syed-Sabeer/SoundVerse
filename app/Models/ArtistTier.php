<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtistTier extends Model
{
    use HasFactory;

    protected $table = 'artist_tiers';

    protected $fillable = [
        'name',
        'description',
        'min_streams',
        'min_revenue',
        'royalty_percentage',
        'platform_fee_percentage',
        'benefits',
        'is_active',
    ];

    protected $casts = [
        'min_streams' => 'integer',
        'min_revenue' => 'decimal:2',
        'royalty_percentage' => 'decimal:2',
        'platform_fee_percentage' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function assignments()
    {
        return $this->hasMany(ArtistTierAssignment::class, 'tier_id');
    }
}
