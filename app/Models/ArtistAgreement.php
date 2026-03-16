<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtistAgreement extends Model
{
    use HasFactory;

    protected $table = 'artist_agreements';

    protected $fillable = [
        'artist_id',
        'document_id',
        'document_version',
        'ip_address',
        'user_agent',
        'accepted_at',
    ];

    protected $casts = [
        'accepted_at' => 'datetime',
    ];

    public function artist()
    {
        return $this->belongsTo(User::class, 'artist_id');
    }

    public function document()
    {
        return $this->belongsTo(LegalDocument::class, 'document_id');
    }
}
