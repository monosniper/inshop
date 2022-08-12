<section class="page-banner section section_gradient-alt">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="page-banner__left">
                    <h1 class="title page-banner__title">{{$title}}</h1>
                    <p class="section__description page-banner__description">{{$description}}</p>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <img class="page-banner__img" src="{{asset('assets/img/pages/'.$img.'.png')}}" alt="{{$title}}">
            </div>
        </div>
    </div>
</section>