@extends('layouts.app')

@section('title')
    Условия пользования
@endsection

@section('content')
    <div class="header-normalize"></div>

    @include('inc.page-banner', [
        'title' => 'Условия пользования',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'img' => 'use_conditions'
    ])

    <section class="section block block_grey container">
        <h3 class="title"><span class="title_contrast">#</span> Условия пользования</h3>

        <div class="page-text">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab amet, blanditiis consectetur cupiditate delectus dolorum ducimus esse eveniet, impedit inventore ipsa ipsum labore molestiae non numquam, repellat reprehenderit sequi sunt.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab amet, blanditiis consectetur cupiditate delectus dolorum ducimus esse eveniet, impedit inventore ipsa ipsum labore molestiae non numquam, repellat reprehenderit sequi sunt.</p>
        </div>
    </section>

    @include('inc.questions')

@endsection
