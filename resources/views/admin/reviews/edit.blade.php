@extends('backend.layouts.frontend')

@section('title', 'Edit Review')

@section('content')
    <div class="inner-page">
        <form action="{{ route('admin.reviews.update', $review) }}" method="POST" enctype="multipart/form-data" class="form">
            @csrf

            <div class="page-details">
                <p class="title">Review Details</p>
                <p class="description">View or update review details. Save changes to apply.</p>
            </div>

            <div class="row">
                <div class="col-6 mb-4">
                    <label for="name" class="form-label label">Name<span class="asterisk">*</span></label>
                    <input type="text" class="form-control input-field" id="name" name="name" placeholder="Name" value="{{ old('name', $review->name) }}" required>
                    <x-input-error field="name"></x-input-error>
                </div>

                <div class="col-6 mb-4">
                    <label for="designation" class="form-label label">Designation<span class="asterisk">*</span></label>
                    <input type="text" class="form-control input-field" id="designation" name="designation" placeholder="Designation" value="{{ old('designation', $review->designation) }}" required>
                    <x-input-error field="designation"></x-input-error>
                </div>

                <div class="col-6 mb-4">
                    <label for="star" class="form-label label">Star<span class="asterisk">*</span></label>
                    <select class="form-select input-field" id="star" name="star" required>
                        <option value="">Select star</option>
                        <option value="1" {{ old('star', $review->star) == '1' ? "selected" : "" }}>1</option>
                        <option value="2" {{ old('star', $review->star) == '2' ? "selected" : "" }}>2</option>
                        <option value="3" {{ old('star', $review->star) == '3' ? "selected" : "" }}>3</option>
                        <option value="4" {{ old('star', $review->star) == '4' ? "selected" : "" }}>4</option>
                        <option value="5" {{ old('star', $review->star) == '5' ? "selected" : "" }}>5</option>
                    </select>
                    <x-input-error field="star"></x-input-error>
                </div>

                <div class="col-6 mb-4">
                    <label for="language" class="form-label label">Language<span class="asterisk">*</span></label>
                    <select class="form-select input-field" id="language" name="language" required>
                        <option value="">Select language</option>
                        <option value="english" {{ old('language', $review->language) == 'english' ? "selected" : "" }}>English</option>
                        <option value="arabic" {{ old('language', $review->language) == 'arabic' ? "selected" : "" }}>Arabic</option>
                    </select>
                    <x-input-error field="language"></x-input-error>
                </div>

                <div class="col-12 mb-4">
                    <label for="content" class="form-label label">Content<span class="asterisk">*</span></label>
                    <textarea class="form-control input-field textarea" rows="5" id="content" name="content" placeholder="Content" value="{{ old('content', $review->content) }}" required>{{ old('content', $review->content) }}</textarea>
                    <x-input-error field="content"></x-input-error>
                </div>

                <div class="col-12 mb-4">
                    <x-upload-image old_name="old_image" old_value="{{ $review->image ?? old('image')  }}" new_name="new_image" path="reviews"></x-upload-image>
                    <x-input-error field="new_image"></x-input-error>
                </div>

                <x-edit-status :data="$review"></x-edit>
                <x-notification></x-notification>
            </div>
        </form>
    </div>

    <x-image-preview></x-modal-image-preview>
@endsection

@push('after-scripts')
    <script src="{{ asset('backend/js/drag-drop-image.js') }}"></script>
@endpush