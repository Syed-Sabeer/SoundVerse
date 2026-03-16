<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TetherheartSection extends Model
{
    protected $table = 'tetherheart_sections';

    protected $fillable = [
        'tetherheart_title_badge',
        'tetherheart_heading',
        'tetherheart_description',
    ];
}
