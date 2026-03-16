<?php

namespace App\Http\Controllers\Artist;

use App\Http\Controllers\Controller;
use App\Models\ArtistPaymentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArtistPaymentDetailsController extends Controller
{
    public function index()
    {
        $artistId = Auth::id();
        $paymentDetails = ArtistPaymentDetail::where('artist_id', $artistId)
            ->where('is_primary', true)
            ->first();

        return response()->json([
            'success' => true,
            'data' => $paymentDetails,
        ]);
    }

    public function save(Request $request)
    {
        // Convert empty strings to null for optional fields
        $input = $request->all();
        if (empty($input['paypal_email'])) {
            $input['paypal_email'] = null;
        }
        if (empty($input['wise_email'])) {
            $input['wise_email'] = null;
        }
        if (empty($input['account_name'])) {
            $input['account_name'] = null;
        }
        if (empty($input['bank_name'])) {
            $input['bank_name'] = null;
        }
        if (empty($input['account_number'])) {
            $input['account_number'] = null;
        }
        if (empty($input['routing_number'])) {
            $input['routing_number'] = null;
        }
        $request->merge($input);

        // Build validation rules based on payment method
        $rules = [
            'payment_method' => 'required|in:bank_transfer,paypal,wise,other',
        ];

        $paymentMethod = $request->payment_method;

        if ($paymentMethod === 'bank_transfer') {
            $rules['account_name'] = 'required|string|max:255';
            $rules['bank_name'] = 'required|string|max:255';
            $rules['account_number'] = 'required|string|max:255';
            $rules['routing_number'] = 'nullable|string|max:50';
            // Don't validate email fields for bank transfer
            $rules['paypal_email'] = 'nullable';
            $rules['wise_email'] = 'nullable';
        } elseif ($paymentMethod === 'paypal') {
            $rules['paypal_email'] = 'required|email|max:255';
            // Don't validate bank fields for PayPal
            $rules['account_name'] = 'nullable';
            $rules['bank_name'] = 'nullable';
            $rules['account_number'] = 'nullable';
            $rules['routing_number'] = 'nullable';
            $rules['wise_email'] = 'nullable';
        } elseif ($paymentMethod === 'wise') {
            $rules['wise_email'] = 'required|email|max:255';
            // Don't validate bank fields for Wise
            $rules['account_name'] = 'nullable';
            $rules['bank_name'] = 'nullable';
            $rules['account_number'] = 'nullable';
            $rules['routing_number'] = 'nullable';
            $rules['paypal_email'] = 'nullable';
        } else {
            // For 'other' method, make all fields nullable
            $rules['account_name'] = 'nullable';
            $rules['bank_name'] = 'nullable';
            $rules['account_number'] = 'nullable';
            $rules['routing_number'] = 'nullable';
            $rules['paypal_email'] = 'nullable';
            $rules['wise_email'] = 'nullable';
        }

        $request->validate($rules);

        $artistId = Auth::id();

        // Set all existing payment details to non-primary
        ArtistPaymentDetail::where('artist_id', $artistId)
            ->update(['is_primary' => false]);

        // Create or update payment details
        $paymentDetail = ArtistPaymentDetail::updateOrCreate(
            [
                'artist_id' => $artistId,
                'payment_method' => $request->payment_method,
            ],
            [
                'account_name' => $request->account_name ?? null,
                'bank_name' => $request->bank_name ?? null,
                'account_number' => $request->account_number ?? null,
                'routing_number' => $request->routing_number ?? null,
                'paypal_email' => $request->paypal_email ?? null,
                'wise_email' => $request->wise_email ?? null,
                'is_primary' => true,
                'is_verified' => false,
            ]
        );

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Payment details saved successfully. They will be used for future payout requests.',
                'data' => $paymentDetail
            ]);
        }
        
        return back()->with('success', 'Payment details saved successfully. They will be used for future payout requests.');
    }
}
