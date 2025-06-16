<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // if(auth()->user() && auth()->user()->role == 1 ){

        //     return $next($request);
        // }

        // return redirect('/');

        if (Auth::check() && Auth::user()->role == $role) {
            return $next($request);
        }

        // Redirect based on role
        if (Auth::check() && Auth::user()->role == 1) {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::check() && Auth::user()->role == 0) {
            // return redirect()->route('user.dashboard');
            return redirect()->route('member.dashboard');
        } else {
            return redirect('/login'); // Redirect to login if user is not authenticated
        }
    }
}
