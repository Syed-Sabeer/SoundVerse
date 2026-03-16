<?php

namespace App\Http\Controllers\Artist;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ArtistProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $profile = $user->profile ?: new Profile(['user_id' => $user->id]);

        return view('frontend.artist.profile-settings', compact('user', 'profile'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'about' => 'nullable|string|max:1000',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif|max:4096',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif|max:6144',
        ]);

        // Update basic account details if provided
        if (!empty($validated['name'] ?? null)) {
            $user->name = $validated['name'];
        }
        if (!empty($validated['email'] ?? null)) {
            $user->email = $validated['email'];
        }
        if (!empty($validated['password'] ?? null)) {
            $user->password = Hash::make($validated['password']);
        }
        $user->save();

        $profile = Profile::firstOrCreate(['user_id' => $user->id]);

        if ($request->hasFile('picture')) {
            if ($profile->picture && Storage::disk('public')->exists($profile->picture)) {
                Storage::disk('public')->delete($profile->picture);
            }
            $path = $request->file('picture')->store('artist_profiles', 'public');
            $profile->picture = $path;
        }

        if ($request->hasFile('banner_image')) {
            if (!empty($profile->banner_image) && Storage::disk('public')->exists($profile->banner_image)) {
                Storage::disk('public')->delete($profile->banner_image);
            }
            $bannerPath = $request->file('banner_image')->store('artist_banners', 'public');
            $profile->banner_image = $bannerPath;
        }

        $profile->first_name = $validated['first_name'] ?? $profile->first_name;
        $profile->last_name = $validated['last_name'] ?? $profile->last_name;
        $profile->about = $validated['about'] ?? $profile->about;
        $profile->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
