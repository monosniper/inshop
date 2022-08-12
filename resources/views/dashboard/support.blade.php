@extends('layouts.dashboard')

@section('title')
    Служба поддержки
@endsection

@section('content')
    <div class="content__header">
        <h3 class="title">Служба поддержки</h3>
    </div>

    <form action="{{ route('domains') }}" method="post">
        @csrf

        <textarea required placeholder="Ваш вопрос" name="content" class="field" size="false"></textarea>

        <div class="end">
            <button class="button">Отправить</button>
        </div>
    </form>
@endsection
