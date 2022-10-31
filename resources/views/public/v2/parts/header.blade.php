<header id="top-bar" class="top-bar top-bar--style-2">
    <div class="top-bar__bg" style="background-color: #FFF;background-image: url({{asset('template/v2/img/top_bar_bg-2.png')}});background-repeat: no-repeat;background-position: center bottom;"></div>

    <div class="container position-relative">
        <div class="row justify-content-between no-gutters">

            <a class="top-bar__logo site-logo" href="{{url('en/home')}}">
                {{-- <img class="img-fluid" src="{{asset('template/v2/img/site_logo.png')}}" alt="demo" /> --}}
                <img class="img-fluid" src="{{ url('uploads/logo') }}/{{ Library::companyProfile()[0]->logo }}" alt="demo" style="max-width: 100px; max-height: 130px;" />
            </a>

            <a id="top-bar__navigation-toggler" class="top-bar__navigation-toggler top-bar__navigation-toggler--dark" href="javascript:void(0);"><span></span></a>

            <div id="top-bar__inner" class="top-bar__inner  text-lg-right">
                <div>
                    <div class="d-lg-flex flex-lg-column-reverse align-items-lg-end">
                        <nav id="top-bar__navigation" class="top-bar__navigation navigation" role="navigation">
                            <ul>
                                <li class="{{ (Request::path()=='' || Request::path()=='/' || Request::path()=='en/home' || Request::path()=='id/home')?'active':'' }}">
                                    <a href="{{url('en/home')}}">Home</a>
                                </li>
                                <li class="{{ (Request::path()=='en/shop' || Request::path()=='id/shop')?'active':'' }}">
                                    <a href="{{url('en/shop')}}">Shop</a>
                                </li>
                                <li class="{{ (Request::path()=='en/about' || Request::path()=='id/about')?'active':'' }}">
                                    <a href="{{url('en/about')}}">About</a>
                                </li>
                                <li class="{{ (Request::path()=='en/blog' || Request::path()=='id/blog')?'active':'' }}">
                                    <a href="{{url('en/blog')}}">Blog</a>
                                </li>
                                <li class="li-profile">
                                    <a href="{{url('en/sign-in')}}"><i class="fontello-profile"></i></a>
                                </li>
                                <li class="li-btn">
                                    <a class="custom-btn custom-btn--small custom-btn--style-2" href="#">Get in Touch</a>
                                </li>
                            </ul>
                        </nav>

                        <div class="top-bar__contacts">
                            <span>{{ Library::companyProfile()[0]->address }}</span>
                            <span><a href="#">{{ Library::companyProfile()[0]->phone_number }}</a></span>
                            <span><a href="mailto:{{ Library::companyProfile()[0]->email }}">{{ Library::companyProfile()[0]->email }}</a></span>

                            <div class="social-btns">
                                <a class="fontello-twitter" href="{{ Library::companyProfile()[0]->twitter }}"></a>
                                <a class="fontello-facebook" href="{{ Library::companyProfile()[0]->facebook }}"></a>
                                <a class="fontello-instagram" href="{{ Library::companyProfile()[0]->instagram }}"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>