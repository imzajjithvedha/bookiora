@extends('layouts.backend')

@section('title', 'Supports')

@section('content')
    <div class="page">
        <div class="row align-items-center mb-3 mb-md-4">
            <div class="col-12 col-md-8">
                <p class="title raleway">Supports</p>
                <p class="description">Manage supports here.</p>
            </div>
        </div>

        <form class="filter-form mb-3 mb-md-4">
            <div class="row">
                <div class="col-12 col-lg-10 mb-2 mb-lg-0">
                    <input type="text" class="form-control input-field raleway" name="name" value="{{ $name ?? '' }}" placeholder="Search by Name">
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
                                <th scope="col" class="raleway">NAME <i class="bi bi-arrows-vertical sort-icon" data-name="name" data-order="desc"></i></th>
                                <th scope="col" class="raleway">PHONE <i class="bi bi-arrows-vertical sort-icon" data-name="phone" data-order="desc"></i></th>
                                <th scope="col" class="raleway">EMAIL <i class="bi bi-arrows-vertical sort-icon" data-name="email" data-order="desc"></i></th>
                                <th scope="col" class="raleway">CATEGORY <i class="bi bi-arrows-vertical sort-icon" data-name="category" data-order="desc"></i></th>
                                <th scope="col" class="raleway">SUBJECT <i class="bi bi-arrows-vertical sort-icon" data-name="subject" data-order="desc"></i></th>
                                <th scope="col" class="raleway">MESSAGE <i class="bi bi-arrows-vertical sort-icon" data-name="message" data-order="desc"></i></th>
                                <th scope="col" class="raleway">ACTIONS</th>
                            </tr>
                        </thead>

                        <tbody id="tBody">
                            @if(count($items) > 0)
                                @foreach($items as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->category }}</td>
                                        <td>{{ $item->subject }}</td>
                                        <td>{{ $item->message }}</td>
                                        <td>{!! $item->action !!}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center">No data available in the table</td>
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

        <x-delete-data data="support"></x-delete>
    </div>
@endsection


@push('after-scripts')
    <script>
        window.moduleRoutes = {
            destroyRoute: "{{ route('admin.supports.destroy', [':id']) }}",
            filterRoute: "{{ route('admin.supports.filter') }}",
            indexRoute: "{{ route('admin.supports.index') }}",
            pageUrl: "{!! $items->url(1) !!}"
        };
    </script>

    <script src="{{ asset('js/index-script.js') }}"></script>
@endpush