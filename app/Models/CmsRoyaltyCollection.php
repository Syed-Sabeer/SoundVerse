<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsRoyaltyCollection extends Model
{
   
    protected $table = 'cms_royaltycollections';

    protected $fillable = [
        'title',
        'value',
        'title2',
        'value2',
        'title3',
        'value3',
        'title4',
        'value4',
    ];

  
    public $timestamps = true;
}
