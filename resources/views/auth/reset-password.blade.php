@extends('layouts.auth')

@section('content')
    <form method="POST" action="{{ route('password.update') }}" class="form">
        @csrf

        <input name="email" type="email" placeholder="E-mail" required value="{{ $email ?? old('email') }}" class="form__field">
        <input name="password" type="password" placeholder="Пароль" required class="form__field">
        <input name="password_confirmation" type="password" placeholder="Пароль еще раз" required class="form__field">

        <div class="form__footer">
            <button class="form__button">Восстановить пароль</button>
        </div>
    </form>
@endsection