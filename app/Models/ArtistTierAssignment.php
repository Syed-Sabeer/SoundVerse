<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtistTierAssignment extends Model
{
    use HasFactory;

    protected $table = 'artist_tier_assignments';

    protected $fillable = [
        'artist_id',
        'tier_id',
        'assigned_at',
    ];

    protected $casts = [
        'assigned_at' => 'datetime',
    ];

    public function artist()
    {
        return $this->belongsTo(User::class, 'artist_id');
    }

    public function tier()
    {
        return $this->belongsTo(ArtistTier::class, 'tier_id');
    }
}
