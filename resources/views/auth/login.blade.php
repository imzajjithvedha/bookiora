@extends('layouts.frontend')

@section('title', 'Log In')

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@section('content')
    <div class="container page-global page-auth login">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-7">
                <h1 class="title raleway">Login Now</h1>
                <p class="description">Log in to access the portal.</p>

                <form action="{{ route('login.store') }}" method="POST" class="form">
                    @csrf
                    <div class="mb-3 mb-md-4">
                        <label for="email" class="form-label label">Email Address</label>
                        <input type="email" class="form-control input-field" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email address" required>
                        <x-input-error field="email"></x-input-error>
                    </div>

                    <div class="mb-3 mb-md-4 position-relative">
                        <label for="password" class="form-label label">Password</label>
                        <input type="password" class="form-control input-field" id="password" name="password" placeholder="Enter your password" required>
                        <span class="bi bi-eye-slash-fill toggle-password"></span>
                    </div>

                    <div class="row align-items-center mb-3 mb-md-4">
                        <div class="col-6">
                            <div class="form-check d-flex align-items-center">
                                <input type="checkbox" class="form-check-input checkbox" id="remember">
                                <label class="form-check-label remember" for="remember">Remember Me</label>
                            </div>
                        </div>

                        <div class="col-6 text-end">
                            <a href="{{ route('forgot-password') }}" class="forgot-password">Forgot Password?</a>
                        </div>
                    </div>
                    
                    <button type="submit" class="submit-button">Login Now</button>
                </form>

                <p class="text">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="span-link">Register here</a>
                </p>
            </div>
        </div>
    </div>
@endsection