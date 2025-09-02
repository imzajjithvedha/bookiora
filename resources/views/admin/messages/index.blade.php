@extends('layouts.backend')

@section('title', 'Messages')

@section('content')
    <div class="page">
        <div class="row align-items-center mb-3 mb-md-4">
            <div class="col-12 mb-3 mb-md-0 col-md-8">
                <p class="title raleway">Messages</p>
                <p class="description">Manage message and inquiries.</p>
            </div>
            <div class="col-12 col-md-4 text-end">
                <a href="{{ route('admin.messages.create') }}" class="add-button">
                    <i class="bi bi-plus-lg"></i>
                    Write a Message
                </a>
            </div>
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
                <div class="messages">
                    <div class="top-row">
                        <form action="{{ route('admin.messages.filter', $category) }}" class="form">
                            <input type="text" class="form-control input-field" name="text" value="{{ $text ?? '' }}" placeholder="Search mail">
                        </form>

                        <div class="icons {{ $category == 'bin' ? 'bin-icons' : '' }}">
                            @if($category == 'bin')
                                <i class="bi bi-arrow-counterclockwise icon bulk-recover" title="Recover"></i>
                            @endif

                            <i class="bi bi-star icon bulk-favorite" title="Favorite"></i>

                            <i class="bi bi-trash icon bulk-delete" title="Delete"></i>
                        </div>
                    </div>
                    
                    <div class="all-messages">
                        @if(count($items) > 0)
                            @foreach($items as $item)
                                <div class="single-message" data-id="{{ $item->id }}">
                                    <input class="form-check-input message-checkbox" type="checkbox" data-id="{{ $item->id }}">

                                    <i class="bi star favorite {{ $item->admin_favorite ? 'bi-star-fill gold' : 'bi-star' }}" title="Favorite" data-id="{{ $item->id }}"></i>

                                    <a href="{{ route('admin.messages.edit', $item->id) }}"><p class="name">{{ $item->name }}</p></a>

                                    @if($item->category == 'general')
                                        <p class="category general">General Inquiry</p>
                                    @elseif($item->category == 'partner')
                                        <p class="category partner">Partner Inquiry</p>
                                    @else
                                        <p class="category explorer">Explorer Inquiry</p>
                                    @endif

                                    <a href="{{ route('admin.messages.edit', $item->id) }}">
                                        <p class="message-content">
                                            {{ $item->subject }}
                                            @if($item->warehouse)
                                                ({{ App\Models\Warehouse::find($item->warehouse)->name_en }})
                                            @endif
                                            - {{ $item->initial_message }}
                                        </p>
                                    </a>

                                    <a href="{{ route('admin.messages.edit', $item->id) }}" class="ms-auto"><p class="date-time">{{ $item->time }} | {{ $item->date }}</p></a>
                                </div>
                            @endforeach
                        @else
                            <div class="single-message justify-content-center">
                                <p class="no-data">No Messages</p>
                            </div>
                        @endif

                        {{ $items->appends(request()->except('page'))->links("pagination::bootstrap-5") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('after-scripts')
    <script>
        $(document).ready(function() {
            $(".page .custom-pagination select").change(function () {
                window.location = "{!! $items->url(1) !!}&pagination=" + this.value; 
            });
        });

        $('.favorite').on('click', function () {
            const messageId = $(this).data('id');

            $.post(`${messageId}/favorite`, { _token: csrfToken })
                .done(() => {
                    $(this).toggleClass('bi-star');
                    $(this).toggleClass('bi-star-fill');
                    $(this).toggleClass('gold');
                });
        });

        $('.bulk-favorite').on('click', function () {
            const selectedCheckboxes = document.querySelectorAll('.message-checkbox:checked');
            const selectedIds = Array.from(selectedCheckboxes).map(checkbox => checkbox.getAttribute('data-id'));

            if(selectedIds.length === 0) {
                alert('No messages selected!');
                return;
            }

            $.post(`favorite/bulk`, { _token: csrfToken, selected_ids: selectedIds })
                .done(() => {
                    selectedIds.forEach(id => {
                        const starIcon = document.querySelector(`.single-message[data-id="${id}"] .favorite`);
                        $(starIcon).toggleClass('bi-star');
                        $(starIcon).toggleClass('bi-star-fill');
                        $(starIcon).toggleClass('gold');
                    });

                    selectedCheckboxes.forEach(checkbox => {
                        checkbox.checked = false;
                    });
                });
        });

        $('.bulk-delete').on('click', function () {
            const selectedCheckboxes = document.querySelectorAll('.message-checkbox:checked');
            const selectedIds = Array.from(selectedCheckboxes).map(checkbox => checkbox.getAttribute('data-id'));

            if(selectedIds.length === 0) {
                alert('No messages selected!');
                return;
            }

            const confirmation = confirm('Are you sure you want to delete the selected messages?');
            if(!confirmation) {
                return;
            }

            $.post(`destroy/bulk`, { _token: csrfToken, selected_ids: selectedIds })
                .done(() => {
                    selectedCheckboxes.forEach(checkbox => {
                        checkbox.checked = false;
                    });

                     selectedIds.forEach(id => {
                        const messageElement = document.querySelector(`.single-message[data-id="${id}"]`);
                        if(messageElement) {
                            messageElement.remove();
                        }
                    });

                    if($('.single-message').length === 0) {
                        location.reload();
                    }
                });
        });

        $('.bulk-recover').on('click', function () {
            const selectedCheckboxes = document.querySelectorAll('.message-checkbox:checked');
            const selectedIds = Array.from(selectedCheckboxes).map(checkbox => checkbox.getAttribute('data-id'));

            if(selectedIds.length === 0) {
                alert('No messages selected!');
                return;
            }

            const confirmation = confirm('Are you sure you want to recover the selected messages?');
            if(!confirmation) {
                return;
            }

            $.post(`recover/bulk`, { _token: csrfToken, selected_ids: selectedIds })
                .done(() => {
                    selectedCheckboxes.forEach(checkbox => {
                        checkbox.checked = false;
                    });

                     selectedIds.forEach(id => {
                        const messageElement = document.querySelector(`.single-message[data-id="${id}"]`);
                        if(messageElement) {
                            messageElement.remove();
                        }
                    });

                    if($('.single-message').length === 0) {
                        location.reload();
                    }
                });
        });
    </script>
@endpush