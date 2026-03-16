<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     */
    public function register()
    {
        return view('frontend.index');
    }
    public function registerAttempt(Request $request)
    {
        // Remove dd and log the request
        \Log::info('registerAttempt called', ['request' => $request->all()]);
        $isCompany = $request->has('company_name');
        try {
            $request->validate($isCompany ? [
                'company_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'contact_person' => 'required|string|max:255',
                'company_phone' => 'required|string|max:255',
                'company_type' => 'required|string',
                'company_size' => 'required|string',
                'dance_style' => 'required|string',
                'picture' => 'nullable|image',
                'dance_video' => 'nullable|file',
                'about' => 'nullable|string',
                'password' => 'required|string|min:6|confirmed',
            ] : [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|string|max:255',
                'dance_style' => 'required|string',
                'picture' => 'nullable|image',
                'dance_video' => 'nullable|file',
                'about' => 'nullable|string',
                'password' => 'required|string|min:6|confirmed',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation failed', ['errors' => $e->errors()]);
            return back()->withErrors($e->errors())->withInput();
        }
        Log::info('After validation', ['request' => $request->all()]);
        
        DB::beginTransaction();
        try {
            Log::info('Creating user record');

            $user = User::create([
                'name' => $isCompany ? $request->company_name : $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            Log::info('User created', ['user_id' => $user->id]);

            $role = $isCompany ? 'company' : 'individual';
            $user->assignRole($role);
            Log::info('Role assigned', ['user_id' => $user->id, 'role' => $role]);

            $profileData = $isCompany ? [
                'company_name' => $request->company_name,
                'contact_person' => $request->contact_person,
                'company_phone' => $request->company_phone,
                'company_type' => $request->company_type,
                'company_size' => $request->company_size,
                'dance_style' => $request->dance_style,
                'about' => $request->about,
            ] : [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'dance_style' => $request->dance_style,
                'about' => $request->about,
            ];

            $profileData['user_id'] = $user->id;

            // Handle profile picture upload
            if ($request->hasFile('picture')) {
                $picture = $request->file('picture');
                $pictureName = time() . '_' . $picture->getClientOriginalName();
                $picture->move(public_path('uploads/profile_pictures'), $pictureName);
                $profileData['picture'] = 'uploads/profile_pictures/' . $pictureName;

                Log::info('Profile picture uploaded', ['user_id' => $user->id, 'file' => $pictureName]);
            }

            // Handle dance video upload
            if ($request->hasFile('dance_video')) {
                $video = $request->file('dance_video');
                $videoName = time() . '_' . $video->getClientOriginalName();
                $video->move(public_path('uploads/dance_videos'), $videoName);
                $profileData['dance_video'] = 'uploads/dance_videos/' . $videoName;

                Log::info('Dance video uploaded', ['user_id' => $user->id, 'file' => $videoName]);
            }

            $user->profile()->create($profileData);
            Log::info('Profile created', ['user_id' => $user->id]);

            Auth::login($user);
            Log::info('User logged in', ['user_id' => $user->id]);

            DB::commit();
            Log::info('Registration successful, redirecting home');
            return redirect()->route('home')->with('success', 'Registration successful!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Registration failed', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
}

