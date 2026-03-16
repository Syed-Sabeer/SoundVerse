<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'message',
        'type',
        'notification_type',
        'title',
        'action_url',
        'metadata',
        'read_at',
        'sent_at',
        'delivered_at',
        'is_read',
    ];

    protected $casts = [
        'metadata' => 'array',
        'read_at' => 'datetime',
        'sent_at' => 'datetime',
        'delivered_at' => 'datetime',
        'is_read' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
