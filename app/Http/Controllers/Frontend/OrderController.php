<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GiftOrder;
use App\Models\Gift;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    public function handlePayment(Request $request)
    {
        Log::info('Incoming gift order payment request', ['request' => $request->all()]);
        
        $validator = Validator::make($request->all(), [
            'package_id' => 'required|string',
            'package_name' => 'required|string|max:255',
            'package_price' => 'required|numeric|min:0',
            'rings_count' => 'required|integer|min:2',
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:255',
            'partner_name' => 'required|string|max:255',
            'address' => 'required|string',
            'female_rings' => 'required|integer|min:0',
            'male_rings' => 'required|integer|min:0',
            'female_ring_size' => 'required|string|max:255',
            'male_ring_size' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            Log::warning('Gift order validation failed', ['errors' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        Log::info('Validated gift order data', $data);

        // Validate ring counts
        if (($data['female_rings'] + $data['male_rings']) !== $data['rings_count']) {
            return response()->json([
                'success' => false,
                'message' => 'Total rings must equal the package ring count.',
            ], 422);
        }

        try {
            Log::info('Processing gift order payment', [
                'package_id' => $data['package_id'],
                'package_price' => $data['package_price'],
                'rings_count' => $data['rings_count'],
                'payment_method' => $data['payment_method'],
                'user_email' => $data['email'],
            ]);

            $paymentIntent = null;
            $paymentId = null;

            // Handle different payment methods
            if ($data['payment_method'] === 'paypal' && !empty($request->input('paypal_order_id'))) {
                // PayPal payment
                Log::info('Processing PayPal payment', [
                    'paypal_order_id' => $request->input('paypal_order_id'),
                    'amount' => $data['package_price'],
                ]);
                $paymentId = $request->input('paypal_order_id');
                
            } elseif ($data['payment_method'] === 'google_pay' && !empty($request->input('payment_method_id'))) {
                // Google Pay payment
                Log::info('Processing Google Pay payment', [
                    'token' => $request->input('payment_method_id'),
                    'amount' => $data['package_price'],
                ]);
                
                $paymentIntent = PaymentIntent::create([
                    'amount' => intval($data['package_price'] * 100), // Convert to cents
                    'currency' => 'usd',
                    'payment_method_types' => ['card'],
                    'payment_method_data' => [
                        'type' => 'card',
                        'card' => [
                            'token' => $request->input('payment_method_id'),
                        ],
                    ],
                    'confirm' => true,
                ]);
                $paymentId = $paymentIntent->id;
                
            } elseif ($data['payment_method'] === 'google_apple_pay' && !empty($request->input('payment_method_id'))) {
                // Apple Pay / Google Pay via Stripe
                Log::info('Processing Apple/Google Pay payment', [
                    'payment_method_id' => $request->input('payment_method_id'),
                    'amount' => $data['package_price'],
                ]);
                
                $paymentIntent = PaymentIntent::create([
                    'amount' => intval($data['package_price'] * 100),
                    'currency' => 'usd',
                    'payment_method' => $request->input('payment_method_id'),
                    'confirm' => true,
                    'automatic_payment_methods' => [
                        'enabled' => true,
                        'allow_redirects' => 'never'
                    ],
                ]);
                $paymentId = $paymentIntent->id;
                
            } elseif (!empty($request->input('payment_method_id'))) {
                // Stripe card payment
                Log::info('Processing Stripe card payment', [
                    'payment_method_id' => $request->input('payment_method_id'),
                    'amount' => $data['package_price'],
                ]);
                
                $paymentIntent = PaymentIntent::create([
                    'amount' => intval($data['package_price'] * 100),
                    'currency' => 'usd',
                    'payment_method' => $request->input('payment_method_id'),
                    'confirm' => true,
                    'automatic_payment_methods' => [
                        'enabled' => true,
                        'allow_redirects' => 'never'
                    ],
                ]);
                $paymentId = $paymentIntent->id;
                
            } else {
                Log::error('No valid payment method provided', [
                    'payment_method' => $data['payment_method'],
                    'payment_method_id' => $request->input('payment_method_id'),
                    'paypal_order_id' => $request->input('paypal_order_id'),
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'No valid payment method provided.',
                ], 422);
            }

            // Check if payment requires action (3D Secure)
            if ($paymentIntent && $paymentIntent->status === 'requires_action' && 
                $paymentIntent->next_action->type === 'use_stripe_sdk') {
                Log::info('Payment requires action', [
                    'payment_intent_id' => $paymentIntent->id, 
                    'next_action' => $paymentIntent->next_action
                ]);
                return response()->json([
                    'requires_action' => true,
                    'payment_intent_client_secret' => $paymentIntent->client_secret,
                ]);
            }

            // Check payment status
            if ($paymentIntent && $paymentIntent->status !== 'succeeded') {
                Log::warning('Payment not successful', [
                    'payment_intent_id' => $paymentIntent->id, 
                    'status' => $paymentIntent->status
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'Payment not successful.',
                    'status' => $paymentIntent->status,
                ]);
            }

            // Get the complete gift details from the gifts table
            $gift = \App\Models\Gift::find($data['package_id']);
            if (!$gift) {
                Log::error('Gift not found in database', ['package_id' => $data['package_id']]);
                return response()->json([
                    'success' => false,
                    'message' => 'Selected package not found.',
                ], 404);
            }

            // Create the gift order
            Log::info('Creating gift order in database', [
                'package_id' => $data['package_id'],
                'package_name' => $data['package_name'],
                'package_price' => $data['package_price'],
                'rings_count' => $data['rings_count'],
                'fullname' => $data['fullname'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'partner_name' => $data['partner_name'],
                'address' => $data['address'],
                'female_rings' => $data['female_rings'],
                'male_rings' => $data['male_rings'],
                'female_ring_size' => $data['female_ring_size'],
                'male_ring_size' => $data['male_ring_size'],
                'total_price' => $data['package_price'],
                'payment_method' => $data['payment_method'],
                'payment_id' => $paymentId,
                'status' => 'completed'
            ]);

            $order = GiftOrder::create([
                'package_id' => $data['package_id'],
                'package_name' => $data['package_name'],
                'package_price' => $data['package_price'],
                'rings_count' => $data['rings_count'],
                'fullname' => $data['fullname'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'partner_name' => $data['partner_name'],
                'address' => $data['address'],
                'female_rings' => $data['female_rings'],
                'male_rings' => $data['male_rings'],
                'female_ring_size' => $data['female_ring_size'],
                'male_ring_size' => $data['male_ring_size'],
                'total_price' => $data['package_price'],
                'payment_method' => $data['payment_method'],
                'payment_id' => $paymentId,
                'status' => 'completed'
            ]);

            Log::info('Gift order created successfully', [
                'order_id' => $order->id, 
                'payment_id' => $paymentId
            ]);

            // Return success with complete gift details
            return response()->json([
                'success' => true,
                'order_id' => $order->id,
                'message' => 'Gift order created successfully!',
                'gift_detail' => $gift, // Send complete gift details
                'order' => $order
            ]);

        } catch (Exception $e) {
            Log::error('Gift order payment error', [
                'error' => $e->getMessage(),
                'data' => $data,
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Payment processing failed: ' . $e->getMessage(),
            ], 500);
        }
    }
}
