<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <title>{{config('app.name', 'KupVstup')}}</title>
        @yield('head') 
    </head>
    <body>
        @include('inc.navbar')
        <div class="container mt-3">
            @include('inc.messages')
            @yield('content')
        </div>
        @include('inc.footer')
        <script src="{{asset('js/app.js')}}"></script>
    </body>
</html>
