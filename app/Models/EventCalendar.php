<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventCalendar extends Model
{
    use HasFactory;

    protected $table = 'event_calendars';

    protected $fillable = [
        'user_id',
        'title',
        'date',
    ];

    // If 'date' should be treated as a date instance
    protected $casts = [
        'date' => 'datetime',
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
