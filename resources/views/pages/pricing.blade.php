@extends('layouts.app')

@section('title')
    Цены
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/pages/pricing.css')}}">
@endsection

@section('js')
    <script>
        new RLSearch({
            items: [
                {
                    selector: '.price',
                    target_selector: '.price__name',
                    container_selector: '.prices'
                }
            ]
        })
    </script>
@endsection

@section('content')
    <div class="header-normalize"></div>

    @include('inc.page-banner', [
        'title' => 'Цены',
        'description' => 'Прайс-лист на все услуги на сайте',
        'img' => 'pricing'
    ])

    <section class="section">
        <div class="container">
            <div class="search-box mb-4">
                <div class="search-box__icon">
                    <span class="material-icons">search</span>
                </div>
                <input id="search-input" type="text" placeholder="Поиск" class="search-box__input">
            </div>
            <div class="prices">
                <div class="price block block_grey">
                    <div class="price__name">Some text about the price</div>
                    <div class="price__amount">25$ / месяц</div>
                </div>
                <div class="price block block_grey">
                    <div class="price__name">GG man</div>
                    <div class="price__amount">25$</div>
                </div>
                <div class="price block block_grey">
                    <div class="price__name">Auf</div>
                    <div class="price__amount">25$ / месяц</div>
                </div>
            </div>
        </div>
    </section>

    @include('inc.questions')

@endsection