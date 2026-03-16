<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ring extends Model
{
    use SoftDeletes;

    protected $table = 'rings';

    protected $fillable = [
        'icon',
        'title',
        'rings_count',
        'description',
        'includes',
        'price',
        'couples_connected'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];


}
