@extends('backend.layouts.frontend')

@section('title', 'Create Review')

@section('content')
    <div class="inner-page">
        <form action="{{ route('admin.reviews.store') }}" method="POST" enctype="multipart/form-data" class="form">
            @csrf

            <div class="page-details">
                <p class="title">Add New Review</p>
                <p class="description">Fill in the details below to create a new review.</p>
            </div>
            
            <div class="row">
                <div class="col-6 mb-4">
                    <label for="name" class="form-label label">Name<span class="asterisk">*</span></label>
                    <input type="text" class="form-control input-field" id="name" name="name" placeholder="Name" value="{{ old('name') }}" required>
                    <x-input-error field="name"></x-backend.input-error>
                </div>

                <div class="col-6 mb-4">
                    <label for="designation" class="form-label label">Designation<span class="asterisk">*</span></label>
                    <input type="text" class="form-control input-field" id="designation" name="designation" placeholder="Designation" value="{{ old('designation') }}" required>
                    <x-input-error field="designation"></x-backend.input-error>
                </div>

                <div class="col-6 mb-4">
                    <label for="star" class="form-label label">Star<span class="asterisk">*</span></label>
                    <select class="form-select input-field" id="star" name="star" required>
                        <option value="">Select star</option>
                        <option value="1" {{ old('star') == '1' ? "selected" : "" }}>1</option>
                        <option value="2" {{ old('star') == '2' ? "selected" : "" }}>2</option>
                        <option value="3" {{ old('star') == '3' ? "selected" : "" }}>3</option>
                        <option value="4" {{ old('star') == '4' ? "selected" : "" }}>4</option>
                        <option value="5" {{ old('star') == '5' ? "selected" : "" }}>5</option>
                    </select>
                    <x-input-error field="star"></x-backend.input-error>
                </div>

                <div class="col-6 mb-4">
                    <label for="language" class="form-label label">Language<span class="asterisk">*</span></label>
                    <select class="form-select input-field" id="language" name="language" required>
                        <option value="">Select language</option>
                        <option value="english" {{ old('language') == 'english' ? "selected" : "" }}>English</option>
                        <option value="arabic" {{ old('language') == 'arabic' ? "selected" : "" }}>Arabic</option>
                    </select>
                    <x-input-error field="language"></x-backend.input-error>
                </div>

                <div class="col-12 mb-4">
                    <label for="content" class="form-label label">Content<span class="asterisk">*</span></label>
                    <textarea class="form-control input-field textarea" rows="5" id="content" name="content" placeholder="Content" value="{{ old('content') }}" required>{{ old('content') }}</textarea>
                    <x-input-error field="content"></x-backend.input-error>
                </div>

                <div class="col-12 mb-4">
                    <x-upload-image old_name="old_image" old_value="{{ old('image') }}" new_name="new_image" path="reviews"></x-backend.upload-image>
                    <x-input-error field="new_image"></x-backend.input-error>
                </div>

                <x-create></x-backend.create>
                <x-notification></x-backend.notification>
            </div>
        </form>
    </div>
@endsection

@push('after-scripts')
    <script src="{{ asset('backend/js/drag-drop-image.js') }}"></script>
@endpush