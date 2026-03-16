<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtistQaSession extends Model
{
    use HasFactory;

    protected $table = 'artist_qa_sessions';

    protected $fillable = [
        'artist_id',
        'title',
        'description',
        'access_type',
        'scheduled_at',
        'started_at',
        'ended_at',
        'status',
        'max_participants',
        'current_participants',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'max_participants' => 'integer',
        'current_participants' => 'integer',
        'scheduled_at' => 'datetime',
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    public function artist()
    {
        return $this->belongsTo(User::class, 'artist_id');
    }

    public function questions()
    {
        return $this->hasMany(QaQuestion::class, 'qa_session_id');
    }
}
