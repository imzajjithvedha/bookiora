@extends('layouts.frontend')

@section('title', 'Reset Password')

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@section('content')
    <div class="container page-global page-auth reset-password">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-7">
                <h1 class="title raleway">Change Password</h1>
                <p class="description">Need a new password? Fill in the details below to update it.</p>

                <form action="{{ route('reset-password.store') }}" method="POST" class="form">
                    @csrf
                    <div class="mb-3 mb-md-4 position-relative">
                        <label for="password" class="form-label label">New Password</label>
                        <input type="password" class="form-control input-field" id="password" name="password" placeholder="Enter your new password" required>
                        <span class="bi bi-eye-slash-fill toggle-password"></span>
                        <x-input-error field="password"></x-input-error>
                    </div>

                    <div class="mb-3 mb-md-4 position-relative">
                        <label for="passwordConfirmation" class="form-label label">Confirm Password</label>
                        <input type="password" class="form-control input-field" id="passwordConfirmation" name="password_confirmation" placeholder="Confirm your password" required/>
                        <span class="bi bi-eye-slash-fill toggle-password"></span>
                        <x-input-error field="password_confirmation"></x-input-error>
                    </div>

                    <input type="hidden" name="email" value="{{ $email }}">
                    <input type="hidden" name="token" value="{{ $token }}">
                    <button type="submit" class="submit-button">Update Password</button>
                </form>
            </div>
        </div>
    </div>
@endsection