<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketplaceReview extends Model
{
    use HasFactory;

    protected $table = 'marketplace_reviews';

    protected $fillable = [
        'item_id',
        'purchase_id',
        'buyer_id',
        'rating',
        'review_text',
        'is_verified_purchase',
        'helpful_count',
        'status',
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_verified_purchase' => 'boolean',
        'helpful_count' => 'integer',
    ];

    public function item()
    {
        return $this->belongsTo(MarketplaceItem::class, 'item_id');
    }

    public function purchase()
    {
        return $this->belongsTo(MarketplacePurchase::class, 'purchase_id');
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }
}
