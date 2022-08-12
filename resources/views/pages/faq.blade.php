@extends('layouts.app')

@section('title')
    F.A.Q
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/pages/faq.css')}}">
@endsection

@section('js')
    <script>
        const category_selector = '.category';
        const category_toggler_selector = '.category__top';
        const category_active_class = 'active';

        document.querySelectorAll(category_selector).forEach(category => {
            category.querySelector(category_toggler_selector).addEventListener('click', () => {
                category.classList.toggle(category_active_class);
            })
        })

        const slideCategoryWithFoundQuestions = (el) => {
            const category = el.closest(category_selector);

            !category.classList.contains('active') && category.classList.add('active');
        }

        const faq_search = new RLSearch({
            items: [
                {
                    selector: '.category__title',
                },
                {
                    selector: '.question',
                    container_selector: '.category__list',
                },
            ],
        }).on('found', slideCategoryWithFoundQuestions)
    </script>
@endsection

@section('content')
    <div class="header-normalize"></div>

    @include('inc.page-banner', [
        'title' => 'Вопрос-ответ',
        'description' => 'Здесь вы можете найти ответы на часто задаваемые вопросы',
        'img' => 'faq'
    ])

    <section class="section faq">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <div class="block  faq-block block_grey faq__sidebar">
                        <h4 class="mb-3">F.A.Q.</h4>
                        <div class="faq__nav">
                            @for($i=0;$i<10;$i++)
                                <div class="category">
                                    <div class="category__top">
                                        <div class="category__icon">
                                            <span class="material-icons">chevron_right</span>
                                        </div>
                                        <div class="category__title">
                                            Категория часто задаваемых вопросов
                                        </div>
                                    </div>
                                    <div class="category__list">
                                        <a href="#" class="question">Часто задаваемый вопрос</a>
                                        <a href="#" class="question">Часто задаваемый вопрос</a>
                                        <a href="#" class="question">Часто задаваемый вопрос</a>
                                        <a href="#" class="question">Часто задаваемый вопрос</a>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <div class="search-box mb-4">
                        <div class="search-box__icon">
                            <span class="material-icons">search</span>
                        </div>
                        <input id="search-input" type="text" placeholder="Введите интересующий вопрос" class="search-box__input">
                    </div>
                    <div class="block block_grey">
                        <h3 class="faq__title"><span class="title_contrast">#</span> Часто задаваемый вопрос</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('inc.questions')

@endsection
