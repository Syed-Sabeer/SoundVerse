<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArtistFollower extends Model
{
    protected $fillable = [
        'artist_id',
        'follower_id',
    ];

    public function artist()
    {
        return $this->belongsTo(User::class, 'artist_id');
    }

    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }
}

