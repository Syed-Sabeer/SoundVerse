<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ArtistTip;
use App\Models\ArtistWallet;
use App\Models\User;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TipController extends Controller
{
    /**
     * Show tip artist page
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('user.portal')->with('error', 'Please login to access this feature.');
        }

        if (!$user->hasUserFeature('tip_artists')) {
            return redirect()->route('user.portal')->with('error', 'This feature is only available for Super Listener subscribers. Please upgrade your plan.');
        }

        $artistId = $request->query('artist');
        $artist = null;

        if ($artistId) {
            $artist = User::where('is_artist', true)
                ->with('profile')
                ->find($artistId);

            if (!$artist) {
                return redirect()->route('tip-artist')->with('error', 'Artist not found');
            }
        }

        // Get all artists for selection if no artist specified
        $artists = User::where('is_artist', true)
            ->with('profile')
            ->orderBy('name')
            ->get();

        return view('frontend.tip-artist', compact('artist', 'artists'));
    }

    /**
     * Process tip payment (User -> Artist directly)
     */
    public function processTip(Request $request)
    {
        $request->validate([
            'artist_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required|string|in:stripe,paypal,google-pay,apple-pay,square',
            'payment_method_id' => 'nullable|string',
            'user_message' => 'nullable|string|max:500',
        ]);

        $user = Auth::user();
        $artist = User::findOrFail($request->artist_id);

        if (!$artist->is_artist) {
            return response()->json([
                'success' => false,
                'message' => 'Selected user is not an artist'
            ], 400);
        }

        $amount = (float) $request->amount;
        $platformFee = round($amount * 0.05, 2); // 5% platform fee
        $totalAmount = $amount + $platformFee;

        // Process payment using PaymentService
        $paymentService = new PaymentService();
        $paymentResult = $paymentService->processPayment(
            $request->payment_method,
            $totalAmount,
            'GBP',
            $request->payment_method_id
        );

        if (!$paymentResult['success']) {
            return response()->json([
                'success' => false,
                'message' => 'Payment failed: ' . ($paymentResult['error'] ?? 'Unknown error')
            ], 400);
        }

        // Create tip record (status: sent_to_artist - directly sent to artist wallet)
        $tip = ArtistTip::create([
            'user_id' => $user->id,
            'artist_id' => $artist->id,
            'amount' => $amount,
            'platform_fee' => $platformFee,
            'total_amount' => $totalAmount,
            'payment_method' => $request->payment_method,
            'payment_method_id' => $paymentResult['transaction_id'] ?? null,
            'status' => 'sent_to_artist', // Directly sent to artist wallet
            'user_message' => $request->user_message,
            'paid_at' => now(),
            'sent_to_artist_at' => now(), // Sent immediately
        ]);

        // Directly add tip to artist wallet
        try {
            $wallet = ArtistWallet::getOrCreateForArtist($artist->id);
            $wallet->increment('available_balance', $amount);
            $wallet->increment('total_earned', $amount);
        } catch (\Exception $e) {
            Log::error('Failed to update artist wallet: ' . $e->getMessage());
            // Continue even if wallet update fails
        }

        // Notify artist about the tip
        try {
            $message = "You received a tip of £{$amount} from {$user->name}!" .
                ($request->user_message ? " Message: {$request->user_message}" : "");
            $actionUrl = route('artist.portal');
            $metadata = [
                'tip_id' => $tip->id,
                'user_id' => $user->id,
                'amount' => $amount,
                'user_message' => $request->user_message,
            ];
            app('notificationService')->notifyUsers([$artist], $message, 'Tip Received', 'payment', $actionUrl, $metadata);
        } catch (\Exception $e) {
            Log::error('Failed to notify artist about tip: ' . $e->getMessage());
        }

        // Notify user that their tip was sent successfully
        try {
            $userMessage = "Your tip of £{$amount} to {$artist->name} has been sent successfully! The artist has been notified.";
            $actionUrl = route('tip-artist', ['artist' => $artist->id]);
            $metadata = [
                'tip_id' => $tip->id,
                'artist_id' => $artist->id,
                'amount' => $amount,
            ];
            app('notificationService')->notifyUsers([$user], $userMessage, 'Tip Sent Successfully', 'payment', $actionUrl, $metadata);
        } catch (\Exception $e) {
            Log::error('Failed to notify user about tip payment: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Tip sent successfully! The artist has been notified and the amount has been added to their wallet.',
            'tip_id' => $tip->id,
            'data' => $tip
        ]);
    }
}
