<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegalDocument extends Model
{
    use HasFactory;

    protected $table = 'legal_documents';

    protected $fillable = [
        'document_type',
        'title',
        'slug',
        'content',
        'version',
        'is_active',
        'is_required',
        'effective_date',
        'expiry_date',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_required' => 'boolean',
        'effective_date' => 'date',
        'expiry_date' => 'date',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function versions()
    {
        return $this->hasMany(DocumentVersion::class, 'document_id');
    }

    public function userAgreements()
    {
        return $this->hasMany(UserAgreement::class, 'document_id');
    }

    public function artistAgreements()
    {
        return $this->hasMany(ArtistAgreement::class, 'document_id');
    }
}
