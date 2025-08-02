@extends('backend.layouts.frontend')

@section('title', 'Create To-Do')

@section('content')
    <div class="inner-page">
        <form action="{{ route('landlord.todos.store') }}" method="POST" enctype="multipart/form-data" class="form">
            @csrf

            <div class="page-details">
                <p class="title">Add New To-Do</p>
                <p class="description">Fill in the details below to create a new To-Do.</p>
            </div>
            
            <div class="row">
                <div class="col-12 mb-4">
                    <label for="title" class="form-label label">Title<span class="asterisk">*</span></label>
                    <input type="text" class="form-control input-field" id="title" name="title" placeholder="Title" value="{{ old('title') }}" required>
                    <x-input-error field="title"></x-backend.input-error>
                </div>

                <div class="col-12 mb-5">
                    <label for="description" class="form-label label">Description</label>
                    <textarea class="form-control input-field textarea" id="description" name="description" rows="5" placeholder="Description" value="{{ old('description') }}">{{ old('description') }}</textarea>
                    <x-input-error field="description"></x-backend.input-error>
                </div>

                <div class="col-12">
                    <button type="submit" class="submit-button">Save Changes</button>
                </div>

                <x-notification></x-backend.notification>
            </div>
        </form>
    </div>
@endsection