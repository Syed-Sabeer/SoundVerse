<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreviewAccessLog extends Model
{
    use HasFactory;

    protected $table = 'preview_access_logs';

    protected $fillable = [
        'preview_id',
        'user_id',
        'accessed_at',
    ];

    protected $casts = [
        'accessed_at' => 'datetime',
    ];

    public function preview()
    {
        return $this->belongsTo(ExclusivePreview::class, 'preview_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
