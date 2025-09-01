@extends('backend.layouts.frontend')

@section('title', 'Edit Article')

@section('content')
    <div class="inner-page">
        <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data" class="form">
            @csrf

            <div class="page-details">
                <p class="title">Article Details</p>
                <p class="description">View or update article details. Save changes to apply.</p>
            </div>

            <div class="row">
                <div class="col-12 mb-4">
                    <label for="title" class="form-label label">Title<span class="asterisk">*</span></label>
                    <input type="text" class="form-control input-field" id="title" name="title" value="{{ old('title', $article->title) }}" placeholder="Title" required>
                    <x-input-error field="title"></x-input-error>
                </div>

                <div class="col-6 mb-4">
                    <label for="article_category_id" class="form-label label">Article Category<span class="asterisk">*</span></label>
                    <select class="form-control form-select input-field js-single" id="article_category_id" name="article_category_id" required>
                        <option value="">Select article category</option>
                        @foreach($article_categories as $article_category)
                            <option value="{{ $article_category->id }}" {{ old('article_category_id', $article->article_category_id) == $article_category->id ? 'selected' : '' }}>{{ $article_category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-6 mb-4">
                    <label for="author_name" class="form-label label">Author Name<span class="asterisk">*</span></label>
                    <input type="text" class="form-control input-field" id="author_name" name="author_name" value="{{ old('author_name', $article->author_name) }}" placeholder="Author Name" required>
                    <x-input-error field="author_name"></x-input-error>
                </div>

                <div class="col-12 mb-4">
                    <label for="content" class="form-label">Content<span class="asterisk">*</span></label>
                    <textarea class="editor" id="content" name="content" value="{{ old('content', $article->content) }}">{{ old('content', $article->content) }}</textarea>
                    <x-input-error field="content"></x-input-error>
                </div>

                <div class="col-12 mb-4">
                    <x-upload-image old_name="old_thumbnail" old_value="{{ $article->thumbnail ?? old('thumbnail')  }}" new_name="new_thumbnail" path="articles" label="Thumbnail"></x-upload-image>
                    <x-input-error field="new_thumbnail"></x-input-error>
                </div>

                <x-edit-status :data="$article"></x-edit>
                <x-notification></x-notification>
            </div>
        </form>
    </div>

    <x-upload-image-preview></x-modal-image-preview>
@endsection

@push('after-scripts')
    <script src="{{ asset('backend/js/drag-drop-image.js') }}"></script>
@endpush