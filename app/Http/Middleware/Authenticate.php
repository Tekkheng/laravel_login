<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

// use Illuminate\Support\Facades\Log;
// use Tymon\JWTAuth\Facades\JWTAuth;
// use Closure;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }

    // public function handle($request, Closure $next, ...$guards)
    // {
    //     try {
    //         $user = JWTAuth::parseToken()->authenticate();
    //         if (!$user) {
    //             Log::warning('User not authenticated');
    //             return redirect('/login');
    //         }
    //     } catch (\Exception $e) {
    //         Log::error('Authentication error: ' . $e->getMessage());
    //         return redirect('/login');
    //     }

    //     Log::info('User authenticated: ' . $user->id);
        
    //     return $next($request);
    // }
    
}





