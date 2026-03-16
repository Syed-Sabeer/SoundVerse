<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentVersion extends Model
{
    use HasFactory;

    protected $table = 'document_versions';

    protected $fillable = [
        'document_id',
        'version',
        'content',
        'changes_summary',
        'effective_date',
        'created_by',
    ];

    protected $casts = [
        'effective_date' => 'date',
    ];

    public function document()
    {
        return $this->belongsTo(LegalDocument::class, 'document_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
