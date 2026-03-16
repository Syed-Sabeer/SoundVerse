<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wellness extends Model
{
    use HasFactory;

    protected $table = 'wellnesses';

    protected $fillable = [
        'title',
        'description',
        'image',
        'icon',
        'visibility',
    ];

    protected $casts = [
        'visibility' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
