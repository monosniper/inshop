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

    {{--  Main styles  --}}
{{--    <link rel="stylesheet" href="{{asset('assets/css/pages/auth.css')}}">--}}
    @vite(['resources/css/pages\\auth.css'])

    <title>@yield('title') | {{ config('app.name') }}</title>
</head>
<body>

    <div class="wrapper">
        <div class="container">
            <div class="logo">
                <a href="{{route('home')}}">
                    <img src="{{asset('assets/img/logo.png')}}" alt="{{config('app.name')}}">
                </a>
            </div>

            @if($errors->any())
                @section('js')
                    @foreach($errors->all() as $error)
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                iziToast.show({
                                    color: 'red',
                                    message: "{{$error}}"
                                })
                            })
                        </script>
                   @endforeach
                @endsection
            @endif

            @yield('content')
        </div>
    </div>
    @vite(['resources/js/app.js'])
    @yield('js')
</body>
</html>
