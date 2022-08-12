@extends('layouts.app')

@section('title')
    Главная
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/pages/home.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tsparticles/1.41.6/tsparticles.min.js" integrity="sha512-3+xqL+y/O1zca5dHRBG/tx5qlogCogOgSZnLRopC+bq8F5PQOJyCH/vN3+TdssOs7xQfdlObw1TMRS87k2cZdQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        new Splide( '#shops', {
            type   : 'loop',
            perPage: 4,
            perMove: 1,
            gap: '2em',
            pagination: true,
            breakpoints: {
                1150: {
                    perPage: 3,
                },
                1000: {
                    perPage: 2,
                },
                600: {
                    perPage: 1,
                },
            }
        } ).mount();

        const decorator_sections_selector = '.section_decorate';
        document.querySelectorAll(decorator_sections_selector).forEach((section, i) => {
            let section_id = 'particles-' + i;
            section.id = section_id;

            tsParticles.loadJSON(section_id, './particles.json');
        });
    </script>
@endsection

@section('content')

    <section class="banner section section_decorate">
        <div class="container">
            <div class="row">
                <div class="banner__left order-sm-1 order-md-0 col-lg-7 col-sm-12">
                    <h1 class="banner__title title">
                        Крупный агрегатор <span class="title_contrast">онлайн магазинов</span>
                    </h1>
                    <p class="banner__description section__description">
                        Создавайте интернет магазины без единой строчки кода
                    </p>
                    <button class="button banner_button button_red button_big">Создать магазин</button>
                </div>
                <div class="banner__right order-sm-0 order-md-1 col-lg-5 col-sm-12">
                    <img src="{{asset('assets/img/banner.png')}}" alt="{{config('app.name')}}" class="banner__img">
                </div>
            </div>
        </div>
    </section>

    <section class="section shop-section">
        <div class="container">
            <h2 class="section__title title title_center">
                <span class="title_contrast">Магазин</span> в {{ config('app.name') }} - это удобно и прибыльно!
            </h2>
            <div class="shop-block__items">
                @for($i=0;$i<7;$i++)
                    <div class="shop-block__item">
                        <div class="shop-block__icon">
                            <img src="{{asset('assets/img/sections/shop/1.png')}}" alt="Lorem ipsum dolor">
                        </div>
                        <div class="shop-block__title">Lorem ipsum dolor</div>
                        <div class="shop-block__description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi delectus ipsam maxime</div>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    <section class="section section_grey section_pady section_decorate">
        <div class="container">
            <h2 class="section__title title title_center title_min">
                Легчайший <span class="title_contrast">конструктор</span> общего вида магазина
            </h2>

            <p class="section__description section__description_center section__description_min">
                В наличии несколько шаблонов, которые можно модифицировать под бренд и специфику Вашего магазина всего в пару кликов.
            </p>

            <div class="laptop">
                <img src="{{asset('assets/img/laptop.png')}}" alt="Constructor" class="laptop__background">
                <div class="video">
                    <div class="video__overflow"></div>
                    <div class="video__poster">
                        <img src="{{asset('assets/img/poster.png')}}" alt="Constructor video poster">
                    </div>

                    <div class="video__play">
                        <div class="video__button">
                            <span class="material-icons">play_arrow</span>
                        </div>
                    </div>
                </div>
            </div>

            <button class="button button_red button_big button_center">Запустить конструктор <span class="material-icons">arrow_right_alt</span></button>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-12">
                    <div class="section__left">
                        <img src="{{asset('assets/img/sections/mobile.png')}}" alt="Mobile apps">
                    </div>
                </div>
                <div class="col-lg-7 col-sm-12">
                    <div class="section__right section_center-contents">
                        <h2 class="title">
                            Мы также создаем <span class="title_contrast">мобильные приложения</span> для Ваших магазинов
                        </h2>
                        <p class="section__description">Приложение создается для Андроид и IOS платформ.</p>

                        <button class="button button_red button_big">Создать магазин <span class="material-icons">arrow_right_alt</span></button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <h2 class="title title_min title_center">
                <span class="title_contrast">3446</span> созданных у нас магазинов уже работают и приносят своим владельцам <span class="title_contrast">прибыль</span>
            </h2>

            <div id="shops" class="splide">
                <div class="splide__track">
                    <ul class="splide__list">
                        <li class="splide__slide">
                            <a href="#" class="shop">
                                <div class="shop__img" style="background-image: url({{asset('assets/img/shops/1.jpg')}})"></div>
                                <div class="shop__name">Embient shop</div>
                            </a>
                        </li>
                        <li class="splide__slide">
                            <a href="#" class="shop">
                                <div class="shop__img" style="background-image: url({{asset('assets/img/shops/2.png')}})"></div>
                                <div class="shop__name">Embient shop</div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="section section_gradient section_round">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="section__left">
                        <img src="{{asset('assets/img/sections/storage.png')}}" alt="Storage">
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="section__right section_center-contents">
                        <h2 class="title">
                            Удобный онлайн-склад для учета товаров
                        </h2>
                        <p class="section__description">На складе можно увидеть полный список товаров в магазине, узнать об их наличии, редактировать и вести полный учет продукции. </p>

                        <button class="button button_red button_big">Демо онлайн-склада <span class="material-icons">arrow_right_alt</span></button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-12 mb-4">
                    <div class="block block_pad h-100 block_bordered block_img">
                        <img src="{{asset('assets/img/sections/support.png')}}" alt="support">
                    </div>
                </div>
                <div class="col-lg-8 col-sm-12 mb-4">
                   <div class="block block_pad h-100 block_bordered">
                       <h5 class="block__title">Помощь и поддержка</h5>
                       <p class="block__description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi delectus ipsam maxime
                           <br>
                           <br>
                           Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi delectus ipsam maxime Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi delectus ipsam maxime Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi delectus ipsam maxime
                       </p>
                   </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-sm-12 mb-4">
                    <div class="block block_pad h-100 block_bordered">
                        <h5 class="block__title">Мгновенный вывод</h5>
                        <p class="block__description">Lorem ipsum dolor  sit amet consectetur adipisicing elit. Modi delectus ipsa asddm maxime Lorem ipsum dolor sit amet consec  tetur adipisicing elit. Modi delec sdatus ipsam maxime Lorem ipsum dolo r sit adms det cosadnsectetur adipisicingasdelit . Modi  electus ipsam maximedasLorem ipsum dolor sit amet consectetur adipisicing elit. Modi delectus ipsam maxime
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="block block_pad h-100 block_bordered block_img">
                        <img src="{{asset('assets/img/sections/withdraw.png')}}" alt="withdraw">
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('inc.questions')

@endsection