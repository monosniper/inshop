@extends('layouts.app')

@section('title')
    Карта сайта
@endsection

@section('content')
    <div class="header-normalize"></div>

    @include('inc.page-banner', [
        'title' => 'Карта сайта',
        'description' => 'Удобный способ навигации по сайту',
        'img' => 'sitemap'
    ])

    <section class="section sitemap">
        <div class="container">
            <div class="row">
                @for($i=0;$i<3;$i++)
                    <div class="col-lg-4 col-sm-12 col-md-6">
                        <div class="block block_grey">
                            <h4 class="block__title sitemap__title title title_center">Помощь</h4>
                            @for($k=0;$k<9;$k++)
                                <a href="#" class="sitemap__link">Ссылка карты</a>
                            @endfor
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    @include('inc.questions')

@endsection