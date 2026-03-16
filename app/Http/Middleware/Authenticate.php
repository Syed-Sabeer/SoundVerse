<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }

        // Redirect to appropriate login based on route path
        $path = $request->path();
        
        // Check if path starts with 'admin'
        if (strpos($path, 'admin') === 0) {
            return route('admin.login');
        }
        
        // Check if path starts with 'artist'
        // if (strpos($path, 'artist') === 0) {
        //     return route('artist.login');
        // }
        
        // Default to user login for all other routes
        return route('user.login');
    }
}
