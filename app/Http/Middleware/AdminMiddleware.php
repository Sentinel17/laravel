<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::check()) {
            return redirect('/');
        }
        if (Auth::user()->role()->where('title', 'Student')->count() > 0) {
            return redirect('/');
        }

        return $next($request);
    }
}
