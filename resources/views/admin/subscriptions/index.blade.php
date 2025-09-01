@extends('layouts.backend')

@section('title', 'Subscriptions')

@section('content')
    <div class="page">
        <div class="row align-items-center mb-4">
            <div class="col-8">
                <p class="title">Subscriptions</p>
                <p class="description">Manage subscriptions here.</p>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <form class="filter-form">
                    <div class="row">
                        <div class="col-5">
                            <input type="text" class="form-control input-field raleway" name="name" value="{{ $name ?? '' }}" placeholder="Search by Name">
                        </div>

                        <div class="col-5">
                            <input type="text" class="form-control input-field raleway" name="email" value="{{ $email ?? '' }}" placeholder="Search by Email">
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
                                <th scope="col" class="raleway">ACTIONS</th>
                            </tr>
                        </thead>

                        <tbody id="tBody">
                            @if(count($items) > 0)
                                @foreach($items as $item)
                                    <tr>
                                        <td>{{ $item->name ?? '-' }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{!! $item->action !!}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="text-center">No data available in the table</td>
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

        <x-delete-data data="subscription"></x-delete>
    </div>
@endsection


@push('after-scripts')
    <script>
        window.moduleRoutes = {
            destroyRoute: "{{ route('admin.subscriptions.destroy', [':id']) }}",
            filterRoute: "{{ route('admin.subscriptions.filter') }}",
            indexRoute: "{{ route('admin.subscriptions.index') }}",
            pageUrl: "{!! $items->url(1) !!}"
        };
    </script>

    <script src="{{ asset('js/index-script.js') }}"></script>
@endpush