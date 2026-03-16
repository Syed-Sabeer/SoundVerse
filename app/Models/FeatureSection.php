<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeatureSection extends Model
{
    protected $table = 'feature_sections';

    protected $fillable = [
        'feature_badge',
        'feature_heading',
        'feature_subheading',
        'feature_image',
    ];
}
