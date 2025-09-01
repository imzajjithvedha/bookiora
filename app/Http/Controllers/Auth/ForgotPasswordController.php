<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountForgotPasswordMail;
use App\Models\AuthenticationContent;

class ForgotPasswordController extends Controller
{
    public function index()
    { 
        return view('auth.forgot-password');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);
        
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::where('email', $request->email)->where('status', 2)->first();

        if(!$user) {
            return redirect()->back()->withErrors(['email' => 'Email not found.'])->withInput();
        }

        do {
            $token = bin2hex(random_bytes(30));
        } while (PasswordResetToken::where('token', $token)->exists());

        $password_reset = new PasswordResetToken();
        $password_reset->email = $request->email;
        $password_reset->token = $token;
        $password_reset->save();

        $mail = [
            'user' => $user,
            'token' => $token
        ];

        Mail::to($user->email)->send(new AccountForgotPasswordMail($mail));

        return redirect()->back()->with([
            'success' => "Email sent successfully",
            'message' => "Please check your inbox.",
        ]);
    }
}
