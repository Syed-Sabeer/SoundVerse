<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceMusicVideo extends Model
{
  
    protected $table = 'service_musicvideos';
    
    protected $fillable = [
        'icon',
        'title',
        'description',
        'include',
        'button_link',
    ];

    public $timestamps = true;
}
