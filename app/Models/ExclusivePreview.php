<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExclusivePreview extends Model
{
    use HasFactory;

    protected $table = 'exclusive_previews';

    protected $fillable = [
        'artist_id',
        'music_id',
        'title',
        'description',
        'preview_type',
        'media_url',
        'thumbnail_url',
        'access_type',
        'release_date',
        'expiry_date',
        'view_count',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'view_count' => 'integer',
        'release_date' => 'datetime',
        'expiry_date' => 'datetime',
    ];

    public function artist()
    {
        return $this->belongsTo(User::class, 'artist_id');
    }

    public function music()
    {
        return $this->belongsTo(ArtistMusic::class, 'music_id');
    }

    public function accessLogs()
    {
        return $this->hasMany(PreviewAccessLog::class, 'preview_id');
    }
}
