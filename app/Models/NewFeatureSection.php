<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewFeatureSection extends Model
{
    protected $table = 'new_feature_sections';

    protected $fillable = [
        'new_feature_title_badge',
        'new_feature_heading',
        'new_feature_subheading',
    ];
}
