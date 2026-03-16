<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{

    public function register()
    {
        return view('frontend.user.user-portal');
    }

    public function userRegister()
    {
        return view('frontend.auth.user-register');
    }
    public function registerAttempt(Request $request)
    {

        \Log::info('registerAttempt called', ['request' => $request->all()]);
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6|confirmed',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation failed', ['errors' => $e->errors()]);


            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $e->errors()
                ], 422);
            }

            return back()->withErrors($e->errors())->withInput();
        }
        Log::info('After validation', ['request' => $request->all()]);

        DB::beginTransaction();
        try {
            Log::info('Creating user record');

              $username = $this->generateUsername($request->name);


            while (User::where('username', $username)->exists()) {
                $username = $this->generateUsername($request->name);
            }
            Log::info('Generated unique username', ['username' => $username]);
$profileImagePath = null;

            // Check if this is an artist registration
            $isArtist = $request->has('is_artist') && $request->input('is_artist') == '1';

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $username,
                'password' => Hash::make($request->password),
                'is_artist' => $isArtist ? 1 : 0,
                'is_active' => 1,
            ]);

            Log::info('User created', ['user_id' => $user->id, 'is_artist' => $isArtist]);

            $role = $isArtist ? 'artist' : 'individual';
            $user->assignRole($role);
            Log::info('Role assigned', ['user_id' => $user->id, 'role' => $role]);


            Auth::login($user);
            Log::info('User logged in', ['user_id' => $user->id]);

            DB::commit();
            Log::info('Registration successful, redirecting home');


            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Registration successful!',
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'username' => $user->username,
                        'is_artist' => $user->is_artist,
                        'role' => $role
                    ]
                ], 201);
            }

            // Redirect based on user type
            if ($isArtist) {
                return redirect()->route('artist.portal')->with('success', 'Artist registration successful!');
            }

            return redirect()->route('home')->with('success', 'Registration successful!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Registration failed', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);


            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Registration failed',
                    'error' => $e->getMessage()
                ], 500);
            }

            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }


        public function generateUsername($name)
    {
        $name = strtolower(str_replace(' ', '', $name));
        $username = $name . rand(1000, 9999);
        return $username;
    }

public function artistRegister(){
        return view('frontend.auth.artist-register');
    }




}

