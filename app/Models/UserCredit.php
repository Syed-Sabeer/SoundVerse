<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCredit extends Model
{
    use HasFactory;

    protected $table = 'user_credits';

    protected $fillable = [
        'user_id',
        'balance',
        'lifetime_earned',
        'lifetime_spent',
        'last_activity_at',
    ];

    protected $casts = [
        'balance' => 'decimal:2',
        'lifetime_earned' => 'decimal:2',
        'lifetime_spent' => 'decimal:2',
        'last_activity_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(CreditTransaction::class, 'user_id', 'user_id');
    }
}
