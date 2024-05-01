<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class Subscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      
        $user = Auth::user();

        // Check if the user is authenticated and has an active subscription
        if ($user && $user->subscription && $user->subscription->isActive()) {
            return $next($request);
        }
 
            return response()->json([
                'success' => false,
                'message' => 'Subscription Required'
            ], 400);
         

    }
}
