<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $credentials = $request->only('email', 'password');
        $credentials['status'] = 1;

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if($user->role == 'admin') {
                return redirect()->route('admin.dashboard');
            }
            else if($user->role == 'partner') {
                return redirect()->route('partner.dashboard');
            }
            else {
                return redirect()->route('customer.dashboard');
            }
        }

        return back()->withInput()->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}