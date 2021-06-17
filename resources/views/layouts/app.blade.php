<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    @php

    $uri_fullpath = $_SERVER['REQUEST_URI'];
    $uri_parts = explode('/', $uri_fullpath);
    $nav_location = $uri_parts[1];
    
    @endphp

    <div class="container" @if($nav_location == 'login' || $nav_location == 'register')style="margin-bottom: 0px;"@endif>

        @yield('content')

    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js"></script>

    @yield('extra-scripts')
</body>

</html>
