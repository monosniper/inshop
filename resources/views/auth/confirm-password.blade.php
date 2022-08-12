@extends('layouts.auth')

@section('content')
    <form method="POST" action="{{ route('password.confirm') }}" class="form">
        @csrf

        <input name="password" type="password" placeholder="Пароль" required class="form__field">

        <div class="form__footer">
            <button class="form__button">Подтвердить пароль</button>
        </div>
        <div>
            <a href="{{route('password.request')}}" class="form__link">Забыли пароль?</a>
        </div>
    </form>
@endsection
