<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'KupVstup') }}</title>
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
    @yield('head') 
</head>
<body>
    <div id="app">
        @include('inc.navbar')
        <main class="container mt-3">
            @include('inc.messages')
            @yield('content')
        </main>
        @include('inc.footer')
    </div>
    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>
