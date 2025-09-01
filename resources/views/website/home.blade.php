@extends('layouts.frontend')

@section('title', 'Home')

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/home.css') }}">
@endpush
 
@section('content')
    <div class="home">
        <div class="section-1 section-margin">
            <img src="{{ asset('storage/frontend/banner.jpeg') }}" alt="Banner" class="banner">

            <div class="overlay">
                <h1 class="title">A place to call home on your next adventure</h1>

                <p class="description">Choose from houses, villas, chalets and more</p>

                <div class="search-bar" id="searchBar">
                    <form action="{{ route('stays.filter') }}" method="GET">
                        <div class="search-inputs">
                            <div class="search-item">
                                <p class="search-label">Location</p>
                                <input type="text" class="search-input" placeholder="Where are you going?" name="location">
                            </div>
                            <div class="divider"></div>
                            
                            <div class="search-item">
                                <p class="search-label">Check-in Date</p>
                                <input type="text" class="date date-picker-field" id="tenancy_date" name="tenancy_start" placeholder="Check-in Date">
                            </div>

                            <div class="divider"></div>
                            
                            <div class="search-item">
                                <p class="search-label">Check-out Date</p>
                                <input type="text" class="date date-picker-field" id="tenancy_date" name="tenancy_end" placeholder="Check-out Date">
                            </div>

                            <div class="divider"></div>
                            
                            <div class="search-item">
                                <p class="search-label">Adults, Children, Rooms</p>

                                <p class="search-input dropdown-toggle" id="filter">
                                    Choose
                                </p>

                                <div class="filters d-none">
                                    <p class="dropdown-title">Choose</p>

                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-check">
                                                <input id="50" class="form-check-input check" type="radio" value="50" name="warehouse_size">
                                                <label for="50" class="form-check-label label">Adults</label>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-check">
                                                <input id="100" class="form-check-input check" type="radio" value="100" name="warehouse_size">
                                                <label for="100" class="form-check-label label">Children</label>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-check">
                                                <input id="200" class="form-check-input check" type="radio" value="200" name="warehouse_size">
                                                <label for="200" class="form-check-label label">Rooms</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="search-button"><i class="bi bi-search"></i>Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="section-3 container section-margin">
            <p class="section-title">Featured Hotels</p>

            <div class="row">
                <div class="col-3">
                    <div class="single">
                        <img src="{{ asset('storage/frontend/hotels.jpeg') }}" alt="Hotels">
                        <p class="title">Hotels</p>
                    </div>
                </div>

                <div class="col-3">
                    <div class="single">
                        <img src="{{ asset('storage/frontend/hotels.jpeg') }}" alt="Hotels">
                        <p class="title">Apartments</p>
                    </div>
                </div>

                <div class="col-3">
                    <div class="single">
                        <img src="{{ asset('storage/frontend/hotels.jpeg') }}" alt="Hotels">
                        <p class="title">Resorts</p>
                    </div>
                </div>

                <div class="col-3">
                    <div class="single">
                        <img src="{{ asset('storage/frontend/hotels.jpeg') }}" alt="Hotels">
                        <p class="title">Villas</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-2 container section-margin">
            <p class="section-title">Browse by Property Type</p>

            <div class="row">
                <div class="col-3">
                    <div class="single">
                        <img src="{{ asset('storage/frontend/hotels.jpeg') }}" alt="Hotels">
                        <p class="title">Hotels</p>
                    </div>
                </div>

                <div class="col-3">
                    <div class="single">
                        <img src="{{ asset('storage/frontend/hotels.jpeg') }}" alt="Hotels">
                        <p class="title">Apartments</p>
                    </div>
                </div>

                <div class="col-3">
                    <div class="single">
                        <img src="{{ asset('storage/frontend/hotels.jpeg') }}" alt="Hotels">
                        <p class="title">Resorts</p>
                    </div>
                </div>

                <div class="col-3">
                    <div class="single">
                        <img src="{{ asset('storage/frontend/hotels.jpeg') }}" alt="Hotels">
                        <p class="title">Villas</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script>
        $('#filter').on('click', function() {
            $('.filters').toggleClass('d-none');
        });
    </script>
@endpush