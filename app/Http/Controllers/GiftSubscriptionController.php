<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\GiftSubscription;
use App\Models\UserSubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GiftSubscriptionController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Gifts sent by user
        $sentGifts = GiftSubscription::where('gifter_id', $userId)
            ->with(['recipient', 'subscriptionPlan'])
            ->latest('gifted_at')
            ->paginate(10, ['*'], 'sent');

        // Gifts received by user
        $receivedGifts = GiftSubscription::where('recipient_id', $userId)
            ->with(['gifter', 'subscriptionPlan'])
            ->latest('gifted_at')
            ->paginate(10, ['*'], 'received');

        return view('gift-subscriptions.index', compact('sentGifts', 'receivedGifts'));
    }

    public function create()
    {
        $plans = UserSubscriptionPlan::where('is_active', true)->get();
        return view('gift-subscriptions.create', compact('plans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'recipient_email' => 'required|email|exists:users,email',
            'subscription_plan_id' => 'required|exists:user_subscription_plans,id',
            'duration_months' => 'required|integer|min:1|max:12',
            'gift_message' => 'nullable|string|max:500',
            'payment_method' => 'required|string',
        ]);

        $plan = UserSubscriptionPlan::findOrFail($validated['subscription_plan_id']);
        $recipient = \App\Models\User::where('email', $validated['recipient_email'])->first();

        $amount = $plan->price * $validated['duration_months'];

        $gift = GiftSubscription::create([
            'gifter_id' => Auth::id(),
            'recipient_id' => $recipient->id,
            'subscription_plan_id' => $plan->id,
            'gift_message' => $validated['gift_message'],
            'duration_months' => $validated['duration_months'],
            'amount' => $amount,
            'currency' => 'USD',
            'payment_method' => $validated['payment_method'],
            'status' => 'pending',
        ]);

        // Process payment here
        // After successful payment:
        // $gift->update(['status' => 'paid']);

        return redirect()->route('gift-subscriptions.index')
            ->with('success', 'Gift subscription created successfully!');
    }

    public function activate($id)
    {
        $gift = GiftSubscription::where('recipient_id', Auth::id())
            ->where('status', 'paid')
            ->findOrFail($id);

        $gift->update([
            'status' => 'activated',
            'activation_date' => now(),
            'expiry_date' => now()->addMonths($gift->duration_months),
            'activated_at' => now(),
        ]);

        // Activate subscription for recipient
        $recipient = \App\Models\User::find($gift->recipient_id);
        $recipient->update([
            'usersubscription_id' => $gift->subscription_plan_id,
            'usersubscription_date' => now(),
            'usersubscription_duration' => $gift->duration_months * 30,
        ]);

        return back()->with('success', 'Gift subscription activated successfully!');
    }
}
