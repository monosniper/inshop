@extends('layouts.auth')

@section('content')
    <form method="POST" action="{{ route('password.email') }}" class="form">
        @csrf

        <input name="email" type="email" placeholder="E-mail" required class="form__field">

        <div class="form__footer">
            <a href="{{route('login')}}" class="form__link">Войти</a>
            <button class="form__button">Отправить письмо</button>
        </div>
    </form>
@endsection