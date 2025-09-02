@extends('layouts.backend')

@section('title', 'Write a Message')

@section('content')
    <div class="inner-page">
        <div class="page-details mb-3 mb-md-4">
            <p class="title raleway">Write Message</p>
            <p class="description">Send a message to any user in here.</p>
        </div>
        
        <div class="row">
            <div class="col-12 col-lg-4 mb-3 mb-lg-0">
                <x-admin-message-sidebar
                    :all_count="$all_count" 
                    :general_count="$general_count" 
                    :partner_count="$partner_count" 
                    :customer_count="$customer_count" 
                    :starred_count="$starred_count" 
                    :bin_count="$bin_count"
                />
            </div>

            <div class="col-12 col-lg-8">
                <div class="message-form">
                    <form action="{{ route('admin.messages.store') }}" method="POST" enctype="multipart/form-data" class="form">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-6 mb-3 mb-lg-4">
                                <label for="user_id" class="form-label label">User<span class="asterisk">*</span></label>
                                <select class="form-select input-field js-single" id="user_id" name="user_id" required>
                                    <option value="">Select User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error field="user_id"></x-input-error>
                            </div>

                            <div class="col-12 col-lg-6 mb-3 mb-lg-4">
                                <label for="category" class="form-label label">Category<span class="asterisk">*</span></label>
                                <select class="form-select input-field js-single" id="category" name="category" required>
                                    <option value="">Select Category</option>
                                    <option value="general" {{ old('category') == 'general' ? 'selected' : '' }}>General Inquiry</option>
                                    <option value="partner" {{ old('category') == 'partner' ? 'selected' : '' }}>Partner Inquiry</option>
                                    <option value="explorer" {{ old('category') == 'explorer' ? 'selected' : '' }}>Explorer Inquiry</option>
                                </select>
                                <x-input-error field="category"></x-input-error>
                            </div>

                            <div class="col-12 mb-3 mb-lg-4">
                                <label for="subject" class="form-label label">Subject<span class="asterisk">*</span></label>
                                <input type="text" class="form-control input-field" id="subject" name="subject" placeholder="Subject" value="{{ old('subject') }}" required>
                                <x-input-error field="subject"></x-input-error>
                            </div>

                            <div class="col-12 mb-3 mb-lg-4">
                                <label for="initial_message" class="form-label label">Message<span class="asterisk">*</span></label>
                                <textarea class="form-control input-field textarea" rows="5" id="initial_message" name="initial_message" placeholder="Message" value="{{ old('initial_message') }}" required>{{ old('initial_message') }}</textarea>
                                <x-input-error field="initial_message"></x-input-error>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="submit-button">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection