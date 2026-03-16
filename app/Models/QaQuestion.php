<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QaQuestion extends Model
{
    use HasFactory;

    protected $table = 'qa_questions';

    protected $fillable = [
        'qa_session_id',
        'user_id',
        'question',
        'answer',
        'answered_at',
        'is_featured',
        'upvotes',
        'status',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'upvotes' => 'integer',
        'answered_at' => 'datetime',
    ];

    public function qaSession()
    {
        return $this->belongsTo(ArtistQaSession::class, 'qa_session_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
