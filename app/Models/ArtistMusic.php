<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtistMusic extends Model
{
    use HasFactory;

    protected $table = 'artist_musics';
    protected $fillable = [
        'name',
        'driver_id',
        'music_file',
        'video_file',
        'thumbnail_image',
        'listeners',
        'is_featured',
        'isrc_code',
        'duration',
    ];

    protected $casts = [
        'listeners' => 'integer',
        'is_featured' => 'boolean',
    ];

    // Relationship with User (driver_id refers to user_id)
    public function user()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    // Accessor for music file URL
    public function getMusicFileUrlAttribute()
    {
        if ($this->music_file) {
            // Remove any existing storage/ or public/storage/ or public/ prefix to avoid duplication
            $path = $this->music_file;
            $path = preg_replace('#^(storage/|public/storage/|public/)#', '', $path);
            
            // Return path with /public/storage/ prefix
            return '/public/storage/' . $path;
        }
        return null;
    }

    // Accessor for video file URL
    public function getVideoFileUrlAttribute()
    {
        if ($this->video_file) {
            // Remove any existing storage/ or public/ prefix to avoid duplication
            $path = $this->video_file;
            $path = preg_replace('#^(storage/|public/storage/|public/)#', '', $path);
            
            // Ensure it starts with storage/ for proper asset generation
            if (strpos($path, 'storage/') !== 0) {
                $path = 'storage/' . $path;
            }
            
            // Use asset() helper to generate proper URL
            return asset($path);
        }
        return null;
    }

    // Accessor for thumbnail image URL
    public function getThumbnailImageUrlAttribute()
    {
        if ($this->thumbnail_image) {
            // Remove any existing storage/ or public/ prefix to avoid duplication
            $path = $this->thumbnail_image;
            $path = preg_replace('#^(storage/|public/storage/|public/)#', '', $path);
            
            // Ensure it starts with storage/ for proper asset generation
            if (strpos($path, 'storage/') !== 0) {
                $path = 'storage/' . $path;
            }
            
            // Use asset() helper to generate proper URL
            return asset($path);
        }
        return null;
    }

    // Relationships for analytics
    public function streamStats()
    {
        return $this->hasMany(StreamStat::class, 'music_id');
    }

    public function downloadStats()
    {
        return $this->hasMany(DownloadStat::class, 'music_id');
    }

    public function earnings()
    {
        return $this->hasMany(ArtistEarning::class, 'music_id');
    }

    public function collaboration()
    {
        return $this->hasOne(TrackCollaboration::class, 'music_id');
    }

    public function isCollaborative()
    {
        return $this->collaboration !== null;
    }
}
