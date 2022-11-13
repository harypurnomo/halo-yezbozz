@extends('public.v2.layouts.template')

@section('title')
	Blog
@endsection

@section('content')

<!-- start hero -->
<div id="hero" class="jarallax" data-speed="0.7" data-img-position="50% 80%" style="background-image: url({{asset('template/v2/img/intro_img/4.jpg')}});">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-7">
                <h1 class="__title"><span>Our</span> Blog</h1>

                <p>
                    The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English
                </p>
            </div>
        </div>
    </div>
</div>
<!-- end hero -->

<!-- start main -->
<main role="main">
    <!-- Load lazyLoad scripts
    ================================================== -->
    <script>
        (function(w, d){
            var m = d.getElementsByTagName('main')[0],
                s = d.createElement("script"),
                v = !("IntersectionObserver" in w) ? "8.17.0" : "10.19.0",
                o = {
                    elements_selector: ".lazy",
                    data_src: 'src',
                    data_srcset: 'srcset',
                    threshold: 500,
                    callback_enter: function (element) {

                    },
                    callback_load: function (element) {
                        element.removeAttribute('data-src')

                        oTimeout = setTimeout(function ()
                        {
                            clearTimeout(oTimeout);

                            AOS.refresh();
                        }, 1000);
                    },
                    callback_set: function (element) {

                    },
                    callback_error: function(element) {
                        element.src = "https://placeholdit.imgix.net/~text?txtsize=21&txt=Image%20not%20load&w=200&h=200";
                    }
                };
            s.type = 'text/javascript';
            s.async = true; // This includes the script as async. See the "recipes" section for more information about async loading of LazyLoad.
            s.src = "https://cdn.jsdelivr.net/npm/vanilla-lazyload@" + v + "/dist/lazyload.min.js";
            m.appendChild(s);
            // m.insertBefore(s, m.firstChild);
            w.lazyLoadOptions = o;
        }(window, document));
    </script>

    <!-- start section -->
    <section class="section">
        <div class="container">
            <!-- start posts -->
            <div class="posts posts--style-1">
                <div class="__inner">
                    <div class="row">
                        <!-- start item -->
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="__item __item--preview">
                                <figure class="__image">
                                    <img class="lazy" src="{{asset('template/v2/img/blank.gif')}}" data-src="{{asset('template/v2/img/posts_img/1.jpg')}}" alt="demo" />
                                </figure>

                                <div class="__content">
                                    <p class="__category"><a href="#">ORGANIC FOOD/TIPS & GUIDES</a></p>

                                    <h3 class="__title h5"><a href="blog_details.html">Tips for Ripening your Fruit</a></h3>

                                    <p>
                                        The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.
                                    </p>
                                </div>

                                <span class="__date-post">
                                    <strong>07</strong>Nov
                                </span>
                            </div>
                        </div>
                        <!-- end item -->

                        <!-- start item -->
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="__item __item--preview">
                                <figure class="__image">
                                    <img class="lazy" src="{{asset('template/v2/img/blank.gif')}}" data-src="{{asset('template/v2/img/posts_img/2.jpg')}}" alt="demo" />
                                </figure>

                                <div class="__content">
                                    <p class="__category"><a href="#">DIET/ORGANIC FOOD</a></p>

                                    <h3 class="__title h5"><a href="blog_details.html">Health Benefits of a Raw Food</a></h3>

                                    <p>
                                        The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.
                                    </p>
                                </div>

                                <span class="__date-post">
                                    <strong>03</strong>Nov
                                </span>
                            </div>
                        </div>
                        <!-- end item -->

                        <!-- start item -->
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="__item __item--preview">
                                <figure class="__image">
                                    <img class="lazy" src="{{asset('template/v2/img/blank.gif')}}" data-src="{{asset('template/v2/img/posts_img/4.jpg')}}" alt="demo" />
                                </figure>

                                <div class="__content">
                                    <p class="__category"><a href="#">DIET/ORGANIC FOOD</a></p>

                                    <h3 class="__title h5"><a href="blog_details.html">Superfoods you should be eating</a></h3>

                                    <p>
                                        The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.
                                    </p>
                                </div>

                                <span class="__date-post">
                                    <strong>25</strong>Oct
                                </span>
                            </div>
                        </div>
                        <!-- end item -->

                        <!-- start item -->
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="__item __item--preview">
                                <figure class="__image">
                                    <img class="lazy" src="{{asset('template/v2/img/blank.gif')}}" data-src="{{asset('template/v2/img/posts_img/5.jpg')}}" alt="demo" />
                                </figure>

                                <div class="__content">
                                    <p class="__category"><a href="#">ORGANIC FOOD/TIPS & GUIDES</a></p>

                                    <h3 class="__title h5"><a href="blog_details.html">Tips for Ripening your Fruit</a></h3>

                                    <p>
                                        The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.
                                    </p>
                                </div>

                                <span class="__date-post">
                                    <strong>07</strong>Nov
                                </span>
                            </div>
                        </div>
                        <!-- end item -->

                        <!-- start item -->
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="__item __item--preview">
                                <figure class="__image">
                                    <img class="lazy" src="{{asset('template/v2/img/blank.gif')}}" data-src="{{asset('template/v2/img/posts_img/6.jpg')}}" alt="demo" />
                                </figure>

                                <div class="__content">
                                    <p class="__category"><a href="#">DIET/ORGANIC FOOD</a></p>

                                    <h3 class="__title h5"><a href="blog_details.html">Health Benefits of a Raw Food</a></h3>

                                    <p>
                                        The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.
                                    </p>
                                </div>

                                <span class="__date-post">
                                    <strong>03</strong>Nov
                                </span>
                            </div>
                        </div>
                        <!-- end item -->

                        <!-- start item -->
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="__item __item--preview">
                                <figure class="__image">
                                    <img class="lazy" src="{{asset('template/v2/img/blank.gif')}}" data-src="{{asset('template/v2/img/posts_img/3.jpg')}}" alt="demo" />
                                </figure>

                                <div class="__content">
                                    <p class="__category"><a href="#">DIET/ORGANIC FOOD</a></p>

                                    <h3 class="__title h5"><a href="blog_details.html">Superfoods you should be eating</a></h3>

                                    <p>
                                        The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.
                                    </p>
                                </div>

                                <span class="__date-post">
                                    <strong>25</strong>oct
                                </span>
                            </div>
                        </div>
                        <!-- end item -->
                    </div>
                </div>
            </div>
            <!-- end posts -->
        </div>
    </section>
    <!-- end section -->

    <!-- start section -->
    <section class="section section--no-pt">
        <div class="container">
            <ul class="page-nav">
                <li class="page-nav__item">
                    <a href="#" class="page-nav__link page-nav__link--prev"><i class="ico fontello-left-1"></i>Older post</a>
                </li>
                <li class="page-nav__item">
                    <a href="#" class="page-nav__link page-nav__link--next">Newer post<i class="ico fontello-right-1"></i></a>
                </li>
            </ul>
        </div>
    </section>
    <!-- end section -->

    <!-- start section -->
    <section class="section section--dark-bg">
        <div class="container">
            <div class="section-heading section-heading--center section-heading--white" data-aos="fade">
                <h2 class="__title">Get <span>in touch</span></h2>

                <p>Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.</p>
            </div>

            <form class="contact-form js-contact-form" action="#" data-aos="fade">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="input-wrp">
                            <input class="textfield" name="name" type="text" placeholder="Name" />
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="input-wrp">
                            <input class="textfield" name="email" type="text" placeholder="E-mail" />
                        </div>
                    </div>
                </div>

                <div class="input-wrp">
                    <textarea class="textfield" name="message" placeholder="Comments"></textarea>
                </div>

                <button class="custom-btn custom-btn--medium custom-btn--style-3 wide" type="submit" role="button">Send</button>

                <div class="form__note"></div>
            </form>
        </div>
    </section>
    <!-- end section -->

    <!-- start section -->
    <section class="section section--no-pt section--no-pb">
        <!-- this is demo key "AIzaSyBXQROV5YMCERGIIuwxrmaZbBl_Wm4Dy5U" -->
        <div class="g_map" data-api-key="AIzaSyBXQROV5YMCERGIIuwxrmaZbBl_Wm4Dy5U" data-longitude="44.958309" data-latitude="34.109925" data-marker="{{asset('template/v2/img/marker.png')}}" style="min-height: 255px"></div>
    </section>
    <!-- end section -->
</main>
<!-- end main -->

@endsection