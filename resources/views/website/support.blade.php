@extends('frontend.layouts.frontend')

@section('title', 'Support')

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/support.css') }}">
@endpush
 
@section('content')
    <div class="support page-global">
        @if($contents->title_en)
            <div class="section-1 container section-margin">
                <h1 class="page-title">{{ $contents->{'title_' . $middleware_language} ?? $contents->title_en }}</h1>
                <p class="page-description">{{ $contents->{'description_' . $middleware_language} ?? $contents->description_en }}</p>
            </div>
        @endif
        
        <div class="section-2 container">
            <form action="{{ route('supports.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="mb-4">
                            <label for="name" class="form-label label">{{ $contents->{'name_' . $middleware_language} ?? $contents->name_en }}<span class="asterisk">*</span></label>
                            <input type="text" id="name" class="form-control input-field" name="name" placeholder="{{ $contents->{'name_placeholder_' . $middleware_language} ?? $contents->name_placeholder_en }}" value="{{ old('name') }}" required>
                            <x-input-error field="name"></x-input-error>
                        </div>

                        <div class="mb-4">
                            <div class="row contact-row">
                                <div class="col-6 col-md-6 contact-field">
                                    <label for="phone" class="form-label label">{{ $contents->{'phone_' . $middleware_language} ?? $contents->phone_en }}</label>
                                    <input type="text" id="phone" class="form-control input-field" name="phone" placeholder="{{ $contents->{'phone_placeholder_' . $middleware_language} ?? $contents->phone_placeholder_en }}" value="{{ old('phone') }}" >
                                    <x-input-error field="phone"></x-input-error>
                                </div>

                                <div class="col-6 col-md-6 contact-field">
                                    <label for="email" class="form-label label">{{ $contents->{'email_' . $middleware_language} ?? $contents->email_en }}<span class="asterisk">*</span></label>
                                    <input type="email" id="email" class="form-control input-field" name="email" placeholder="{{ $contents->{'email_placeholder_' . $middleware_language} ?? $contents->email_placeholder_en }}" value="{{ old('email') }}" required>
                                    <x-input-error field="email"></x-input-error>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="category" class="form-label label">{{ $contents->{'category_' . $middleware_language} ?? $contents->category_en }}<span class="asterisk">*</span></label>
                            <select class="form-select input-field" id="category" name="category" required>
                                <option value="">{{ $contents->{'category_placeholder_' . $middleware_language} ?? $contents->category_placeholder_en }}</option>
                                <option value="general" {{ old('category') == 'general' ? 'selected' : '' }}>{{ $contents->{'category_1_' . $middleware_language} ?? $contents->category_1_en }}</option>
                                <option value="accounts" {{ old('category') == 'accounts' ? 'selected' : '' }}>{{ $contents->{'category_2_' . $middleware_language} ?? $contents->category_2_en }}</option>
                                <option value="billings" {{ old('category') == 'billings' ? 'selected' : '' }}>{{ $contents->{'category_3_' . $middleware_language} ?? $contents->category_3_en }}</option>
                            </select>
                            <x-input-error field="category"></x-input-error>
                        </div>

                        <div class="mb-4">
                            <label for="subject" class="form-label label">{{ $contents->{'subject_' . $middleware_language} ?? $contents->subject_en }}<span class="asterisk">*</span></label>
                            <input type="text" id="subject" class="form-control input-field" name="subject" placeholder="{{ $contents->{'subject_placeholder_' . $middleware_language} ?? $contents->subject_placeholder_en }}" value="{{ old('subject') }}" required>
                            <x-input-error field="subject"></x-input-error>
                        </div>

                        <div class="mb-5">
                            <label for="message" class="form-label label">{{ $contents->{'message_' . $middleware_language} ?? $contents->message_en }}<span class="asterisk">*</span></label>
                            <textarea id="message" class="form-control input-field textarea" name="message" rows="5" placeholder="{{ $contents->{'message_placeholder_' . $middleware_language} ?? $contents->message_placeholder_en }}" value="{{ old('message') }}" required>{{ old('message') }}</textarea>
                            <x-input-error field="message"></x-input-error>
                        </div>

                        <button type="submit" class="submit-button">{{ $contents->{'button_' . $middleware_language} ?? $contents->button_en }}</button>
                    </div>
                </div>
            </form>
        </div>

        <x-notification></x-notification>
    </div>
@endsection