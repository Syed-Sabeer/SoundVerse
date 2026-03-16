<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FcmToken extends Model
{
    protected $fillable = ['user_id', 'token'];

    // Optional: if you want to link to the user model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
