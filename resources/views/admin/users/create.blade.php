@extends('layouts.backend')

@section('title', 'Create a User')

@section('content')
    <div class="inner-page">
        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data" class="form">
            @csrf
            <div class="page-details mb-4">
                <p class="title raleway">Add New User</p>
                <p class="description">Fill in the details below to create a new user account.</p>
            </div>
            
            <div class="row">
                <div class="col-6 mb-4">
                    <label for="name" class="form-label label">Name<span class="asterisk">*</span></label>
                    <input type="text" class="form-control input-field" id="name" name="name" placeholder="Name" value="{{ old('name') }}" required>
                    <x-input-error field="name"></x-input-error>
                </div>

                <div class="col-6 mb-4">
                    <label for="email" class="form-label label">Email<span class="asterisk">*</span></label>
                    <input type="email" class="form-control input-field" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                    <x-input-error field="email"></x-input-error>
                </div>

                <div class="col-6 mb-4">
                    <label for="display_name" class="form-label label">Display Name</label>
                    <input type="text" class="form-control input-field" id="display_name" name="display_name" placeholder="Display Name" value="{{ old('display_name') }}">
                    <x-input-error field="display_name"></x-input-error>
                </div>

                <div class="col-6 mb-4">
                    <label for="phone" class="form-label label">Phone</label>
                    <input type="text" class="form-control input-field" id="phone" name="phone" placeholder="Phone" value="{{ old('phone') }}">
                    <x-input-error field="phone"></x-input-error>
                </div>

                <div class="col-6 mb-4">
                    <label for="dob" class="form-label label">DOB</label>
                    <input type="text" class="form-control input-field date-picker-field" id="dob" name="dob" placeholder="DOB" value="{{ old('dob') }}">
                    <x-input-error field="dob"></x-input-error>
                </div>

                <div class="col-6 mb-4">
                    <label class="form-label label">Nationality</label>
                    <select class="form-select js-single input-field" id="nationality" name="nationality">
                        <x-countries-list :data="old('nationality')"></x-countries-list>
                    </select>
                    <x-input-error field="nationality"></x-input-error>
                </div>

                <div class="col-4 mb-4">
                    <label class="form-label label">Gender</label>
                    <select class="form-select input-field" id="gender" name="gender">
                        <option value="">Select a gender</option>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="nondisclosure" {{ old('gender') == 'nondisclosure' ? 'selected' : '' }}>Non Disclosure</option>
                    </select>
                    <x-input-error field="gender"></x-input-error>
                </div>

                <div class="col-4 mb-4">
                    <label for="address" class="form-label label">Address</label>
                    <input type="text" class="form-control input-field" id="address" name="address" placeholder="Address" value="{{ old('address') }}">
                    <x-input-error field="address"></x-input-error>
                </div>

                <div class="col-4 mb-4">
                    <label class="form-label label">Role<span class="asterisk">*</span></label>
                    <select class="form-select input-field" id="role" name="role" required>
                        <option value="">Select a role</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="partner" {{ old('role') == 'partner' ? 'selected' : '' }}>Partner</option>
                        <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Customer</option>
                    </select>
                    <x-input-error field="role"></x-input-error>
                </div>

                <div class="col-6 mb-4">
                    <div class="position-relative">
                        <label for="password" class="form-label label">Password<span class="asterisk">*</span></label>
                        <input type="password" class="form-control input-field" id="password" name="password" placeholder="Password" required>
                        <span class="bi bi-eye-slash-fill toggle-password"></span>
                        <x-input-error field="password"></x-input-error>
                    </div>
                </div>

                <div class="col-6 mb-4">
                    <div class="position-relative">
                        <label for="passwordConfirmation" class="form-label label">Confirm Password<span class="asterisk">*</span></label>
                        <input type="password" class="form-control input-field" id="passwordConfirmation" name="password_confirmation" placeholder="Confirm Password" required>
                        <span class="bi bi-eye-slash-fill toggle-password"></span>
                        <x-input-error field="password_confirmation"></x-input-error>
                    </div>
                </div>

                <div class="col-12 mb-4">
                    <x-upload-image old_name="old_image" old_value="{{ old('image') }}" new_name="new_image" path="users" label="User"></x-upload-image>
                    <x-input-error field="new_image"></x-input-error>
                </div>

                <x-create-status></x-create-status>
            </div>
        </form>
    </div>
@endsection