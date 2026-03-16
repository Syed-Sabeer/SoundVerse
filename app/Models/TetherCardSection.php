<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TetherCardSection extends Model
{
    protected $table = 'tether_card_sections';

    protected $fillable = [
        'tether_card_heading',
        'tether_card_subheading',
    ];
}
