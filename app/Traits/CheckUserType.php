<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait CheckUserType
{
    /**
     * Check if the authenticated user matches one of the allowed user types.
     *
     * @param array $types
     * @return void
     */
    public function userType(...$types): void
    {
        // Check if user is authenticated
        if (!Auth::check() || !in_array(Auth::user()->user_type, $types)) {
            abort(403);  // Return a 403 unauthorized response
        }
    }
}
