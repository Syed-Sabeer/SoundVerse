<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtistWallet extends Model
{
    use HasFactory;

    protected $table = 'artist_wallets';

    protected $fillable = [
        'artist_id',
        'available_balance',
        'pending_balance',
        'total_earned',
        'total_paid_out',
        'currency',
    ];

    protected $casts = [
        'available_balance' => 'decimal:2',
        'pending_balance' => 'decimal:2',
        'total_earned' => 'decimal:2',
        'total_paid_out' => 'decimal:2',
    ];

    /**
     * Get the artist that owns the wallet
     */
    public function artist()
    {
        return $this->belongsTo(User::class, 'artist_id');
    }

    /**
     * Get or create wallet for artist
     */
    public static function getOrCreateForArtist($artistId)
    {
        return self::firstOrCreate(
            ['artist_id' => $artistId],
            [
                'available_balance' => 0,
                'pending_balance' => 0,
                'total_earned' => 0,
                'total_paid_out' => 0,
                'currency' => 'USD',
            ]
        );
    }

    /**
     * Add earnings to wallet
     */
    public function addEarnings($amount, $type = 'available')
    {
        if ($type === 'available') {
            $this->increment('available_balance', $amount);
        } else {
            $this->increment('pending_balance', $amount);
        }
        $this->increment('total_earned', $amount);
        $this->save();
    }

    /**
     * Deduct from wallet (for payouts)
     */
    public function deduct($amount)
    {
        if ($this->available_balance < $amount) {
            throw new \Exception('Insufficient balance. Available: $' . number_format($this->available_balance, 2) . ', Requested: $' . number_format($amount, 2));
        }
        
        $this->decrement('available_balance', $amount);
        $this->increment('total_paid_out', $amount);
        $this->save();
    }

    /**
     * Move pending to available
     */
    public function processPending()
    {
        $pending = $this->pending_balance;
        if ($pending > 0) {
            $this->increment('available_balance', $pending);
            $this->pending_balance = 0;
            $this->save();
        }
    }
}
