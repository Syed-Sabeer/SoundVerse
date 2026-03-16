<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackCollaboration extends Model
{
    use HasFactory;

    protected $table = 'track_collaborations';

    protected $fillable = [
        'music_id',
        'primary_artist_id',
        'collaboration_type',
        'status',
        'total_ownership_percentage',
        'is_verified',
        'verified_at',
    ];

    protected $casts = [
        'total_ownership_percentage' => 'decimal:2',
        'is_verified' => 'boolean',
        'verified_at' => 'datetime',
    ];

    public function music()
    {
        return $this->belongsTo(ArtistMusic::class, 'music_id');
    }

    public function primaryArtist()
    {
        return $this->belongsTo(User::class, 'primary_artist_id');
    }

    public function ownershipSplits()
    {
        return $this->hasMany(OwnershipSplit::class, 'collaboration_id');
    }

    public function revenueDistributions()
    {
        return $this->hasMany(CollaborationRevenueDistribution::class, 'collaboration_id');
    }

    /**
     * Get total ownership percentage from splits
     */
    public function getTotalOwnershipFromSplits()
    {
        return $this->ownershipSplits()->sum('ownership_percentage');
    }

    /**
     * Check if ownership splits total 100%
     */
    public function isOwnershipComplete()
    {
        $total = $this->getTotalOwnershipFromSplits();
        return abs($total - 100.00) < 0.01; // Allow for small floating point differences
    }

    /**
     * Check if all artists have approved their splits
     */
    public function areAllSplitsApproved()
    {
        return $this->ownershipSplits()->where('approved_by_artist', false)->count() === 0;
    }
}
