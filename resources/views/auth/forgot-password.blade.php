@extends('layouts.frontend')

@section('title', 'Forgot Password')

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@section('content')
    <div class="container page-global page-auth forgot-password">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-7">
                <h1 class="title raleway">Forgot Your Password</h1>
                <p class="description">Don't worry! Resetting your password is easy in Bookiora.</p>

                <form action="{{ route('forgot-password.store') }}" method="POST" class="form">
                    @csrf
                    <div class="mb-3 mb-md-4">
                        <label for="email" class="form-label label">Email Address</label>
                        <input type="email" class="form-control input-field" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email address" required>
                        <x-input-error field="email"></x-input-error>
                    </div>

                    <button type="submit" class="submit-button">Send Now</button>
                </form>

                <p class="text">
                    Did you remember your password?
                    <a href="{{ route('login') }}" class="span-link">Login</a>
                </p>
            </div>
        </div>
    </div>
@endsection