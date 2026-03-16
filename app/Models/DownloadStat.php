<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadStat extends Model
{
    use HasFactory;

    protected $table = 'download_stats';

    protected $fillable = [
        'music_id',
        'artist_id',
        'user_id',
        'ip_address',
        'country',
        'city',
        'device_type',
        'platform',
        'downloaded_at',
    ];

    protected $casts = [
        'downloaded_at' => 'datetime',
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
