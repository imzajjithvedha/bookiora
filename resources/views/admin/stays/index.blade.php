@extends('layouts.backend')

@section('title', 'Stays')

@section('content')
    <div class="page">
        <div class="row align-items-center mb-3 mb-md-4">
            <div class="col-12 mb-3 mb-md-0 col-md-8">
                <p class="title raleway">Stays</p>
                <p class="description">Manage stay details here.</p>
            </div>
            <div class="col-12 col-md-4 text-end">
                <a href="{{ route('admin.stays.create') }}" class="add-button">
                    <i class="bi bi-plus-lg"></i>
                    Add New Stay
                </a>
            </div>
        </div>

        <form class="filter-form mb-3 mb-md-4">
            <div class="row">
                <div class="col-12 col-lg-3 mb-2 mb-lg-0">
                    <input type="text" class="form-control input-field raleway" name="name" value="{{ $name ?? '' }}" placeholder="Search by Name">
                </div>

                <div class="col-12 col-lg-3 mb-2 mb-lg-0">
                    <input type="text" class="form-control input-field raleway" name="address" value="{{ $address ?? '' }}" placeholder="Address">
                </div>

                <div class="col-12 col-lg-2 mb-2 mb-lg-0">
                    <input type="text" class="form-control input-field raleway" name="city" value="{{ $city ?? '' }}" placeholder="City">
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
                                <th scope="col" class="raleway">NAME <i class="bi bi-arrows-vertical sort-icon" data-name="name" data-order="desc"></i></th>
                                <th scope="col" class="raleway">ADDRESS <i class="bi bi-arrows-vertical sort-icon" data-name="address" data-order="desc"></i></th>
                                <th scope="col" class="raleway">CITY <i class="bi bi-arrows-vertical sort-icon" data-name="city" data-order="desc"></i></th>
                                <th scope="col" class="raleway">POST CODE <i class="bi bi-arrows-vertical sort-icon" data-name="post_code" data-order="desc"></i></th>
                                <th scope="col" class="raleway">COUNTRY <i class="bi bi-arrows-vertical sort-icon" data-name="country" data-order="desc"></i></th>
                                <th scope="col" class="raleway">STATUS <i class="bi bi-arrows-vertical sort-icon" data-name="status" data-order="desc"></i></th>
                                <th scope="col" class="raleway">ACTIONS</th>
                            </tr>
                        </thead>

                        <tbody id="tBody">
                            @if(count($items) > 0)
                                @foreach($items as $item)
                                    <tr>
                                        <td>{!! $item->thumbnail !!}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td>{{ $item->city }}</td>
                                        <td>{{ $item->post_code }}</td>
                                        <td>{{ $item->country }}</td>
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

        <x-delete-data data="stay"></x-delete>
    </div>
@endsection


@push('after-scripts')
    <script>
        window.moduleRoutes = {
            destroyRoute: "{{ route('admin.stays.destroy', [':id']) }}",
            filterRoute: "{{ route('admin.stays.filter') }}",
            indexRoute: "{{ route('admin.stays.index') }}",
            pageUrl: "{!! $items->url(1) !!}"
        };
    </script>

    <script src="{{ asset('js/index-script.js') }}"></script>
@endpush