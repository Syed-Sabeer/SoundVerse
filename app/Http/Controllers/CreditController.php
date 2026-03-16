<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UserCredit;
use App\Models\CreditTransaction;
use App\Models\CreditRedemption;
use App\Models\Referral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreditController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $credits = UserCredit::firstOrCreate(['user_id' => $userId]);

        $transactions = CreditTransaction::where('user_id', $userId)
            ->latest()
            ->paginate(20);

        $referralCode = Auth::user()->referral_code ?? $this->generateReferralCode();

        return view('credits.index', compact('credits', 'transactions', 'referralCode'));
    }

    public function purchase(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required|string',
        ]);

        // Process payment
        // After successful payment, add credits
        $userId = Auth::id();
        $credits = UserCredit::firstOrCreate(['user_id' => $userId]);

        $credits->increment('balance', $validated['amount']);
        $credits->increment('lifetime_earned', $validated['amount']);
        $credits->update(['last_activity_at' => now()]);

        CreditTransaction::create([
            'user_id' => $userId,
            'transaction_type' => 'purchased',
            'source_type' => 'purchase',
            'amount' => $validated['amount'],
            'balance_after' => $credits->balance,
            'description' => 'Credits purchased',
            'reference_id' => Str::random(16),
        ]);

        return back()->with('success', 'Credits purchased successfully!');
    }

    public function redeem(Request $request)
    {
        $validated = $request->validate([
            'redemption_type' => 'required|in:boost,ad_slot,subscription_discount,marketplace_item,other',
            'item_id' => 'nullable|integer',
            'credits_spent' => 'required|numeric|min:1',
        ]);

        $userId = Auth::id();
        $credits = UserCredit::where('user_id', $userId)->firstOrFail();

        if ($credits->balance < $validated['credits_spent']) {
            return back()->with('error', 'Insufficient credits.');
        }

        $credits->decrement('balance', $validated['credits_spent']);
        $credits->increment('lifetime_spent', $validated['credits_spent']);
        $credits->update(['last_activity_at' => now()]);

        CreditRedemption::create([
            'user_id' => $userId,
            'redemption_type' => $validated['redemption_type'],
            'item_id' => $validated['item_id'] ?? null,
            'credits_spent' => $validated['credits_spent'],
            'status' => 'completed',
            'redeemed_at' => now(),
        ]);

        CreditTransaction::create([
            'user_id' => $userId,
            'transaction_type' => 'spent',
            'source_type' => $validated['redemption_type'],
            'amount' => -$validated['credits_spent'],
            'balance_after' => $credits->balance,
            'description' => 'Credits redeemed for ' . $validated['redemption_type'],
        ]);

        return back()->with('success', 'Credits redeemed successfully!');
    }

    public function earnCredits($sourceType, $amount, $description = null)
    {
        $userId = Auth::id();
        $credits = UserCredit::firstOrCreate(['user_id' => $userId]);

        $credits->increment('balance', $amount);
        $credits->increment('lifetime_earned', $amount);
        $credits->update(['last_activity_at' => now()]);

        CreditTransaction::create([
            'user_id' => $userId,
            'transaction_type' => 'earned',
            'source_type' => $sourceType,
            'amount' => $amount,
            'balance_after' => $credits->balance,
            'description' => $description ?? 'Credits earned from ' . $sourceType,
        ]);
    }

    public function referral($code)
    {
        $referrer = \App\Models\User::where('referral_code', $code)->first();

        if (!$referrer || $referrer->id === Auth::id()) {
            return redirect()->route('register')
                ->with('error', 'Invalid referral code.');
        }

        session(['referral_code' => $code]);
        return redirect()->route('register');
    }

    public function processReferral($referredUserId)
    {
        $referralCode = session('referral_code');
        if (!$referralCode) return;

        $referrer = \App\Models\User::where('referral_code', $referralCode)->first();
        if (!$referrer) return;

        Referral::create([
            'referrer_id' => $referrer->id,
            'referred_id' => $referredUserId,
            'referral_code' => $referralCode,
            'status' => 'completed',
            'completed_at' => now(),
        ]);

        // Award credits to both users
        $this->earnCredits('referral', 50, 'Referral bonus');
        $this->earnCredits('referral', 50, 'Referred new user', $referrer->id);

        session()->forget('referral_code');
    }

    private function generateReferralCode()
    {
        $code = strtoupper(Str::random(8));
        Auth::user()->update(['referral_code' => $code]);
        return $code;
    }
}
