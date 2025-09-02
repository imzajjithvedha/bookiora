<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();

        if($user->role != $role) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->withInput()->with(
                [
                    'error' => 'Unauthorized Access',
                    'message' => 'You cannot access it.',
                ]
            );
        }

        return $next($request);
    }
}
