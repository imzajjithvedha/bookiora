@extends('layouts.frontend')

@section('title', 'Register')

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@section('content')
    <div class="container page-global page-auth register">
        <div class="row justify-content-center">
            <div class="col-7">
                <h1 class="title raleway">Register Now</h1>
                <p class="description">Fill out this quick form and get started with Bookiora.</p>

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-6">
                            <div class="form-check d-flex align-items-center justify-content-center">
                                <input class="form-check-input radio" type="radio" name="role" id="customer" value="customer" {{ old('role') == 'customer' ? 'checked' : '' }} required>
                                <label class="form-check-label radio-label" for="customer">
                                    Register as a explorer
                                </label>
                            </div>
                            <x-input-error field="role"></x-input-error>
                        </div>

                        <div class="col-6">
                            <div class="form-check d-flex align-items-center justify-content-center">
                                <input class="form-check-input radio" type="radio" name="role" id="partner" value="partner" {{ old('role') == 'partner' ? 'checked' : '' }} required>
                                <label class="form-check-label radio-label" for="partner">
                                    Register as a partner
                                </label>
                            </div>
                            <x-input-error field="role"></x-input-error>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-6">
                            <label for="firstName" class="form-label label">First Name</label>
                            <input type="text" class="form-control input-field" id="firstName" name="first_name" value="{{ old('first_name') }}" placeholder="Enter your first name" required>
                            <x-input-error field="first_name"></x-input-error>
                        </div>

                        <div class="col-6">
                            <label for="lastName" class="form-label label">Last Name</label>
                            <input type="text" class="form-control input-field" id="lastName" name="last_name" value="{{ old('last_name') }}" placeholder="Enter your last name" required>
                            <x-input-error field="last_name"></x-input-error>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-6">
                            <label for="email" class="form-label label">Email Address</label>
                            <input type="text" class="form-control input-field" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email address" required>
                            <x-input-error field="email"></x-input-error>
                        </div>

                        <div class="col-6">
                            <label for="phoneNumber" class="form-label label">Phone Number</label>
                            <input type="text" class="form-control input-field" id="phoneNumber" name="phone_number" placeholder="Enter your phone number" value="{{ old('phone_number') }}" required>
                            <x-input-error field="phone_number"></x-input-error>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-6">
                            <div class="position-relative">
                                <label for="password" class="form-label label">Password</label>
                                <input type="password" class="form-control input-field" id="password" name="password" placeholder="Enter your password" required>
                                <span class="bi bi-eye-slash-fill toggle-password"></span>
                                <x-input-error field="password"></x-backend.input-error>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="position-relative">
                                <label for="passwordConfirmation" class="form-label label">Confirm Password</label>
                                <input type="password" class="form-control input-field" id="passwordConfirmation" name="password_confirmation" placeholder="Confirm your password" required/>
                                <span class="bi bi-eye-slash-fill toggle-password"></span>
                                <x-input-error field="password_confirmation"></x-backend.input-error>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="submit-button">Register Now</button>

                    <p class="text">
                        Already have an account?
                        <a href="{{ route('login') }}" class="span-link">Login</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection