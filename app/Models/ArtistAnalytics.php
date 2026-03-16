<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtistAnalytics extends Model
{
    use HasFactory;

    protected $table = 'artist_analytics';

    protected $fillable = [
        'artist_id',
        'music_id',
        'stream_count',
        'download_count',
        'revenue',
        'period_type',
        'period_date',
        'genre',
        'country',
        'age_group',
        'gender',
    ];

    protected $casts = [
        'stream_count' => 'integer',
        'download_count' => 'integer',
        'revenue' => 'decimal:2',
        'period_date' => 'date',
    ];

    public function artist()
    {
        return $this->belongsTo(User::class, 'artist_id');
    }

    public function music()
    {
        return $this->belongsTo(ArtistMusic::class, 'music_id');
    }
}
