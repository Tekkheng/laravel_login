<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

use Illuminate\Support\Facades\Log;

class IfUnaunthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next): Response
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                Log::warning('User not authenticated');
                return redirect('/login');
            }
        } catch (\Exception $e) {
            Log::error('Authentication error: ' . $e->getMessage());
            return redirect('/login');
        }

        Log::info('User authenticated: ' . $user->id);
        return $next($request);
    }
}
