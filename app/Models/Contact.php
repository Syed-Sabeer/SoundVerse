<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';

    protected $fillable = [
        'contact_heading',
        'contact_subheading',
        'contact_email',
        'contact_call',
        'contact_visit',
        'contact_map_heading',
        'contact_map_link',
    ];
}
