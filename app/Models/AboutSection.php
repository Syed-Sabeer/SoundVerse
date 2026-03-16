<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    use HasFactory;

    protected $table = 'about_sections';

    protected $fillable = [
        'about_heading',
        'about_description_1',
        'about_description_2',
        'about_button_link',
        'about_image_1',
        'about_image_2',
     
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
} 