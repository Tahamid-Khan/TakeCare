<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserTypeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param array|string $types
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$types): mixed
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        // Check if the user is an admin
        if ($user->user_type === 'admin') {
            return $next($request);
        }

        // Check if the user type is in the allowed types for this route
        if (!in_array($user->user_type, $types)) {
            abort(403);
        }

        return $next($request);
    }
}
