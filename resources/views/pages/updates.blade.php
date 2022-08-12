@extends('layouts.app')

@section('title')
    Обновления
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/pages/updates.css')}}">
@endsection

@section('content')
    <div class="header-normalize"></div>

    @include('inc.page-banner', [
        'title' => 'Обновления',
        'description' => 'Список всех новых изменений на сайте',
        'img' => 'updates'
    ])

    <section class="section updates">
        <div class="container">
            <div class="updates__tags mb-4">
                <a href="#" class="updates__tag">Все</a>
                <a href="#" class="updates__tag">#Новые функции</a>
                <a href="#" class="updates__tag">#Исправления</a>
            </div>
            @for($i=0;$i<2;$i++)
                <div class="update block block_grey">
                    <div class="update__top">
                        <span class="update__date">Feb 23, 2021</span>
                    </div>
                    <h4 class="update__title title"><span class="title_contrast">#</span> ADI: HTML Embed Now Available</h4>
                    <p class="update__body">
                        You can now add HTML code and iFrames to your ADI site. Embed services like Spotify, Amazon Ad Widget, PayPal button, as well as external sites
                    </p>
                    <div class="update__footer">
                        <span class="update__tag">
                            <span class="material-icons">local_offer</span>
                            Новые функции
                        </span>
                        <a href="#" class="button update__button">Узнать больше</a>
                    </div>
                </div>
            @endfor
        </div>
    </section>

    @include('inc.questions')

@endsection