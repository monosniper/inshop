@extends('layouts.app')

@section('title')
    О нас
@endsection

@section('content')
    <div class="header-normalize"></div>

    @include('inc.page-banner', [
        'title' => 'О нас',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'img' => 'about'
    ])


    <section class="section block block_grey container">
        <h3 class="title"><span class="title_contrast">#</span> О нас</h3>

        <div class="page-text">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab amet, blanditiis consectetur cupiditate delectus dolorum ducimus esse eveniet, impedit inventore ipsa ipsum labore molestiae non numquam, repellat reprehenderit sequi sunt.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab amet, blanditiis consectetur cupiditate delectus dolorum ducimus esse eveniet, impedit inventore ipsa ipsum labore molestiae non numquam, repellat reprehenderit sequi sunt.</p>
        </div>
    </section>


    @include('inc.questions')

@endsection