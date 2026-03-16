<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelationshipSection extends Model
{
    protected $table = 'relationship_sections';

    protected $fillable = [
        'relationship_tab_title',
        'relationship_heading',
        'relationship_subheading',
        'relationship_ios_link',
        'relationship_android_link',
    ];
}
