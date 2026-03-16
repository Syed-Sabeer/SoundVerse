<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQQuestion extends Model
{
    use HasFactory;

    protected $table = 'faq_questions';

    protected $fillable = [
        'question',
        'answer',
        'keywords',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get keywords as array
     */
    public function getKeywordsArrayAttribute()
    {
        return array_map('trim', explode(',', $this->keywords));
    }

    /**
     * Check if message matches this FAQ
     */
    public function matchesMessage($message)
    {
        $message = strtolower(trim($message));
        $keywords = $this->getKeywordsArrayAttribute();
        
        foreach ($keywords as $keyword) {
            $keyword = strtolower(trim($keyword));
            if (str_contains($message, $keyword)) {
                return true;
            }
        }
        
        return false;
    }
}
