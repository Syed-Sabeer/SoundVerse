<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceSupportNetworking extends Model
{
  
    protected $table = 'service_supportnetworking';

    protected $fillable = [
        'title',
        'description',
    ];

   
    public $timestamps = true;
}
