<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketplaceItem extends Model
{
    use HasFactory;

    protected $table = 'marketplace_items';

    protected $fillable = [
        'artist_id',
        'item_type',
        'title',
        'description',
        'price',
        'price_currency',
        'accept_credits',
        'credits_price',
        'media_file',
        'thumbnail_image',
        'demo_file',
        'category',
        'tags',
        'license_type',
        'status',
        'view_count',
        'purchase_count',
        'rating',
        'review_count',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'credits_price' => 'decimal:2',
        'accept_credits' => 'boolean',
        'view_count' => 'integer',
        'purchase_count' => 'integer',
        'review_count' => 'integer',
        'rating' => 'decimal:2',
        'tags' => 'array',
    ];

    public function artist()
    {
        return $this->belongsTo(User::class, 'artist_id');
    }

    public function purchases()
    {
        return $this->hasMany(MarketplacePurchase::class, 'item_id');
    }

    public function reviews()
    {
        return $this->hasMany(MarketplaceReview::class, 'item_id');
    }

    public function collaborationRequests()
    {
        return $this->hasMany(CollaborationRequest::class, 'item_id');
    }
}
