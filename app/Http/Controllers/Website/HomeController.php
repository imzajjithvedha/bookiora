<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Mail\AdminSubscriptionMail;
use App\Mail\SubscriptionMail;
use Illuminate\Http\Request;
use App\Models\HomepageContent;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\StorageType;
use App\Models\Subscription;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('website.homepage');
    }

    public function subscriptions(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
                function($attribute, $value, $fail) {
                    if(Subscription::where('email', $value)->where('status', 1)->exists()) {
                        $fail('This email is already subscribed');
                    }
                },
            ],
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(
                [
                    'error' => 'Subscription Failed',
                    'message' => 'Please recheck and submit again.',
                ]
            );
        }

        $subscription = new Subscription();
        $subscription->email = $request->email;
        $subscription->save();

        $mail_data = [
            'email'    => $request->email,
        ];

        Mail::to($request->email)->send(new SubscriptionMail($mail_data));
        Mail::to(config('app.admin_email'))->send(new AdminSubscriptionMail($mail_data));

        return redirect()->route('homepage')->with(
            [
                'success' => 'Successfully Subscribed',
                'message' => 'You will receive our newsletters regularly.',
            ]
        );
    }
}