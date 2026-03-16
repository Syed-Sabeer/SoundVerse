<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandCollaboration extends Model
{
    use HasFactory;

    protected $table = 'brand_collaborations';

    protected $fillable = [
        'brand_partnership_id',
        'artist_id',
        'collaboration_type',
        'title',
        'description',
        'content_url',
        'compensation_amount',
        'start_date',
        'end_date',
        'status',
    ];

    protected $casts = [
        'compensation_amount' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function brandPartnership()
    {
        return $this->belongsTo(BrandPartnership::class, 'brand_partnership_id');
    }

    public function artist()
    {
        return $this->belongsTo(User::class, 'artist_id');
    }
}
