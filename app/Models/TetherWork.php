<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TetherWork extends Model
{
    use HasFactory;

    protected $table = 'tether_works';

    protected $fillable = [
        'image',
        'button_text',
        'windows_link',
        'apple_link',
        'android_link',
        'text',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
} 