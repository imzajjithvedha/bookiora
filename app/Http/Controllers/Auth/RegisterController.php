<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\AccountRegisterMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {     
        $validator = Validator::make($request->all(), [
            'role' => 'required|in:customer,partner',
            'first_name' => 'required|min:1|max:255',
            'last_name' => 'required|min:1|max:255',
            'email' => 'required|email|min:1|max:255|unique:users,email',
            'phone_number' => 'required|min:8|max:255|regex:/^\+?[0-9]+$/|unique:users,phone_number',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->except('password_confirmation');
        $data['password'] = Hash::make($request->password);
        $data['status'] = 1;
        $user = User::create($data);

        $mail = [
            'user' => $user
        ];

        Mail::to($user->email)->send(new AccountRegisterMail($mail));

        Auth::login($user);
        $request->session()->regenerate();

        if($user->role == 'partner') {
            return redirect()->route('partner.dashboard')->with([
                'register' => 'Account Created'
            ]);
        }
        else {
            return redirect()->route('customer.dashboard')->with([
                'register' => 'Account Created'
            ]);
        }
    }
}