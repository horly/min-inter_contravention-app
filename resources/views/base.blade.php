<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }} - @yield('title')</title>

        <link rel="stylesheet" href="{{ asset('assets/app/css/style.css') }}">
    </head>
    <body>
        {{-- Tout nos contenues seront affiché ici --}}
        @yield('content')

        {{-- Lib js include --}}
        {{-- Bootstrap need proper --}}
        <script src="{{ asset('assets/lib/proper/proper.js') }}"></script>
        <script src="{{ asset('assets/lib/bootstrap/js/bootstrap.js') }}"></script>
        <script src="{{ asset('assets/lib/jquery/jquery.js') }}"></script>
        <script src="{{ asset('assets/lib/sweet-alert/sweetalert.min.js') }}"></script>
        <script src="{{ asset('assets/lib/DataTables/datatables.js') }}"></script>

        {{-- Les pages --}}
        <script src="{{ asset('assets/app/js/script.js') }}"></script>
        <script src="{{ asset('assets/app/js/dataTables-init.js') }}"></script>
    </body>
</html>
