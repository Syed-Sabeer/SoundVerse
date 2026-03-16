<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayoutHistory extends Model
{
    use HasFactory;

    protected $table = 'payout_history';

    protected $fillable = [
        'payout_request_id',
        'artist_id',
        'amount',
        'currency',
        'payout_method',
        'transaction_id',
        'status',
        'processed_at',
        'completed_at',
        'failure_reason',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'processed_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function payoutRequest()
    {
        return $this->belongsTo(PayoutRequest::class, 'payout_request_id');
    }

    public function artist()
    {
        return $this->belongsTo(User::class, 'artist_id');
    }
}
