<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }} | @yield('title')</title>
        <link rel="icon" href="{{ asset('storage/global/favicon.png') }}">
        
        @stack('before-styles')
            <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
            <link rel="stylesheet" href="{{ asset('css/date-picker-x.css') }}">
            <link rel="stylesheet" href="{{ asset('css/select2.css') }}">
            <link rel="stylesheet" href="{{ asset('css/froala.css') }}">
            <link rel="stylesheet" href="{{ asset('css/global.css') }}">
            <link rel="stylesheet" href="{{ asset('css/backend.css') }}">
        @stack('after-styles')
    </head>

    <body>
        <x-header></x-header>
        <x-dashboard-sidebar></x-dashboard-sidebar>

        <div class="container-fluid">
            <div class="backend-content">
                @yield('content')
            </div>
        </div>

        <x-notification></x-notification>
        <x-modal-image-preview></x-modal-image-preview>
    
        @stack('before-scripts')
            <script src="{{ asset('js/jquery.js') }}"></script>
            <script src="{{ asset('js/bootstrap.js') }}"></script>
            <script src="{{ asset('js/froala.js') }}"></script>
            <script src="{{ asset('js/select2.js') }}"></script>
            <script src="{{ asset('js/date-picker-x.js') }}"></script>
            <script src="{{ asset('js/chart.js') }}"></script>
            <script src="{{ asset('js/drag-drop-image.js') }}"></script>
            <script src="{{ asset('js/drag-drop-images.js') }}"></script>
            <script src="{{ asset('js/global.js') }}"></script>
        @stack('after-scripts')
    </body>
</html>