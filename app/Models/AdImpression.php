<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdImpression extends Model
{
    use HasFactory;

    protected $table = 'ad_impressions';

    protected $fillable = [
        'ad_id',
        'artist_id',
        'music_id',
        'user_id',
        'impression_type',
        'ip_address',
        'country',
        'device_type',
        'viewed_at',
        'clicked',
        'clicked_at',
        'revenue',
    ];

    protected $casts = [
        'clicked' => 'boolean',
        'revenue' => 'decimal:4',
        'viewed_at' => 'datetime',
        'clicked_at' => 'datetime',
    ];

    public function ad()
    {
        return $this->belongsTo(Ad::class, 'ad_id');
    }

    public function artist()
    {
        return $this->belongsTo(User::class, 'artist_id');
    }

    public function music()
    {
        return $this->belongsTo(ArtistMusic::class, 'music_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
