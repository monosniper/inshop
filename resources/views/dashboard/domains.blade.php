@extends('layouts.dashboard')

@section('title')
    Ваши домены
@endsection

@section('content')
    <div class="content__header">
        <h3 class="title">Ваши домены</h3>
        <a href="{{ route('domains') }}" class="button">Зарегистрировать домен</a>
    </div>

    @foreach($domains as $domain)
        @include('inc.dashboard.domain', ['name' => $domain->name . '.' . config('conf.SHOPS_DOMAIN'), 'id' => $domain->id])
    @endforeach
@endsection
