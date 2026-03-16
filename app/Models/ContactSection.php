<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSection extends Model
{
    protected $table = 'contact_sections';

    protected $fillable = [
        'contact_sections_tab_title',
        'contact_sections_heading',
        'contact_sections_description',
        'contact_sections_social1',
        'contact_sections_social2',
        'contact_sections_social3',
        'contact_sections_social4',
        'contact_sections_point1',
        'contact_sections_point2',
        'contact_sections_point3',
    ];
}
