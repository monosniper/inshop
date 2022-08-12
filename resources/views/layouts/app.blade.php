<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{--  Favicon configuration  --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('site.webmanifest')}}">
    <link rel="mask-icon" href="{{asset('safari-pinned-tab.svg')}}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    {{--  Google icons  --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">

    {{--  Bootstrap grid  --}}
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-grid.min.css')}}">

    {{--  Main styles  --}}
{{--    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">--}}
    @vite(['resources/scss/app.scss'])

    @yield('css')

    <title>@yield('title') | {{ config('app.name') }}</title>
</head>
<body>

<div class="container">
    @include('inc.header')
</div>

@yield('content')

@include('inc.footer')

{{--  Main script  --}}
{{--<script src="{{asset('assets/js/app.js')}}"></script>--}}
@vite(['resources/js/app.js'])

@yield('js')

</body>
</html>
