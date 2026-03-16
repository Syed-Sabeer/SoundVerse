<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollaborationRevenueDistribution extends Model
{
    use HasFactory;

    protected $table = 'collaboration_revenue_distributions';

    protected $fillable = [
        'collaboration_id',
        'music_id',
        'artist_id',
        'ownership_percentage',
        'total_revenue',
        'platform_fee',
        'artist_share_before_split',
        'artist_share_after_split',
        'period_date',
        'stream_count',
        'status',
        'paid_at',
    ];

    protected $casts = [
        'ownership_percentage' => 'decimal:2',
        'total_revenue' => 'decimal:2',
        'platform_fee' => 'decimal:2',
        'artist_share_before_split' => 'decimal:2',
        'artist_share_after_split' => 'decimal:2',
        'stream_count' => 'integer',
        'period_date' => 'date',
        'paid_at' => 'datetime',
    ];

    public function collaboration()
    {
        return $this->belongsTo(TrackCollaboration::class, 'collaboration_id');
    }

    public function music()
    {
        return $this->belongsTo(ArtistMusic::class, 'music_id');
    }

    public function artist()
    {
        return $this->belongsTo(User::class, 'artist_id');
    }
}
