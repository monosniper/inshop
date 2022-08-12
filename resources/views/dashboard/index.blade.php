@extends('layouts.dashboard')

@section('title')
    Главная
@endsection

@section('content')
    <div class="content__header">
        <h3 class="title">Личная информация</h3>
    </div>

    <form action="{{ route('domains') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <input type="text" value="{{ auth()->user()->first_name }}" placeholder="Имя" name="first_name" class="field">
            </div>
            <div class="col-lg-6 col-sm-12">
                <input type="email" value="{{ auth()->user()->email }}" required placeholder="Почта" name="first_name" class="field">
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <input type="text" value="{{ auth()->user()->last_name }}" placeholder="Фамилия" name="last_name" class="field">
            </div>
            <div class="col-lg-6 col-sm-12">
                <input type="text" value="{{ auth()->user()->phone }}" placeholder="Телефон" name="phone" class="field">
            </div>
        </div>

        <div class="end">
            <button class="button">Сохранить</button>
        </div>
    </form>
@endsection
