<footer class="footer">
    <div class="container">
        <div class="footer__content">
            <div class="footer__top">
                <div class="logo">
                    <img src="{{asset('assets/img/logo.png')}}" alt="{{config('app.name')}}">
                </div>
                <div class="footer__subscribe subscribe-form">
                    <div class="subscribe-form__wrapper">
                        <input placeholder="Подпишитесь на обновления, чтобы не пропустить ничего важного" type="email" class="subscribe-form__input">
                        <button class="button subscribe-form__button button_red">
                            <span class="material-icons">notifications</span>
                            Подписаться
                        </button>
                    </div>
                </div>
            </div>
            <div class="footer__body">
                <div class="footer__menu">
                    <div class="footer__column">
                        <h6 class="footer__title">Конструктор</h6>
                        <a href="#" class="footer__link">Мои магазины</a>
                        <a href="{{route('domains')}}" class="footer__link">Домены</a>
                        <a href="#" class="footer__link">Демо онлайн-склада</a>
                    </div>
                    <div class="footer__column">
                        <h6 class="footer__title">Компания</h6>
                        <a href="{{route('updates')}}" class="footer__link">Обновления</a>
                        <a href="{{route('about')}}" class="footer__link">О нас</a>
{{--                        <a href="{{route('use_conditions')}}" class="footer__link">Условия использования</a>--}}
                        <a href="{{route('seo')}}" class="footer__link">СЕО продвижение</a>
                        <a href="{{route('hosting')}}" class="footer__link">Хостинг</a>

                    </div>
                    <div class="footer__column">
                        <h6 class="footer__title">Помощь</h6>
                        <a href="{{route('faq')}}" class="footer__link">Вопрос-ответ</a>
                        <a href="{{route('confidential')}}" class="footer__link">Конфиденциальность</a>
                        <a href="{{route('contact')}}" class="footer__link">Связаться с нами</a>
                        <a href="{{route('pricing')}}" class="footer__link">Цены</a>

                        {{--                        <a href="{{route('sitemap')}}" class="footer__link">Карта сайта</a>--}}
                    </div>
                </div>
            </div>
            <div class="footer__bottom">
                <div class="footer__social social-icons">
                    <a href="{{ setting('social.instagram') }}" class="social-icons__item">
                        <img src="{{asset('assets/img/social/inst.png')}}" alt="instagram">
                    </a>
                    <a href="{{ setting('social.youtube') }}" class="social-icons__item">
                        <img src="{{asset('assets/img/social/yt.png')}}" alt="youtube">
                    </a>
                    <a href="{{ setting('social.facebook') }}" class="social-icons__item">
                        <img src="{{asset('assets/img/social/facebook.png')}}" alt="facebook">
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
