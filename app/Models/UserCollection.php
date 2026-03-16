<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCollection extends Model
{
    use HasFactory;
    protected $table = 'user_collections';
    
    protected $fillable = [
        'user_id',
        'music_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function music()
    {
        return $this->belongsTo(ArtistMusic::class, 'music_id');
    }

    
}
