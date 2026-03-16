<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StreamStat extends Model
{
    use HasFactory;

    protected $table = 'stream_stats';

    protected $fillable = [
        'music_id',
        'artist_id',
        'user_id',
        'stream_duration',
        'ip_address',
        'country',
        'city',
        'device_type',
        'platform',
        'is_complete',
        'streamed_at',
    ];

    protected $casts = [
        'stream_duration' => 'integer',
        'is_complete' => 'boolean',
        'streamed_at' => 'datetime',
    ];

    public function music()
    {
        return $this->belongsTo(ArtistMusic::class, 'music_id');
    }

    public function artist()
    {
        return $this->belongsTo(User::class, 'artist_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
