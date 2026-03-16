<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtistEarning extends Model
{
    use HasFactory;

    protected $table = 'artist_earnings';

    protected $fillable = [
        'artist_id',
        'music_id',
        'stream_id',
        'earnings_type',
        'gross_amount',
        'platform_fee',
        'net_amount',
        'currency',
        'royalty_percentage',
        'status',
        'period_date',
        'processed_at',
    ];

    protected $casts = [
        'gross_amount' => 'decimal:2',
        'platform_fee' => 'decimal:2',
        'net_amount' => 'decimal:2',
        'royalty_percentage' => 'decimal:2',
        'period_date' => 'date',
        'processed_at' => 'datetime',
    ];

    public function artist()
    {
        return $this->belongsTo(User::class, 'artist_id');
    }

    public function music()
    {
        return $this->belongsTo(ArtistMusic::class, 'music_id');
    }

    public function stream()
    {
        return $this->belongsTo(StreamStat::class, 'stream_id');
    }
}
