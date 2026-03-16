<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRoyaltyCollection extends Model
{
   
    protected $table = 'service_royaltycollection';

 
    protected $fillable = [
        'icon',
        'title',
        'description',
        'include',
        'button_link',
    ];

    
    public $timestamps = true;
}
