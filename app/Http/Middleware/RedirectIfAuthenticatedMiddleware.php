<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticatedMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()) {
            $role = Auth::user()->role;

            if($role == 'admin') {
                return redirect()->route('admin.dashboard');
            }
            elseif($role == 'partner') {
                return redirect()->route('partner.dashboard');
            }
            else {
                return redirect()->route('dashboard');
            }
        }

        return $next($request);
    }
}
