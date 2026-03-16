<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
protected $fillable = [
    'user_id',
    'first_name',
    'last_name',
    'phone',
    'company_name',
    'contact_person',
    'company_phone',
    'company_type',
    'company_size',
    'dance_style',
    'dance_video',
    'picture',
    'banner_image',
    'about',
];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function maritalStatus()
    {
        return $this->belongsTo(MaritalStatus::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
