<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Throwable;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use App\Mail\SendOtpMail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{

    public function getProfile(Request $request)
{
    $user = Auth::user();

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthenticated.'
        ], 401);
    }

    return response()->json([
        'success' => true,
        'user' => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'username' => $user->username,
            'is_artist' => $user->is_artist,
            'is_active' => $user->is_active,
            'phone' => $user->phone,
            'address' => $user->address,
            'roles' => $user->getRoleNames()
        ]
    ]);
}


public function editProfile(Request $request)
{
    \Log::info('EditProfile called', ['request' => $request->all()]);

    $user = Auth::user();
    \Log::info('Authenticated user', ['user' => $user ? $user->toArray() : null]);

    if (!$user) {
        \Log::warning('EditProfile: Unauthenticated access attempt');
        return response()->json(['success' => false, 'message' => 'Unauthenticated'], 401);
    }

    $validator = Validator::make($request->all(), [
        'name' => 'sometimes|string|max:255',
        'email' => 'sometimes|email|unique:users,email,' . $user->id,
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:500',
        'dob' => 'sometimes|string|max:255',
        'country' => 'sometimes|string|max:255',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'is_artist' => 'sometimes|boolean',
        'old_password' => 'required_with:password|string',
        'password' => 'sometimes|string|min:8|confirmed',
    ]);

    if ($validator->fails()) {
        \Log::warning('EditProfile validation failed', ['errors' => $validator->errors()]);
        return response()->json([
            'success' => false,
            'message' => 'Validation error',
            'errors' => $validator->errors()
        ], 422);
    }

    DB::beginTransaction();

    try {
        $data = $request->only(['name', 'email', 'phone', 'address', 'dob', 'country', 'is_artist']);

        // Handle password update
        if ($request->filled('password')) {
            if (!Hash::check($request->input('old_password'), $user->password)) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Old password is incorrect.'
                ], 403);
            }

            $data['password'] = Hash::make($request->password);
            \Log::info('Password updated after verifying old password');
        }

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $profileImagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $data['profile_picture'] = $profileImagePath;
            \Log::info('Profile picture uploaded', ['path' => $profileImagePath]);
        }

        $user->fill($data);
        $saved = $user->save();

        \Log::info('User save result', ['saved' => $saved, 'user' => $user->toArray()]);

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully.',
            'user' => $user
        ]);
    } catch (\Exception $e) {
        DB::rollBack();
        \Log::error('Profile update failed', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);
        return response()->json([
            'success' => false,
            'message' => 'Profile update failed.',
            'error' => $e->getMessage(),
        ], 500);
    }
}



    public function showForgotPasswordForm()
    {
        return view('frontend.auth.forgot-password');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $otp = rand(1000, 9999);

        // Use password_reset_tokens table (Laravel 10+ standard)
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $otp, // Store OTP as plain text (temporary, expires in 10 minutes)
                'created_at' => now(),
            ]
        );

        // Also store in session for quick verification
        session([
            'reset_email' => $request->email,
            'reset_otp' => $otp,
            'reset_otp_expires' => now()->addMinutes(10),
            'reset_is_artist' => $request->input('is_artist', 0)
        ]);

        // Send OTP email using the professional template
        Mail::send('emails.otp-verification', ['otp' => $otp], function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Password Reset OTP - ' . config('app.name'));
        });

        // If it's an AJAX request, return JSON
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'OTP sent to your email.',
            ]);
        }

        // Otherwise, redirect to OTP verification page
        return redirect()->route('password.verify-otp')
            ->with('success', 'OTP code has been sent to your email address.')
            ->with('reset_email', $request->email);
    }

    public function showVerifyOtpForm()
    {
        if (!session('reset_email')) {
            return redirect()->route('password.forgot')
                ->with('error', 'Please request an OTP first.');
        }
        return view('frontend.auth.verify-otp');
    }

    // Verify OTP entered by user
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|digits:4',
        ]);

        // Check session first (faster)
        $sessionOtp = session('reset_otp');
        $sessionEmail = session('reset_email');
        $sessionExpires = session('reset_otp_expires');

        $isValid = false;
        
        if ($sessionOtp && $sessionEmail === $request->email && $sessionExpires && now()->lt($sessionExpires)) {
            if ($sessionOtp == $request->otp) {
                $isValid = true;
            }
        }

        // Fallback: check database
        if (!$isValid) {
            $record = DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->where('token', $request->otp)
                ->where('created_at', '>=', now()->subMinutes(10))
                ->first();

            if ($record) {
                $isValid = true;
            }
        }

        if (!$isValid) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid or expired OTP.',
                ], 400);
            }
            return back()->with('error', 'Invalid or expired OTP. Please try again.');
        }

        // Store verified OTP in session for password reset
        session(['verified_otp' => $request->otp, 'reset_email' => $request->email]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'OTP verified successfully.',
            ]);
        }

        return redirect()->route('password.reset')
            ->with('success', 'OTP verified successfully. Please create your new password.');
    }

    public function showResetPasswordForm()
    {
        if (!session('verified_otp') || !session('reset_email')) {
            return redirect()->route('password.forgot')
                ->with('error', 'Please verify your OTP first.');
        }
        return view('frontend.auth.reset-password');
    }

    // Reset password after OTP verification
    public function resetPasswordWithOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|digits:4',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation Error',
                    'errors' => $validator->errors(),
                ], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        // Confirm OTP is still valid (check session first)
        $sessionOtp = session('reset_otp');
        $sessionEmail = session('reset_email');
        $sessionExpires = session('reset_otp_expires');

        $isValid = false;
        
        if ($sessionOtp && $sessionEmail === $request->email && $sessionExpires && now()->lt($sessionExpires)) {
            if ($sessionOtp == $request->otp) {
                $isValid = true;
            }
        }

        // Fallback: check database
        if (!$isValid) {
            $record = DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->where('token', $request->otp)
                ->where('created_at', '>=', now()->subMinutes(10))
                ->first();

            if ($record) {
                $isValid = true;
            }
        }

        if (!$isValid) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid or expired OTP.',
                ], 400);
            }
            return redirect()->route('password.forgot')
                ->with('error', 'Invalid or expired OTP. Please request a new one.');
        }

        try {
            $user = User::where('email', $request->email)->firstOrFail();
            $user->password = Hash::make($request->password);
            $user->save();

            // Remove OTP record after successful reset
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();

            // Clear session
            session()->forget(['verified_otp', 'reset_email', 'reset_otp', 'reset_otp_expires']);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Password has been reset successfully.',
                ]);
            }

            $loginRoute = $request->input('is_artist') ? 'artist.login' : 'user.login';
            return redirect()->route($loginRoute)
                ->with('success', 'Password has been reset successfully. Please login with your new password.');
        } catch (\Exception $e) {
            Log::error('Password reset error: ' . $e->getMessage());
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Server error.',
                    'error' => $e->getMessage(),
                ], 500);
            }
            
            return back()->with('error', 'An error occurred. Please try again.');
        }
    }

public function resetPassword(Request $request)
{
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|string|min:6|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password),
            ])->save();
        }
    );

    if ($status == Password::PASSWORD_RESET) {
        return redirect()->route('frontend.login')->with('success', 'Password reset successfully.');
    }

    return back()->withErrors(['email' => __($status)]);
}

    /**
     * User Logout
     */
    public function logout()
    {
        Log::info("Logout!");
        try {
            Auth::logout();
            Log::info("Logout Successfully!");
            return Redirect::route('home')->with('success', 'Logout Successfully!');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return Redirect::back()->with('error', "Something went wrong! Please try again later");
        }
    }


public function forgotPassword(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|email|exists:users,email',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Invalid email address.',
            'errors' => $validator->errors(),
        ], 422);
    }

    $user = \App\Models\User::where('email', $request->email)->first();

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'User not found.',
        ], 404);
    }

    try {
        $token = Password::createToken($user);

        $resetUrl = 'https://tetherheart.com/reset-password/' . $token . '?email=' . urlencode($user->email);

        Mail::send('emails.password_reset', ['resetUrl' => $resetUrl], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Reset Your Password');
        });

        return response()->json([
            'success' => true,
            'message' => 'Password reset link sent to your email.',
        ]);
    } catch (\Throwable $e) {
        Log::error('Mail sending failed: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Failed to send password reset email.',
            'error' => $e->getMessage(),
        ], 500);
    }
}

public function showResetForm(Request $request, $token = null)
{
    // Pass the token and email (if present) to the reset password view
    return view('auth.reset')->with([
        'token' => $token,
        'email' => $request->email,
    ]);
}

}
