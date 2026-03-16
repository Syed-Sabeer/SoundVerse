<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceArtworkPhoto extends Model
{
 
    protected $table = 'service_artworkphoto';

    protected $fillable = [
        'icon',
        'title',
        'description',
    ];

   
    public $timestamps = true;
}
