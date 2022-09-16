<header class="header container header_top-fixed">
    <div class="header__left">
        <a href="{{route('home')}}" class="logo">
            <img src="{{asset('assets/img/logo.png')}}" alt="{{config('app.name')}}">
        </a>
    </div>
    <div class="header__right">
        <div class="header__menu">
            <a href="#" class="header__link">Наши магазины</a>
            <a href="{{route('pricing')}}" class="header__link">Цены</a>
            <a href="{{route('about')}}" class="header__link">О нас</a>
        </div>
        @auth
            <a class="header__link" href="{{ env('STORAGE_URL') }}">{{ auth()->user()->email }}</a>
        @else
            <a href="{{ route('register') }}" class="header__link button button_red button_sm button_outline">Регистрация</a>
        @endauth
    </div>
    <div class="header__burger">
        <span class="material-icons">menu</span>
    </div>
</header>
