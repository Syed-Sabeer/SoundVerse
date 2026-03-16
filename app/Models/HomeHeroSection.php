<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeHeroSection extends Model
{
    protected $table = 'home_hero_sections';

    protected $fillable = [
        'heading',
        'description',
        'button_link',
        'bg_image',
        'song_image',
        'song_name',
        'song_album',
        'song',
        'pc_image_1',
        'pc_image_2',
        'pc_image_3',
        'pc_image_4'
    ];
}
