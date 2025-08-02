@extends('backend.layouts.frontend')

@section('title', 'Bookings')

@section('content')
    <div class="page">
        <div class="row align-items-center mb-4">
            <div class="col-8">
                <p class="title">Bookings</p>
                <p class="description">Manage booking details here.</p>
            </div>
            <div class="col-4 text-end">
                <a href="{{ route('admin.bookings.create') }}" class="add-button">
                    <i class="bi bi-plus-lg"></i>
                    Add New Booking
                </a>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <form class="filter-form">
                    <select class="form-select input-field js-single w-100" id="selected_tenant" name="selected_tenant">
                        <option value="">Select tenant</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ isset($selected_tenant) && $selected_tenant == $user->id ? "selected" : "" }}>{{ $user->first_name }} {{ $user->last_name }}</option>
                        @endforeach
                    </select>

                    <select class="form-select input-field js-single" id="selected_warehouse" name="selected_warehouse">
                        <option value="">Select warehouse</option>
                        @foreach($warehouses as $warehouse)
                            <option value="{{ $warehouse->id }}" {{ isset($selected_warehouse) && $selected_warehouse == $warehouse->id ? "selected" : "" }}>{{ $warehouse->name_en }}</option>
                        @endforeach
                    </select>

                    <select class="form-select input-field width" name="status">
                        <option value="">Status</option>
                        <option value="1" {{ isset($status) && $status == 1 ? "selected" : "" }}>Active</option>
                        <option value="0" {{ isset($status) && $status == 0 ? "selected" : "" }}>Inactive</option>
                        <option value="2" {{ isset($status) && $status == 2 ? "selected" : "" }}>Pending</option>
                    </select>

                    <button type="button" class="form-control input-field reset">⟲ Reset Filters</button>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <x-pagination pagination="{{ $pagination }}"></x-backend.pagination>
            
                <div class="table-container">
                    <table class="table w-100">
                        <thead>
                            <tr>
                                <th scope="col">TENANT</th>
                                <th scope="col">WAREHOUSE</th>
                                <th scope="col">PALLETS RENTED <i class="bi bi-arrows-vertical sort-icon" data-name="no_of_pallets" data-order="desc"></i></th>
                                <th scope="col">TOTAL RENT <i class="bi bi-arrows-vertical sort-icon" data-name="total_rent" data-order="desc"></i></th>
                                <th scope="col">TENANCY DATE <i class="bi bi-arrows-vertical sort-icon" data-name="tenancy_date" data-order="desc"></i></th>
                                <th scope="col">RENEWAL DATE <i class="bi bi-arrows-vertical sort-icon" data-name="renewal_date" data-order="desc"></i></th>
                                <th scope="col">STATUS <i class="bi bi-arrows-vertical sort-icon" data-name="status" data-order="desc"></i></th>
                                <th scope="col">ACTIONS</th>
                            </tr>
                        </thead>

                        <tbody id="tbody">
                            @if(count($items) > 0)
                                @foreach($items as $item)
                                    <tr>
                                        <td>{!! $item->tenant !!}</td>
                                        <td>{!! $item->warehouse !!}</td>
                                        <td>{{ $item->no_of_pallets }}</td>
                                        <td>{{ $item->total_rent }} SAR</td>
                                        <td>{{ $item->tenancy_date }}</td>
                                        <td>{{ $item->renewal_date }}</td>
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

                <div id="pagination">
                    {{ $items->appends(request()->except('page'))->links("pagination::bootstrap-5") }}
                </div>
            </div>
        </div>

        <x-delete data="booking"></x-backend.delete>
        <x-notification></x-backend.notification>
    </div>
@endsection


@push('after-scripts')
    <script>
        window.moduleRoutes = {
            destroyRoute: "{{ route('admin.bookings.destroy', [':id']) }}",
            filterRoute: "{{ route('admin.bookings.filter') }}",
            indexRoute: "{{ route('admin.bookings.index') }}",
            pageUrl: "{!! $items->url(1) !!}"
        };
    </script>

    <script src="{{ asset('backend/js/index-script.js') }}"></script>
@endpush