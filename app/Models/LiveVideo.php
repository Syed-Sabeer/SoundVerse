<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveVideo extends Model
{
    use HasFactory;
    protected $table = 'live_videos';

    protected $fillable = [
        'title',
        'video',
        'views',
        'visibility',
    ];
}
