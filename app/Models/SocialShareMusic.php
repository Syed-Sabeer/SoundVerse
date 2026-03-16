<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialShareMusic extends Model
{
    use HasFactory;

    protected $table = 'social_share_musics';

    protected $fillable = [
        'title',
        'link',
        'image',
        'visibility',
    ];

    protected $casts = [
        'visibility' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
