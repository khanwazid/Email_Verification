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
        /*if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                // Check if the current route is already the admin.dashboard
                if (!$request->routeIs('admin.dashboard')) {
                    return redirect()->route('admin.dashboard');
                }
                return $next($request);
            } else {
                return redirect()->route('welcome')->with('error', 'You do not have access to this page, it is accessible only for admins.');

            }
        }*/
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return $next($request);
            } else {
                return redirect()->route('welcome')->with('error', 'You do not have access to this page, it is accessible only for admins.');
            }
        }

        //return redirect()->route('welcome');
    }
}
