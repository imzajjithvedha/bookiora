<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Review;

class AboutUsController extends Controller
{
    public function index()
    {
        $reviews = Review::where('status', 2)->get();

        return view('website.about-us', [
            'reviews' => $reviews
        ]);
    }
}