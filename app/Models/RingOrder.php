<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RingOrder extends Model
{
    protected $table = 'ring_orders';

    protected $fillable = [
        'package_detail',
        'female_rings',
        'male_rings',
        'female_ring_size',
        'male_ring_size',
        'subscription_plan',
        'subscription_detail',
        'price',
        'fullname',
        'email',
        'phone',
        'partner_name',
        'address',
        'payment_method',
        'payment_id',
        'is_gift'
    ];

    protected $casts = [
        'package_detail' => 'array',
        'subscription_plan' => 'array',
        'subscription_detail' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'price' => 'float',
    ];
}
