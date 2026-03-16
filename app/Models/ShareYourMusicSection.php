<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShareYourMusicSection extends Model
{
    use HasFactory;
    protected $table = 'share_your_music_sections';
    
    protected $fillable = [
        'title',
        'description',
        'heading2',
        'description2',
        'button_link',
        'step1_title',
        'step1_description',
        'step2_title',
        'step2_description',
        'step3_title',
        'step3_description',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
}
