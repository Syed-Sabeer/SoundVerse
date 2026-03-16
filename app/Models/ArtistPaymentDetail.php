<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtistPaymentDetail extends Model
{
    use HasFactory;

    protected $table = 'artist_payment_details';

    protected $fillable = [
        'artist_id',
        'payment_method',
        'account_name',
        'account_number',
        'routing_number',
        'bank_name',
        'paypal_email',
        'wise_email',
        'account_details_json',
        'is_primary',
        'is_verified',
        'verified_at',
        'verified_by',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'is_verified' => 'boolean',
        'verified_at' => 'datetime',
        'account_details_json' => 'array',
    ];

    public function artist()
    {
        return $this->belongsTo(User::class, 'artist_id');
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    /**
     * Get masked account number for display
     */
    public function getMaskedAccountNumberAttribute()
    {
        if (!$this->account_number) {
            return null;
        }

        $length = strlen($this->account_number);
        if ($length <= 4) {
            return str_repeat('*', $length);
        }

        return str_repeat('*', $length - 4) . substr($this->account_number, -4);
    }

    /**
     * Get display name for payment method
     */
    public function getDisplayNameAttribute()
    {
        switch ($this->payment_method) {
            case 'bank_transfer':
                return $this->bank_name ? $this->bank_name . ' ••••' . substr($this->account_number, -4) : 'Bank Account ••••' . substr($this->account_number, -4);
            case 'paypal':
                return 'PayPal: ' . ($this->paypal_email ? substr($this->paypal_email, 0, 3) . '***@' . substr(strrchr($this->paypal_email, '@'), 1) : 'Not set');
            case 'wise':
                return 'Wise: ' . ($this->wise_email ? substr($this->wise_email, 0, 3) . '***@' . substr(strrchr($this->wise_email, '@'), 1) : 'Not set');
            default:
                return ucfirst(str_replace('_', ' ', $this->payment_method));
        }
    }
}
