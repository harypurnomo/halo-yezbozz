@extends('public.v2.layouts.template')

@section('title')
	@if (Request::segment(1) =="" || Request::segment(1) =="id")
	Halaman Tidak Ditemukan
	@else
	Page Not Found
	@endif
@endsection

@section('content')

<!-- start hero -->
<div id="hero" class="jarallax" data-speed="0.7" data-img-position="50% 80%" style="background-image: url({{asset('template/v2/img/intro_img/9.jpg')}});">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-7">
                <h1 class="__title"><span>page</span> 404 not found</h1>
            </div>
        </div>
    </div>
</div>
<!-- end hero -->

<!-- start main -->
<main role="main" class="page-404">

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
            <div class="text-center">
                <div class="mb-9">
                    <img class="img-fluid" src="{{asset('template/v2/img/404.jpg')}}" alt="demo" />
                </div>

                <div class="__text">
                    <h3>Oops! <span>That page can’t be found.</span></h3>

                    <p>
                        <strong>It looks like nothing was found at this location. Maybe try a search?</strong>
                    </p>
                </div>

                <div class="center-block" style="max-width: 700px">
                    <form class="form--horizontal" action="#" method="get">
                        <div class="input-wrp">
                            <input class="textfield" name="s" type="text" placeholder="Search" />
                        </div>

                        <button class="custom-btn custom-btn--tiny custom-btn--style-1" type="submit" role="button">Find</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->
</main>
<!-- end main -->

@endsection