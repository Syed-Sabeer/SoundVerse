<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollaborationRequest extends Model
{
    use HasFactory;

    protected $table = 'collaboration_requests';

    protected $fillable = [
        'item_id',
        'requester_id',
        'artist_id',
        'message',
        'proposed_budget',
        'status',
        'responded_at',
        'completed_at',
    ];

    protected $casts = [
        'proposed_budget' => 'decimal:2',
        'responded_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function item()
    {
        return $this->belongsTo(MarketplaceItem::class, 'item_id');
    }

    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_id');
    }

    public function artist()
    {
        return $this->belongsTo(User::class, 'artist_id');
    }
}
