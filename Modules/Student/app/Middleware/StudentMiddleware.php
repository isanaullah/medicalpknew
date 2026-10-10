<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Check if user has student role
        if (!$user->hasRole('student') && $user->level() !== 1) {
            abort(403, 'Access denied. Student only.');
        }

        return $next($request);
    }
}
