<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BorderSection extends Model
{
    protected $table = 'border_sections';

    protected $fillable = [
        'border_tab_title',
        'border_heading',
        'border_subheading',
        'border_north_america',
        'border_south_america',
        'border_africa',
        'border_north_europe',
        'border_asia',
        'border_australia',
    ];
}
