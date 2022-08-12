@extends('layouts.auth')

@section('content')
    <form method="POST" action="{{ route('verification.resend') }}" class="form">
        @csrf

        <p>
            Письмо со ссылкой верификации было отправлено на вашу почту. Если вы не получили письмо, нажмите на кнопку ниже.
        </p>

        <div class="form__footer">
            <button class="form__button">Нажмите для повторной отправки</button>
        </div>
    </form>
@endsection
