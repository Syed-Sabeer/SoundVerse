<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtistTip extends Model
{
    use HasFactory;

    protected $table = 'artist_tips';

    protected $fillable = [
        'user_id',
        'artist_id',
        'amount',
        'platform_fee',
        'total_amount',
        'payment_method',
        'payment_method_id',
        'status',
        'admin_notes',
        'user_message',
        'paid_at',
        'sent_to_artist_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'platform_fee' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'paid_at' => 'datetime',
        'sent_to_artist_at' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function artist()
    {
        return $this->belongsTo(User::class, 'artist_id');
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    public function scopeSentToArtist($query)
    {
        return $query->where('status', 'sent_to_artist');
    }
}
