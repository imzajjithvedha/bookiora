@extends('backend.layouts.frontend')

@section('title', 'Create Article Category')

@section('content')
    <div class="inner-page">
        <form action="{{ route('admin.article-categories.store') }}" method="POST" enctype="multipart/form-data" class="form">
            @csrf

            <div class="page-details">
                <p class="title">Add New Article Category</p>
                <p class="description">Fill in the details below to create a new article category.</p>
            </div>
            
            <div class="row">
                <div class="col-12 mb-4">
                    <label for="name" class="form-label label">Name<span class="asterisk">*</span></label>
                    <input type="text" class="form-control input-field" id="name" name="name" placeholder="Name" value="{{ old('name') }}" required>
                    <x-input-error field="name"></x-input-error>
                </div>

                <div class="col-12 mb-4">
                    <label for="language" class="form-label label">Language<span class="asterisk">*</span></label>
                    <select class="form-select input-field" id="language" name="language" required>
                        <option value="">Select language</option>
                        <option value="english" {{ old('language') == 'english' ? "selected" : "" }}>English</option>
                        <option value="arabic" {{ old('language') == 'arabic' ? "selected" : "" }}>Arabic</option>
                    </select>
                    <x-input-error field="language"></x-input-error>
                </div>

                <x-create-status></x-create>
                <x-notification></x-notification>
            </div>
        </form>
    </div>
@endsection