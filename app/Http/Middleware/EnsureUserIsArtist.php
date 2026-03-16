<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsArtist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('artist.login')->with('error', 'Please log in to access the artist portal.');
        }

        $user = Auth::user();

        // Check if user is an artist (either has artist role or is_artist flag is true)
        $hasArtistRole = false;
        if (method_exists($user, 'hasRole')) {
            try {
                $hasArtistRole = $user->hasRole('artist');
            } catch (\Exception $e) {
                \Log::error('Error checking artist role', ['error' => $e->getMessage(), 'user_id' => $user->id]);
            }
        }
        
        // Check is_artist flag (handle both boolean and integer values)
        $isArtistFlag = false;
        if (isset($user->is_artist)) {
            $isArtistFlag = (bool) $user->is_artist;
        }
        
        // Debug logging (after safe checks)
        \Log::info('EnsureUserIsArtist Middleware Check', [
            'user_id' => $user->id,
            'user_email' => $user->email,
            'is_artist' => $user->is_artist,
            'is_artist_flag' => $isArtistFlag,
            'has_artist_role' => $hasArtistRole,
            'roles' => method_exists($user, 'roles') ? $user->roles->pluck('name')->toArray() : []
        ]);
        
        // If user has is_artist flag but no role, automatically assign the role
        if ($isArtistFlag && !$hasArtistRole) {
            try {
                $artistRole = \Spatie\Permission\Models\Role::where('name', 'artist')->first();
                if ($artistRole) {
                    $user->assignRole('artist');
                    $hasArtistRole = true;
                    \Log::info('Automatically assigned artist role to user', ['user_id' => $user->id]);
                }
            } catch (\Exception $e) {
                \Log::error('Error assigning artist role', ['error' => $e->getMessage(), 'user_id' => $user->id]);
            }
        }

        if (!$hasArtistRole && !$isArtistFlag) {
            \Log::warning('Artist portal access denied', [
                'user_id' => $user->id,
                'user_email' => $user->email,
                'has_artist_role' => $hasArtistRole,
                'is_artist_flag' => $isArtistFlag,
                'is_artist_value' => $user->is_artist ?? 'null'
            ]);
            return redirect()->route('home')->with('error', 'Access denied. Artist privileges required. Please contact support to enable artist access for your account.');
        }

        return $next($request);
    }
}
