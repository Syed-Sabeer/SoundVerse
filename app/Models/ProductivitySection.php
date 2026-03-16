<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductivitySection extends Model
{
    protected $table = 'productivity_sections';

    protected $fillable = [
        'productivity_tab_title',
        'productivity_heading',
        'productivity_subheading',
        'productivity_image',
        'productivity_k_heading_1',
        'productivity_k_description_1',
        'productivity_k_heading_2',
        'productivity_k_description_2',
        'productivity_k_heading_3',
        'productivity_k_description_3',
        'productivity_k_heading_4',
        'productivity_k_description_4',
    ];
}
