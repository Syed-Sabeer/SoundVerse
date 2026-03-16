<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SponsoredPlaylistItem extends Model
{
    use HasFactory;

    protected $table = 'sponsored_playlist_items';

    protected $fillable = [
        'playlist_id',
        'music_id',
        'position',
    ];

    protected $casts = [
        'position' => 'integer',
    ];

    public function playlist()
    {
        return $this->belongsTo(SponsoredPlaylist::class, 'playlist_id');
    }

    public function music()
    {
        return $this->belongsTo(ArtistMusic::class, 'music_id');
    }
}
