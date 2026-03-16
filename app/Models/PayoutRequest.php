<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayoutRequest extends Model
{
    use HasFactory;

    protected $table = 'payout_requests';

    protected $fillable = [
        'artist_id',
        'requested_amount',
        'available_balance',
        'currency',
        'payout_method',
        'account_details',
        'status',
        'admin_notes',
        'artist_notes',
        'requested_at',
        'processed_at',
        'approved_by',
        'rejected_by',
    ];

    protected $casts = [
        'requested_amount' => 'decimal:2',
        'available_balance' => 'decimal:2',
        'requested_at' => 'datetime',
        'processed_at' => 'datetime',
    ];

    public function artist()
    {
        return $this->belongsTo(User::class, 'artist_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function rejector()
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }

    public function payoutHistory()
    {
        return $this->hasMany(PayoutHistory::class, 'payout_request_id');
    }
}
