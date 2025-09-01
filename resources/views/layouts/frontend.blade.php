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
            <link rel="stylesheet" href="{{ asset('css/global.css') }}">
            <link rel="stylesheet" href="{{ asset('css/frontend.css') }}">
        @stack('after-styles')
    </head>

    <body>
        <x-header></x-header>

        @yield('content')
        
        <x-footer></x-footer>
        <x-notification></x-notification>

        @stack('before-scripts')
            <script src="{{ asset('js/jquery.js') }}"></script>
            <script src="{{ asset('js/bootstrap.js') }}"></script>
            <script src="{{ asset('js/date-picker-x.js') }}"></script>
            <script src="{{ asset('js/select2.js') }}"></script>
            <script src="{{ asset('js/global.js') }}"></script>
        @stack('after-scripts')
    </body>
</html>