<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandPartnership extends Model
{
    use HasFactory;

    protected $table = 'brand_partnerships';

    protected $fillable = [
        'brand_name',
        'brand_logo',
        'contact_name',
        'contact_email',
        'contact_phone',
        'partnership_type',
        'description',
        'budget',
        'start_date',
        'end_date',
        'status',
        'created_by',
    ];

    protected $casts = [
        'budget' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function playlists()
    {
        return $this->hasMany(SponsoredPlaylist::class, 'brand_partnership_id');
    }

    public function collaborations()
    {
        return $this->hasMany(BrandCollaboration::class, 'brand_partnership_id');
    }
}
