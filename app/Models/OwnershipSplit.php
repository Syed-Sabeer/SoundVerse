<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OwnershipSplit extends Model
{
    use HasFactory;

    protected $table = 'ownership_splits';

    protected $fillable = [
        'collaboration_id',
        'artist_id',
        'ownership_percentage',
        'role',
        'contribution_type',
        'is_primary',
        'approved_by_artist',
        'approved_at',
    ];

    protected $casts = [
        'ownership_percentage' => 'decimal:2',
        'is_primary' => 'boolean',
        'approved_by_artist' => 'boolean',
        'approved_at' => 'datetime',
    ];

    public function collaboration()
    {
        return $this->belongsTo(TrackCollaboration::class, 'collaboration_id');
    }

    public function artist()
    {
        return $this->belongsTo(User::class, 'artist_id');
    }
}
