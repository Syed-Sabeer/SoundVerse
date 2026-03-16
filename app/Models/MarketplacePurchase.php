<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketplacePurchase extends Model
{
    use HasFactory;

    protected $table = 'marketplace_purchases';

    protected $fillable = [
        'item_id',
        'buyer_id',
        'seller_id',
        'price',
        'payment_method',
        'cash_amount',
        'credits_amount',
        'platform_fee',
        'artist_earnings',
        'license_type',
        'download_url',
        'download_expires_at',
        'status',
        'transaction_id',
        'purchased_at',
        'completed_at',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'cash_amount' => 'decimal:2',
        'credits_amount' => 'decimal:2',
        'platform_fee' => 'decimal:2',
        'artist_earnings' => 'decimal:2',
        'purchased_at' => 'datetime',
        'completed_at' => 'datetime',
        'download_expires_at' => 'datetime',
    ];

    public function item()
    {
        return $this->belongsTo(MarketplaceItem::class, 'item_id');
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function review()
    {
        return $this->hasOne(MarketplaceReview::class, 'purchase_id');
    }
}
