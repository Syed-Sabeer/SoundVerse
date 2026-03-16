<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConnectionSection extends Model
{
    protected $table = 'connection_sections';

    protected $fillable = [
        'connection_heading',
        'connection_card_1_h',
        'connection_card_1_p',
        'connection_card_2_h',
        'connection_card_2_p',
        'connection_card_3_h',
        'connection_card_3_p',
        'connection_main_card_h',
        'connection_main_card_p1',
        'connection_main_card_p2',
    ];
}
