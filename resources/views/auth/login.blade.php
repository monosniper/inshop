@extends('layouts.auth')

@section('content')
    <form method="POST" action="{{ route('login') }}" class="form">
        @csrf

        <input name="email" type="email" placeholder="E-mail" required class="form__field">
        <input name="password" type="password" placeholder="Пароль" required class="form__field">

        <div class="form__footer">
            <a href="{{route('register')}}" class="form__link">Регистрация</a>
            <button class="form__button">Войти</button>
        </div>
        <div>
            <a href="{{route('password.request')}}" class="form__link">Забыли пароль?</a>
        </div>
    </form>
@endsection
