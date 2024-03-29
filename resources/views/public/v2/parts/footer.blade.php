<footer id="footer" class="footer footer--style-4">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-4 col-md-3 col-lg-2">
                <div class="footer__item">
                    <a class="site-logo" href="{{route('home')}}">
                        <img class="img-fluid  lazy" src="{{asset('template/v2/img/blank.gif')}}" data-src="{{ url('uploads/logo') }}/{{ Library::companyProfile()[0]->logo }}" alt="demo" />
                    </a>
                </div>
            </div>

            <div class="col-12 col-md-9 col-lg-6">
                <div class="footer__item">
                    <nav id="footer__navigation" class="navigation">
                        <div class="row">
                            <div class="col-6 col-sm-4">
                                <h5 class="footer__item__title h6">Menu</h5>

                                <ul>
                                    <li class="active"><a href="{{route('home')}}">Home</a></li>
                                    <li><a href="#">About</a></li>
                                    <li><a href="#">Pages</a></li>
                                    <li><a href="#">Gallery</a></li>
                                    <li><a href="#">Blog</a></li>
                                    <li><a href="#">Contacts</a></li>
                                </ul>
                            </div>

                            <div class="col-6 col-sm-4">
                                <h5 class="footer__item__title h6">Shop</h5>

                                <ul>
                                    <li><a href="#">Partners</a></li>
                                    <li><a href="#">Customer Service</a></li>
                                    <li><a href="#">Vegetables</a></li>
                                    <li><a href="#">Fruits</a></li>
                                    <li><a href="#">Organic Food</a></li>
                                    <li><a href="#">Privacy policy</a></li>
                                </ul>
                            </div>

                            <div class="col-6 col-sm-4">
                                <h5 class="footer__item__title h6">Information</h5>

                                <ul>
                                    <li><a href="#">Delivery</a></li>
                                    <li><a href="#">Legal Notice</a></li>
                                    <li><a href="#">About Us</a></li>
                                    <li><a href="#">Secure Payment</a></li>
                                    <li><a href="#">Prices Drop</a></li>
                                    <li><a href="#">Documents</a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>

            <div class="col-12 col-md col-lg-4">
                <div class="footer__item">
                    <h5 class="footer__item__title h6">Contacts</h5>

                    <address>
                        <p>
                            {!! Library::companyProfile()[0]->address !!}
                        </p>

                        <p>
                            {{ Library::companyProfile()[0]->phone_number }}
                        </p>

                        <p>
                            <a href="mailto:{{ Library::companyProfile()[0]->email }}">{{ Library::companyProfile()[0]->email }}</a>
                        </p>
                    </address>

                    <div class="social-btns">
                        <a href="#"><i class="fontello-twitter"></i></a>
                        <a href="#"><i class="fontello-facebook"></i></a>
                        <a href="#"><i class="fontello-linkedin-squared"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row align-items-lg-end justify-content-lg-between copyright">
            <div class="col-12 col-lg-6">
                <div class="footer__item">
                    <span class="__copy">© {{date('Y')}}, {{ Library::companyProfile()[0]->company_name }} | <a href="#">Privacy Policy</a> | <a href="#">Sitemap</a></span>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="footer__item">
                    <form class="form--horizontal no-gutters" action="#">
                        <div class="col-sm-6">
                            <div class="input-wrp">
                                <input class="textfield" name="s" type="text" placeholder="Your E-mail" />
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <button class="custom-btn custom-btn--medium custom-btn--style-3 wide" type="submit" role="button">subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</footer>