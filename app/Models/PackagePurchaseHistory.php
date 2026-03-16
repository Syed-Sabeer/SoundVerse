<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackagePurchaseHistory extends Model
{
    protected $table = 'package_purchase_histories';

    protected $fillable = [
        'seller_id',
        'seller_package_id',
        'package',
        'price',
        'payment_type',
    ];

    protected $casts = [
        'seller_id' => 'integer',
        'seller_package_id' => 'integer',
        'price' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function sellerPackage()
    {
        return $this->belongsTo(SellerPackage::class, 'seller_package_id');
    }
}

