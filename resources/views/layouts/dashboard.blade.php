<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | Личный кабинет - {{ config('app.name') }}</title>

    {{--  Bootstrap grid  --}}
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-grid.min.css')}}">

    {{--  Main styles  --}}
    <link rel="stylesheet" href="{{asset('assets/css/pages/dashboard.css')}}">
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <a class="logo" href="{{ route('home') }}">
                <img src="{{ asset('assets/img/logo.png') }}" alt="{{ config('app.name') }}">
            </a>
            <div class="row">
                <div class="col-lg-3 col-sm-12">
                    <div class="sidebar block">
                        <span class="sidebar__title">Привет, Имя</span>
                        <div class="menu">
                            <a href="{{ route('dashboard.index') }}" class="menu__item {{ url()->current() === route('dashboard.index') ? 'menu__item_active' : '' }}">Профиль</a>
                            <a href="{{ route('dashboard.domains') }}" class="menu__item {{ url()->current() === route('dashboard.domains') ? 'menu__item_active' : '' }}">Домены</a>
                            <a href="{{ 'https://constructor.' . config('app.domain') }}" target="_blank" class="menu__item">
                                Магазины
                                <img src="{{ asset('assets/img/icons/link.png') }}" alt="Constructor">
                            </a>
                            <a href="{{ route('dashboard.support') }}" class="menu__item {{ url()->current() === route('dashboard.support') ? 'menu__item_active' : '' }}">Служба поддержки</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-sm-12">
                    <div class="content block">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/app.js') }}"></script>

    @include('inc.notifications')
</body>
</html>
