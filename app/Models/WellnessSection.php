<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WellnessSection extends Model
{
    protected $table = 'wellness_sections';

    protected $fillable = [
        'wellness_tab_title',
        'wellness_heading',
        'wellness_subheading',
        'wellness_card_text',
    ];
}
