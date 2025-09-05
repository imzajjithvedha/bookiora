@extends('layouts.backend')

@section('title', 'Rooms')

@section('content')
    <div class="page">
        <div class="row align-items-center mb-3 mb-md-4">
            <div class="col-12 mb-3 mb-md-0 col-md-8">
                <p class="title raleway">{{ $stay->name }}: Rooms</p>
                <p class="description">Manage room details here.</p>
            </div>
            <div class="col-12 col-md-4 text-end">
                <a href="{{ route('admin.stays.rooms.create', $stay) }}" class="add-button">
                    <i class="bi bi-plus-lg"></i>
                    Add New Room
                </a>
            </div>
        </div>

        <form class="filter-form mb-3 mb-md-4">
            <div class="row">
                <div class="col-12 col-lg-3 mb-2 mb-lg-0">
                    <input type="text" class="form-control input-field raleway" name="custom_name" value="{{ $custom_name ?? '' }}" placeholder="Custom Name">
                </div>

                <div class="col-12 col-lg-3 mb-2 mb-lg-0">
                    <select class="form-select js-single input-field" id="name" name="name">
                        <x-stay-room-names-list :data="$name ?? ''"></x-stay-room-names-list>
                    </select>
                </div>

                <div class="col-12 col-lg-2 mb-2 mb-lg-0">
                    <select class="form-select js-single input-field" id="type" name="type">
                        <x-stay-room-types-list :data="$type ?? ''"></x-stay-room-types-list>
                    </select>
                </div>

                <div class="col-12 col-lg-2 mb-2 mb-lg-0">
                    <select class="form-select input-field raleway" name="status">
                        <option value="">Status</option>
                        <option value="2" {{ isset($status) && $status == 2 ? "selected" : "" }}>Active</option>
                        <option value="1" {{ isset($status) && $status == 1 ? "selected" : "" }}>Pending</option>
                        <option value="0" {{ isset($status) && $status == 0 ? "selected" : "" }}>Inactive</option>
                    </select>
                </div>
                
                <div class="col-12 col-lg-2">
                    <button type="button" class="form-control input-field raleway reset">⟲ Reset</button>
                </div>
            </div>
        </form>

        <div class="row">
            <div class="col-12">
                <x-pagination pagination="{{ $pagination }}"></x-pagination>
            
                <div class="table-container">
                    <table class="table w-100">
                        <thead>
                            <tr>
                                <th scope="col" class="raleway">THUMBNAIL</th>
                                <th scope="col" class="raleway">CUSTOM NAME <i class="bi bi-arrows-vertical sort-icon" data-name="custom_name" data-order="desc"></i></th>
                                <th scope="col" class="raleway">NAME <i class="bi bi-arrows-vertical sort-icon" data-name="name" data-order="desc"></i></th>
                                <th scope="col" class="raleway">TYPE <i class="bi bi-arrows-vertical sort-icon" data-name="type" data-order="desc"></i></th>
                                <th scope="col" class="raleway">NO OF GUESTS <i class="bi bi-arrows-vertical sort-icon" data-name="number_of_guests" data-order="desc"></i></th>
                                <th scope="col" class="raleway">CHARGE PER NIGHT <i class="bi bi-arrows-vertical sort-icon" data-name="charge_per_night" data-order="desc"></i></th>
                                <th scope="col" class="raleway">STATUS <i class="bi bi-arrows-vertical sort-icon" data-name="status" data-order="desc"></i></th>
                                <th scope="col" class="raleway">ACTIONS</th>
                            </tr>
                        </thead>

                        <tbody id="tBody">
                            @if(count($items) > 0)
                                @foreach($items as $item)
                                    <tr>
                                        <td>{!! $item->thumbnail !!}</td>
                                        <td>{{ $item->custom_name }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->type }}</td>
                                        <td>{{ $item->number_of_guests }}</td>
                                        <td>{{ $item->charge_per_night }}</td>
                                        <td>{!! $item->status !!}</td>
                                        <td>{!! $item->action !!}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" style="text-align: center;">No data available in the table</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div id="tPagination">
                    {{ $items->appends(request()->except('page'))->links("pagination::bootstrap-5") }}
                </div>
            </div>
        </div>

        <x-delete-data data="room"></x-delete>
    </div>
@endsection


@push('after-scripts')
    <script>
        window.moduleRoutes = {
            destroyRoute: "{{ route('admin.stays.rooms.destroy', [$stay->id, ':id']) }}",
            filterRoute: "{{ route('admin.stays.rooms.filter', [$stay->id]) }}",
            indexRoute: "{{ route('admin.stays.rooms.index', [$stay->id]) }}",
            pageUrl: "{!! $items->url(1) !!}"
        };
    </script>

    <script src="{{ asset('js/index-script.js') }}"></script>
@endpush