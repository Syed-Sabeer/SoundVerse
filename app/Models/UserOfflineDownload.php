<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOfflineDownload extends Model
{
    use HasFactory;

    protected $table = 'user_offline_downloads';

    protected $fillable = [
        'user_id',
        'music_id',
        'file_size',
    ];

    protected $casts = [
        'downloaded_at' => 'datetime',
        'file_size' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function music()
    {
        return $this->belongsTo(ArtistMusic::class, 'music_id');
    }
}
