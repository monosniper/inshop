@extends('layouts.app')

@section('title')
    Домены
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/pages/domains.css')}}">
    <style>
        .button {
            transition: width .3s ease-in;
            min-width: 100px;
        }
    </style>
@endsection

@section('js')
    <script>
        function debounce(callee, timeoutMs) {
            return function perform(...args) {
                let previousCall = this.lastCall;
                this.lastCall = Date.now();
                if (previousCall && this.lastCall - previousCall <= timeoutMs) {
                    clearTimeout(this.lastCallTimer);
                }
                this.lastCallTimer = setTimeout(() => callee(...args), timeoutMs);
            };
        }

        const input = document.querySelector('#domain-input');
        const subdomain = document.querySelector('#subdomain');
        const button = document.querySelector('#register-button');
        const button_loading_class = 'button_loading';
        const button_text = 'Зарегистрировать бесплатно';

        button.innerText = button_text

        const setSubdomain = (value) => {
            subdomain.innerText = value;
        }

        const handleInputDomain = (e) => {
            const {value} = e.target;

            setSubdomain(value)
        }

        const startLoading = () => {
            button.classList.add(button_loading_class);
            button.innerText = ''
        }

        const stopLoading = () => {
            button.classList.remove(button_loading_class);
            button.innerText = button_text
        }

        const registerSubdomain = (domain) => {
            axios.post("{{ url()->signedRoute('api.inside.hosting.register') }}", {
                domain,
                user_id: "{{ auth()->id() }}"
            }).then((rs) => {
                const success_text = 'Домен "' + domain + '" успешно зарегистрирован, и будет готов к работе в ближайшее время.';
                const error_text = 'Произошла ошибка, попробуйте позже.';

                let type = 'success';
                let text = success_text;

                if (!rs.data.result) {
                    type = 'error'

                    if(rs.data.messages.error) {
                        text = rs.data.messages.error[0]
                    } else {
                        text = error_text
                    }
                }

                new Noty({type, text}).show();
            }).catch(() => {
                new Noty({type: 'error', text: 'Домен "' + domain  + '" уже занят'}).show();
            }).finally(stopLoading)
        }

        const handleClickRegisterButton = () => {
            if("{{ auth()->check() }}" === '1') {
                startLoading()
                registerSubdomain(input.value)
            } else {
                // new Noty({type: 'error', text: 'Для начала необходимо войти'}).show();
                iziToast.show({
                    color: 'yellow',
                    title: 'Внимание!',
                    message: 'Для начала необходимо войти',
                });
            }
        }

        input.addEventListener('input', handleInputDomain)
        button.addEventListener('click', handleClickRegisterButton)
    </script>
@endsection

@section('content')
    <div class="header-normalize"></div>

    @include('inc.page-banner', [
        'title' => 'Домены',
        'description' => 'Регистрация и проверка доступности доменов для магазинов',
        'img' => 'domains'
    ])

    <section class="section">
        <div class="container">
            <div class="search-box mb-4">
                <div class="search-box__icon">
                    <span class="material-icons">search</span>
                </div>
                <input id="domain-input" type="text" placeholder="Введите название домена" class="search-box__input">
            </div>

            <div class="row">
                <div class="col-lg-8 col-sm-12">
                    <div class="block block_grey domain">
                        <div class="domain__top">
                            <div class="domain__name title"><span class="title_contrast" id="subdomain">shop</span>.{{ config('app.shops_domain') }} <span
                                    class="domain__tag">- домен вашего магазина</span></div>
                        </div>
                        <div class="domain__bottom">
                            <button id="register-button"
                                    class="button button_red button_no-border-rad domain__button"></button>
                        </div>
                    </div>
                    <div class="block block_grey domain">
                        <div class="domain__top">
                            <div class="domain__name title">shop.com</div>
                        </div>
                        <div class="domain__bottom">
                            <span class="domain__price">20$ / месяц</span>
                            <button class="button button_red button_no-border-rad domain__button">Зарегистрировать</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <h4 class="title mb-4">Доступные доменные зоны:</h4>
                    <div class="domain-zone block block_grey mb-2">
                        <div class="domain-zone__name">.com</div>
                        <div class="domain-zone__price">20$ / месяц</div>
                    </div>
                    <div class="domain-zone block block_grey mb-2">
                        <div class="domain-zone__name">.shop</div>
                        <div class="domain-zone__price">10$ / месяц</div>
                    </div>
                    <div class="domain-zone block block_grey mb-2">
                        <div class="domain-zone__name">.store</div>
                        <div class="domain-zone__price">10$ / месяц</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="block block_grey more-domains">
                <p>Больше о доменных зонах и регистрации вы можете узнать на странице <a href="{{route('hosting')}}">Хостинг</a>
                </p>
            </div>
        </div>
    </section>

    @include('inc.questions')

@endsection
