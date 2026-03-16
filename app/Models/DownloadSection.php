<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DownloadSection extends Model
{
    protected $table = 'download_sections';

    protected $fillable = [
        'download_heading',
        'download_subject',
        'download_image_1',
        'download_image_2',
        'download_image_3',
        'app_store_link',
        'play_store_link',
    ];
}
