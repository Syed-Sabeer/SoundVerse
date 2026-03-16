<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingAgreementNotification extends Model
{
    use HasFactory;

    protected $table = 'pending_agreement_notifications';

    protected $fillable = [
        'user_id',
        'artist_id',
        'document_id',
        'notification_sent_at',
        'reminder_count',
        'last_reminder_at',
        'status',
    ];

    protected $casts = [
        'notification_sent_at' => 'datetime',
        'last_reminder_at' => 'datetime',
        'reminder_count' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function artist()
    {
        return $this->belongsTo(User::class, 'artist_id');
    }

    public function document()
    {
        return $this->belongsTo(LegalDocument::class, 'document_id');
    }
}
