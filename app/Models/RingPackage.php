<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RingPackage extends Model
{
    protected $table = 'ring_packages';
    
    protected $fillable = [
        'package_name',
        'sub_package_name',
        'sub_package_price',
        'sub_package_subtitle',
        'sub_package_couples',
        'sub_package_rings',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    

public function getSubPackageNameAttribute($value)
{
    return json_decode($value, true);
}

public function getSubPackagePriceAttribute($value)
{
    return json_decode($value, true);
}

public function getSubPackageSubtitleAttribute($value)
{
    return json_decode($value, true);
}

public function getSubPackageCouplesAttribute($value)
{
    return json_decode($value, true);
}

public function getSubPackageRingsAttribute($value)
{
    return json_decode($value, true);
}

}
