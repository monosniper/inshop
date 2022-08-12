@extends('layouts.auth')

@section('content')
    <form method="POST" action="{{ route('register') }}" class="form">
        @csrf

        <input name="email" type="email" placeholder="E-mail" required class="form__field">
        <input name="password" type="password" placeholder="Пароль" required class="form__field">
        <input name="password_confirmation" type="password" placeholder="Пароль еще раз" required class="form__field">

        <div class="form__footer">
            <a href="{{route('login')}}" class="form__link">Войти</a>
            <button class="form__button">Регистрация</button>
        </div>
    </form>
@endsection
