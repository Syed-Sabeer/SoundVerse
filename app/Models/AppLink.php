<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppLink extends Model
{
    protected $fillable = [
        'play_store_link',
        'app_store_link',
    ];
}
