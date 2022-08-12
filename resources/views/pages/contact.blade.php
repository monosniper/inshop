@extends('layouts.app')

@section('title')
    Связаться с нами
@endsection

@section('content')
    <div class="header-normalize"></div>

    <section class="section block block_grey container">
        <h3 class="title">Связаться с нами</h3>

        <form action="{{ route('contact') }}" method="post" class="form">
            @csrf

            <div class="form-row">
                <label for="email" class="label">E-mail:</label>
                <input type="email" name="email" required value="{{ auth()->check() && auth()->user()->email }}" class="field">
            </div>

            <div class="form-row">
                <label for="theme" class="label">Тема:</label>
                <input type="text" name="theme" required class="field">
            </div>

            <div class="form-row">
                <label for="content" class="label">Ваш вопрос:</label>
                <textarea placeholder="Ваш вопрос" required name="content" class="field" size="false"></textarea>
            </div>

            <div class="end">
                <button class="button button_blue">Отправить</button>
            </div>
        </form>
    </section>

    @include('inc.questions')

@endsection
