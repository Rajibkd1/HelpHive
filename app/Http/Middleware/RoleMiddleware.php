<?php

// app/Http/Middleware/RoleMiddleware.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Check if the user role in the session matches the required role
        if (session('role') !== $role) {
            return redirect()->route('login'); // Redirect if the role doesn't match
        }

        return $next($request); // Allow the request to proceed if the role matches
    }
}

