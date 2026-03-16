<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserCredit;
use App\Models\CreditTransaction;
use App\Models\CreditRedemption;
use App\Models\Referral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminCreditController extends Controller
{
    public function index(Request $request)
    {
        $query = UserCredit::with('user');

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $credits = $query->orderBy('balance', 'desc')->paginate(20);

        // Statistics
        $totalUsers = UserCredit::count();
        $totalCreditsIssued = UserCredit::sum('lifetime_earned');
        $totalCreditsRedeemed = UserCredit::sum('lifetime_spent');
        $activeCredits = UserCredit::sum('balance');

        return view('admin.credits.index', compact(
            'credits',
            'totalUsers',
            'totalCreditsIssued',
            'totalCreditsRedeemed',
            'activeCredits'
        ));
    }

    public function transactions(Request $request)
    {
        $query = CreditTransaction::with('user');

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('transaction_type')) {
            $query->where('transaction_type', $request->transaction_type);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        $transactions = $query->latest()->paginate(50);

        return view('admin.credits.transactions', compact('transactions'));
    }

    public function redemptions(Request $request)
    {
        $query = CreditRedemption::with('user');

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $redemptions = $query->latest()->paginate(50);

        return view('admin.credits.redemptions', compact('redemptions'));
    }

    public function adjustCredits(Request $request, $userId)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'description' => 'required|string|max:255',
            'type' => 'required|in:add,deduct',
        ]);

        $credits = UserCredit::firstOrCreate(['user_id' => $userId]);
        $amount = abs($validated['amount']);

        if ($validated['type'] === 'add') {
            $credits->increment('balance', $amount);
            $credits->increment('lifetime_earned', $amount);
        } else {
            if ($credits->balance < $amount) {
                return back()->with('error', 'Insufficient credits.');
            }
            $credits->decrement('balance', $amount);
        }

        $credits->update(['last_activity_at' => now()]);

        CreditTransaction::create([
            'user_id' => $userId,
            'transaction_type' => $validated['type'] === 'add' ? 'bonus' : 'adjustment',
            'source_type' => 'other',
            'amount' => $validated['type'] === 'add' ? $amount : -$amount,
            'balance_after' => $credits->balance,
            'description' => $validated['description'],
            'reference_id' => 'ADMIN-' . now()->timestamp,
        ]);

        return back()->with('success', 'Credits adjusted successfully.');
    }

    public function referrals()
    {
        $referrals = Referral::with(['referrer', 'referred'])
            ->latest()
            ->paginate(50);

        $totalReferrals = Referral::where('status', 'completed')->count();
        $totalCreditsAwarded = Referral::sum('credits_earned');

        return view('admin.credits.referrals', compact('referrals', 'totalReferrals', 'totalCreditsAwarded'));
    }
}
