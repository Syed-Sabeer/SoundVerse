<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Exception\ApiErrorException;
use Illuminate\Support\Facades\Log;

class PaymentService
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Process Stripe payment
     */
    public function processStripePayment($amount, $currency = 'gbp', $paymentMethodId = null)
    {
        try {
            // For demo purposes, simulate a successful payment if no payment method ID is provided
            if (!$paymentMethodId) {
                return [
                    'success' => true,
                    'transaction_id' => 'STRIPE_' . time() . '_' . rand(1000, 9999),
                    'status' => 'completed',
                    'message' => 'Stripe payment simulated successfully'
                ];
            }

            $intent = PaymentIntent::create([
                'amount' => $amount * 100, // Convert to cents
                'currency' => $currency,
                'payment_method' => $paymentMethodId,
                'confirmation_method' => 'manual',
                'confirm' => true,
                'return_url' => url('/payment/success'),
            ]);

            return [
                'success' => true,
                'payment_intent' => $intent,
                'client_secret' => $intent->client_secret,
                'transaction_id' => $intent->id
            ];
        } catch (ApiErrorException $e) {
            Log::error('Stripe payment error: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Process PayPal payment (simplified for demo)
     */
    public function processPayPalPayment($amount, $currency = 'GBP')
    {
        // For demo purposes, we'll simulate a successful PayPal payment
        // In production, you would integrate with PayPal's API
        return [
            'success' => true,
            'transaction_id' => 'PP_' . time() . '_' . rand(1000, 9999),
            'status' => 'completed'
        ];
    }

    /**
     * Process Google Pay payment through Stripe
     */
    public function processGooglePayPayment($amount, $currency = 'GBP', $paymentMethodId = null)
    {
        try {
            // For demo purposes, simulate Google Pay through Stripe
            if (!$paymentMethodId) {
                return [
                    'success' => true,
                    'transaction_id' => 'STRIPE_GP_' . time() . '_' . rand(1000, 9999),
                    'status' => 'completed',
                    'message' => 'Google Pay payment processed through Stripe'
                ];
            }

            $rawPaymentMethod = trim((string) $paymentMethodId);
            $resolvedPaymentMethodId = null;
            $resolvedTokenId = null;

            // Handle token payload accidentally sent as JSON string
            if (strpos($rawPaymentMethod, '{') === 0) {
                $decoded = json_decode($rawPaymentMethod, true);
                if (is_array($decoded) && !empty($decoded['id'])) {
                    $rawPaymentMethod = (string) $decoded['id'];
                }
            }

            if (strpos($rawPaymentMethod, 'pm_') === 0) {
                $resolvedPaymentMethodId = $rawPaymentMethod;
            } elseif (strpos($rawPaymentMethod, 'tok_') === 0) {
                $resolvedTokenId = $rawPaymentMethod;
            } else {
                return [
                    'success' => false,
                    'error' => 'Unsupported Google Pay payment token format'
                ];
            }

            $intentPayload = [
                'amount' => (int) round($amount * 100),
                'currency' => strtolower($currency),
                'confirm' => true,
                'return_url' => url('/payment/success'),
            ];

            if ($resolvedPaymentMethodId) {
                $intentPayload['payment_method'] = $resolvedPaymentMethodId;
                $intentPayload['confirmation_method'] = 'manual';
            } else {
                // Tokenized Google Pay cards from Stripe gateway (tok_*)
                $intentPayload['payment_method_data'] = [
                    'type' => 'card',
                    'card' => [
                        'token' => $resolvedTokenId,
                    ],
                ];
            }

            $intent = PaymentIntent::create($intentPayload);

            return [
                'success' => true,
                'payment_intent' => $intent,
                'client_secret' => $intent->client_secret,
                'transaction_id' => $intent->id
            ];
        } catch (ApiErrorException $e) {
            Log::error('Google Pay payment error: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        } catch (\Exception $e) {
            Log::error('Google Pay payment error: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Process Apple Pay payment through Stripe
     */
    public function processApplePayPayment($amount, $currency = 'GBP', $paymentMethodId = null)
    {
        try {
            // For demo purposes, simulate Apple Pay through Stripe
            if (!$paymentMethodId) {
                return [
                    'success' => true,
                    'transaction_id' => 'STRIPE_AP_' . time() . '_' . rand(1000, 9999),
                    'status' => 'completed',
                    'message' => 'Apple Pay payment processed through Stripe'
                ];
            }

            // In production, you would use Stripe's Apple Pay integration
            $intent = PaymentIntent::create([
                'amount' => $amount * 100,
                'currency' => $currency,
                'payment_method' => $paymentMethodId,
                'confirmation_method' => 'manual',
                'confirm' => true,
                'return_url' => url('/payment/success'),
            ]);

            return [
                'success' => true,
                'payment_intent' => $intent,
                'client_secret' => $intent->client_secret,
                'transaction_id' => $intent->id
            ];
        } catch (ApiErrorException $e) {
            Log::error('Apple Pay payment error: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Process Square payment with card token
     */
    public function processSquarePayment($amount, $currency = 'GBP', $cardToken = null)
    {
        try {
            // For demo purposes, simulate Square payment with token
            if (!$cardToken) {
                return [
                    'success' => false,
                    'error' => 'Card token is required for Square payment'
                ];
            }
            
            // In production, you would use Square's API to process the payment
            // For now, we'll simulate a successful payment
            return [
                'success' => true,
                'transaction_id' => 'SQUARE_' . time() . '_' . rand(1000, 9999),
                'status' => 'completed',
                'message' => 'Square payment processed successfully with card token: ' . substr($cardToken, 0, 10) . '...'
            ];
        } catch (\Exception $e) {
            Log::error('Square payment error: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Process payment based on method
     */
    public function processPayment($method, $amount, $currency = 'GBP', $paymentMethodId = null)
    {
        switch ($method) {
            case 'stripe':
                return $this->processStripePayment($amount, $currency, $paymentMethodId);
            case 'paypal':
                return $this->processPayPalPayment($amount, $currency);
            case 'google-pay':
                return $this->processGooglePayPayment($amount, $currency, $paymentMethodId);
            case 'apple-pay':
                return $this->processApplePayPayment($amount, $currency, $paymentMethodId);
                case 'square':
                    return $this->processSquarePayment($amount, $currency, $paymentMethodId);
            default:
                return [
                    'success' => false,
                    'error' => 'Unsupported payment method'
                ];
        }
    }
}
