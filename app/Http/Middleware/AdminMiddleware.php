<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
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
        // Check if the authenticated user has the "admin" role
        if (auth()->check() && auth()->user()->hasRole('admin')) {
            return $next($request);
        }

        // Redirect or respond with an error message for unauthorized users
        // return redirect()->route('home')->with('error', 'You do not have permission to access this site.');
    }
}