<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerPackage extends Model
{
    protected $table = 'seller_packages';

    protected $fillable = [
        'name',
        'amount',
        'product_upload',
        'digital_product_upload',
        'flash_deal_product_limit',
        'daily_deal_product_limit',
        'duration',
        'duration_type',
        'description',
        'logo',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'product_upload' => 'integer',
        'digital_product_upload' => 'integer',
        'flash_deal_product_limit' => 'integer',
        'daily_deal_product_limit' => 'integer',
        'duration' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}

