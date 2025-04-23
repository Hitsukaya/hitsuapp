<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class OnlineMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            // Checks if the user is authenticated
            if (Auth::check()) {
                // Updates the 'online_at' field for the authenticated user
                Auth::user()->update(['online_at' => now()->addMinutes(5)]);
            }
        } catch (Exception $e) {
            \Log::error('Error updating online_at: ' . $e->getMessage());
        }

        return $next($request);
    }
}
