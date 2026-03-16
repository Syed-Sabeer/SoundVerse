<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index(){
        session(['form_start_time' => time()]);
        $contact_details = Contact::first();
        return view("frontend.contact", compact('contact_details'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'firstname' => 'nullable|string|max:255',
                'lastname' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'subject' => 'required|string|max:255',
                'message' => 'required|string',
                'g-recaptcha-response' => 'required',
            ]);

            $startTime = session('form_start_time') ?? time();

            // Verify Google reCAPTCHA
            $recaptchaResponse = $request->input('g-recaptcha-response');
            $verifyResponse = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => env('RECAPTCHA_SECRET_KEY', '6LdJAowsAAAAAAFo844Us0TijYlGcDnP4q5YfSjE'),
                'response' => $recaptchaResponse,
                'remoteip' => $request->ip(),
            ]);

            $captchaResult = $verifyResponse->json();

            if (!($captchaResult['success'] ?? false)) {
                return response()->json([
                    'status' => 'error',
                    'title' => 'Captcha Failed!',
                    'message' => 'reCAPTCHA verification failed. Please try again.',
                    'icon' => 'error'
                ], 422);
            }

            // CleanTalk spam protection
            $cleantalkResponse = Http::asJson()->post('https://moderate.cleantalk.org/api2.0', [
                'method_name' => 'check_message',
                'auth_key' => env('CLEANTALK_AUTH_KEY', 'ysaruga7aga2yne'),
                'sender_ip' => $request->ip(),
                'sender_email' => $validatedData['email'],
                'sender_nickname' => $validatedData['firstname'] ?? $validatedData['lastname'],
                'message' => $validatedData['message'],
                'js_on' => 1,
                'submit_time' => time() - $startTime,
            ]);

            $cleantalkResult = $cleantalkResponse->json();

            Log::info('CleanTalk response:', is_array($cleantalkResult) ? $cleantalkResult : [
                'raw' => $cleantalkResponse->body()
            ]);

            if (isset($cleantalkResult['allow']) && $cleantalkResult['allow'] == 0) {
                Log::warning('CleanTalk blocked spam submission', [
                    'ip' => $request->ip(),
                    'email' => $validatedData['email'],
                    'name' => $validatedData['firstname'] ?? $validatedData['lastname'],
                    'comment' => $cleantalkResult['comment'] ?? 'No comment'
                ]);

                return response()->json([
                    'status' => 'error',
                    'title' => 'Spam Detected!',
                    'message' => 'Your message was flagged as spam. Please contact us directly if this is an error.',
                    'icon' => 'error'
                ], 403);
            }

            $contactSubmission = ContactSubmission::create([
                'firstname' => $validatedData['firstname'] ?? null,
                'lastname' => $validatedData['lastname'],
                'email' => $validatedData['email'],
                'subject' => $validatedData['subject'],
                'message' => $validatedData['message'],
            ]);

            Log::info('Contact form submitted successfully:', ['id' => $contactSubmission->id]);

            return response()->json([
                'status' => 'success',
                'title' => 'Success!',
                'message' => 'Thank you for your message! We will get back to you soon.',
                'icon' => 'success'
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Contact form validation error:', ['errors' => $e->errors()]);

            return response()->json([
                'status' => 'error',
                'title' => 'Validation Error!',
                'message' => 'Please check your input and try again.',
                'errors' => $e->errors(),
                'icon' => 'error'
            ], 422);

        } catch (\Exception $e) {
            Log::error('Contact form submission error:', ['message' => $e->getMessage()]);

            return response()->json([
                'status' => 'error',
                'title' => 'Error!',
                'message' => 'Sorry, there was an error sending your message. Please try again.',
                'icon' => 'error'
            ], 500);
        }
    }
}
