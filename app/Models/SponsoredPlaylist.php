<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SponsoredPlaylist extends Model
{
    use HasFactory;

    protected $table = 'sponsored_playlists';

    protected $fillable = [
        'brand_partnership_id',
        'title',
        'description',
        'playlist_image',
        'curator_id',
        'is_featured',
        'view_count',
        'like_count',
        'status',
        'published_at',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'view_count' => 'integer',
        'like_count' => 'integer',
        'published_at' => 'datetime',
    ];

    public function brandPartnership()
    {
        return $this->belongsTo(BrandPartnership::class, 'brand_partnership_id');
    }

    public function curator()
    {
        return $this->belongsTo(User::class, 'curator_id');
    }

    public function items()
    {
        return $this->hasMany(SponsoredPlaylistItem::class, 'playlist_id');
    }
}
