@extends('layouts.backend')

@section('title', 'Dashboard')

@section('content')
    <div class="page dashboard">
        <div class="row mb-4">
            <div class="col-12">
                <p class="title raleway">Dashboard</p>
                <p class="description">Manage and track operations seamlessly here.</p>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-3">
                <div class="single-box">
                    <div class="top">
                        <div class="left">
                            <p class="text">Total Customers</p>
                            <p class="value">{{ $total_customers }}</p>
                        </div>

                        <div class="right">
                            <i class="bi bi-people-fill icon"></i>
                        </div>
                    </div>

                    <p class="text">{!! $customer_month_percentage !!}</p>
                </div>
            </div>

            <div class="col-3">
                <div class="single-box">
                    <div class="top">
                        <div class="left">
                            <p class="text">Total Partners</p>
                            <p class="value">{{ $total_partners }}</p>
                        </div>

                        <div class="right">
                            <i class="bi bi-person-vcard-fill icon"></i>
                        </div>
                    </div>

                    <p class="text">{!! $partner_month_percentage !!}</p>
                </div>
            </div>

            <div class="col-3">
                <div class="single-box">
                    <div class="top">
                        <div class="left">
                            <p class="text">Total Stays</p>
                            <p class="value">{{ $total_stays }}</p>
                        </div>

                        <div class="right">
                            <i class="bi bi-buildings-fill icon"></i>
                        </div>
                    </div>

                    <p class="text">{!! $stay_month_percentage !!}</p>
                </div>
            </div>

            <div class="col-3">
                <div class="single-box">
                    <div class="top">
                        <div class="left">
                            <p class="text">Total Income</p>
                            <p class="value">{{ $total_income }} LKR</p>
                        </div>

                        <div class="right">
                            <i class="bi bi-wallet-fill icon"></i>
                        </div>
                    </div>

                    <p class="text">{!! $income_month_percentage !!}</p>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <div class="box">
                    <p class="box-title raleway">Revenue</p>
                    <p class="box-description">{!! $income_month_percentage !!}</p>
                    <canvas id="revenue-year-chart"></canvas>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="box">
                    <p class="box-title">Monthly Registered Users</p>
                    <p class="box-description">{!! $user_month_percentage !!}</p>
                    <canvas id="user-year-chart"></canvas>
                </div>
            </div>

            <div class="col-6">
                <div class="box">
                    <p class="box-title">Monthly Bookings</p>
                    <p class="box-description">{!! $booking_month_percentage !!}</p>
                    <canvas id="booking-year-chart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script>
        const revenueYearChart = document.getElementById('revenue-year-chart');
        new Chart(revenueYearChart, {
            type: 'line',
            data: {
                labels: @json($months),
                datasets: [
                    {
                        label: 'Last Year Revenue',
                        data: @json($last_year_income_data),
                        borderColor: '#A5A3A4',
                        // backgroundColor: '#F6F6F6',
                        borderWidth: 3,
                        fill: false,
                        pointRadius: 2,
                        tension: 0.4
                    },
                    {
                        label: 'Current Year Revenue',
                        data: @json($current_year_income_data),
                        borderColor: '#EF7C7C',
                        // backgroundColor: '#F9D7D7A3',
                        borderWidth: 3,
                        fill: false,
                        pointRadius: 2,
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: false,
                    },
                    legend: {
                        position: 'bottom',
                         labels: {
                            color: '#444'
                        }
                    },
                    tooltip: {
                    enabled: true,
                    callbacks: {
                            label: function(context) {
                                const value = context.parsed.y;

                                return `Revenue: ${value.toLocaleString()} SAR`;
                            }
                        }
                    }
                }
            }
        });
    </script>

    <script>
        const userYearChart = document.getElementById('user-year-chart');
        new Chart(userYearChart, {
            type: 'line',
            data: {
                labels: @json($months),
                datasets: [
                    {
                        label: 'Last Year Users',
                        data: @json($last_year_user_data),
                        borderColor: '#FFAE4C',
                        // backgroundColor: '#EBF0FB',
                        borderWidth: 3,
                        fill: false,
                        pointRadius: 2,
                        tension: 0.4
                    },
                    {
                        label: 'Current Year Users',
                        data: @json($current_year_user_data),
                        borderColor: '#EF7C7C',
                        // backgroundColor: '#FFFAEF',
                        borderWidth: 3,
                        fill: false,
                        pointRadius: 2,
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                     title: {
                        display: false,
                    },
                    legend: {
                        position: 'bottom',
                         labels: {
                            color: '#444'
                        }
                    },
                    tooltip: {
                    enabled: true,
                    callbacks: {
                            label: function(context) {
                                const value = context.parsed.y;

                                return `Users: ${value.toLocaleString()}`;
                            }
                        }
                    }
                }
            }
        });
    </script>

    <script>
        const bookingYearChart = document.getElementById('booking-year-chart');
        new Chart(bookingYearChart, {
            type: 'line',
            data: {
                labels: @json($months),
                datasets: [
                    {
                        label: 'Last Year Bookings',
                        data: @json($last_year_booking_data),
                        borderColor: '#FFAE4C',
                        // backgroundColor: '#EBF0FB',
                        borderWidth: 3,
                        fill: false,
                        pointRadius: 2,
                        tension: 0.4
                    },
                    {
                        label: 'Current Year Bookings',
                        data: @json($current_year_booking_data),
                        borderColor: '#EF7C7C',
                        // backgroundColor: '#FFFAEF',
                        borderWidth: 3,
                        fill: false,
                        pointRadius: 2,
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                     title: {
                        display: false,
                    },
                    legend: {
                        position: 'bottom',
                         labels: {
                            color: '#444'
                        }
                    },
                    tooltip: {
                    enabled: true,
                    callbacks: {
                            label: function(context) {
                                const value = context.parsed.y;

                                return `Bookings: ${value.toLocaleString()}`;
                            }
                        }
                    }
                }
            }
        });
    </script>
@endpush