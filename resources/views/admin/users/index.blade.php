@extends('layouts.backend')

@section('title', 'Users')

@section('content')
    <div class="page">
        <div class="row align-items-center mb-4">
            <div class="col-8">
                <p class="title raleway">Users</p>
                <p class="description">Manage user accounts, roles, and activity here.</p>
            </div>
            <div class="col-4 text-end">
                <a href="{{ route('admin.users.create') }}" class="add-button">
                    <i class="bi bi-plus-lg"></i>
                    Add New User
                </a>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <form class="filter-form">
                    <div class="row">
                        <div class="col-3">
                            <input type="text" class="form-control input-field raleway" name="name" value="{{ $name ?? '' }}" placeholder="Search by Name">
                        </div>

                        <div class="col-3">
                            <input type="text" class="form-control input-field raleway" name="email" value="{{ $email ?? '' }}" placeholder="Email">
                        </div>

                        <div class="col-2">
                            <select class="form-select input-field raleway" name="role">
                                <option value="">User Role</option>
                                <option value="admin" {{ isset($role) && $role == 'admin' ? "selected" : "" }}>Admin</option>
                                <option value="partner" {{ isset($role) && $role == 'partner' ? "selected" : "" }}>Partner</option>
                                <option value="customer" {{ isset($role) && $role == 'customer' ? "selected" : "" }}>Customer</option>
                            </select>
                        </div>

                        <div class="col-2">
                            <select class="form-select input-field raleway" name="status">
                                <option value="">Status</option>
                                <option value="2" {{ isset($status) && $status == 2 ? "selected" : "" }}>Active</option>
                                <option value="1" {{ isset($status) && $status == 1 ? "selected" : "" }}>Pending</option>
                                <option value="0" {{ isset($status) && $status == 0 ? "selected" : "" }}>Inactive</option>
                            </select>
                        </div>
                        
                        <div class="col-2">
                            <button type="button" class="form-control input-field raleway reset">⟲ Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <x-pagination pagination="{{ $pagination }}"></x-pagination>
            
                <div class="table-container">
                    <table class="table w-100">
                        <thead>
                            <tr>
                                <th scope="col" class="raleway">NAME <i class="bi bi-arrows-vertical sort-icon" data-name="name" data-order="desc"></i></th>
                                <th scope="col" class="raleway">EMAIL <i class="bi bi-arrows-vertical sort-icon" data-name="email" data-order="desc"></i></th>
                                <th scope="col" class="raleway">NATIONALITY <i class="bi bi-arrows-vertical sort-icon" data-name="nationality" data-order="desc"></i></th>
                                <th scope="col" class="raleway">ROLE <i class="bi bi-arrows-vertical sort-icon" data-name="role" data-order="desc"></i></th>
                                <th scope="col" class="raleway">STATUS <i class="bi bi-arrows-vertical sort-icon" data-name="status" data-order="desc"></i></th>
                                <th scope="col" class="raleway">ACTIONS</th>
                            </tr>
                        </thead>

                        <tbody id="tBody">
                            @if(count($items) > 0)
                                @foreach($items as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->nationality ?? '-' }}</td>
                                        <td>{{ ucfirst($item->role) }}</td>
                                        <td>{!! $item->status !!}</td>
                                        <td>{!! $item->action !!}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center">No data available in the table</td>
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

        <x-delete-data data="user"></x-delete-data>
    </div>
@endsection

@push('after-scripts')
    <script>
        window.moduleRoutes = {
            destroyRoute: "{{ route('admin.users.destroy', [':id']) }}",
            filterRoute: "{{ route('admin.users.filter') }}",
            indexRoute: "{{ route('admin.users.index') }}",
            pageUrl: "{!! $items->url(1) !!}"
        };
    </script>

    <script src="{{ asset('js/index-script.js') }}"></script>
@endpush