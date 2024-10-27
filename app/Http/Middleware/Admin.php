<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return $next($request); // Allow access to admin routes
            } else {
                // Redirect regular users to their profile
                return redirect('/user/profile')->with('error', 'You do not have access to this page. Redirecting to your profile.');
            }
        }

        // Optionally, you can handle unauthenticated users here
        return redirect()->route('login')->with('error', 'You need to be logged in to access this page.');
    }
}
