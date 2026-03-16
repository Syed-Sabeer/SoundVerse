<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceArtistSubscription extends Model
{
 
    protected $table = 'service_artistsubscription';
  
    protected $fillable = [
        'title',
        'description',
    ];

   
    public $timestamps = true;
}
