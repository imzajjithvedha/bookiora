<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\AccountRegisterMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            'role' => 'required|in:explorer,partner',
            'first_name' => 'required|min:3|max:15',
            'last_name' => 'required|min:3|max:15',
            'email' => 'required|email|min:3|max:50|unique:users,email',
            'phone' => 'nullable|min:8|max:15|regex:/^\+?[0-9]+$/|unique:users,phone',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->except('first_name', 'last_name', 'password_confirmation');
        $data['name'] = $request->first_name . ' ' . $request->last_name;
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);

        $mail = [
            'user' => $user
        ];

        send_email(new AccountRegisterMail($mail, 'user'), $request->email);
        send_email(new AccountRegisterMail($mail, 'admin'), config('app.admin_emails'));

        Auth::login($user);

        $request->session()->regenerate();

        if($user->role == 'partner') {
            return redirect()->route('partner.dashboard');
        }
        else {
            return redirect()->route('explorer.dashboard');
        }
    }
}