<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $table = 'ads';

    protected $fillable = [
        'title',
        'file',
        'link',
        'visibility'
    ];

    protected $casts = [
        'visibility' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Accessor for file URL
    public function getFileUrlAttribute()
    {
        if ($this->file) {
            return asset('storage/' . $this->file);
        }
        return null;
    }

    // Scope for visible ads
    public function scopeVisible($query)
    {
        return $query->where('visibility', 1);
    }

    // Scope for hidden ads
    public function scopeHidden($query)
    {
        return $query->where('visibility', 0);
    }
}

