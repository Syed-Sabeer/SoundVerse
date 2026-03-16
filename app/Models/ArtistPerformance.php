<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtistPerformance extends Model
{
    use HasFactory;

    protected $table = 'artist_performance';

    protected $fillable = [
        'artist_id',
        'period_type',
        'period_date',
        'total_streams',
        'total_downloads',
        'total_revenue',
        'platform_revenue',
        'artist_revenue',
        'growth_rate',
        'top_country',
        'top_genre',
        'new_listeners',
        'returning_listeners',
    ];

    protected $casts = [
        'total_streams' => 'integer',
        'total_downloads' => 'integer',
        'total_revenue' => 'decimal:2',
        'platform_revenue' => 'decimal:2',
        'artist_revenue' => 'decimal:2',
        'growth_rate' => 'decimal:2',
        'new_listeners' => 'integer',
        'returning_listeners' => 'integer',
        'period_date' => 'date',
    ];

    public function artist()
    {
        return $this->belongsTo(User::class, 'artist_id');
    }
}
