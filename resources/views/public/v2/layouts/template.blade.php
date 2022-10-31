<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="{{ Library::companyProfile()[0]->company_name }}" />
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta name="viewport" content="user-scalable=no, width=device-width, height=device-height, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui" />

    <meta name="theme-color" content="#FCDB5A" />
    <meta name="msapplication-navbutton-color" content="#FCDB5A" />
    <meta name="apple-mobile-web-app-status-bar-style" content="#FCDB5A" />

	<!-- SEO Meta Tags -->
	@if (Request::segment(1) =="" || Request::segment(1) =="en")
	<meta name="description" content="{{ Library::seo()[0]->meta_description_en }}" />
	<meta name="keywords" content="{{ Library::seo()[0]->meta_keyword_en }}" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="{{ Library::seo()[0]->meta_title_en }}" />
	<meta property="og:description" content="{{ Library::seo()[0]->meta_description_en }}"/>
	<meta property="og:url" content="{{ url('/') }}" />
	<meta property="og:site_name" content="{{ Library::seo()[0]->site_name_en }}" />
	@elseif (Request::segment(1) =="id")
	<meta name="description" content="{{ Library::seo()[0]->meta_description_id }}" />
	<meta name="keywords" content="{{ Library::seo()[0]->meta_keyword_id }}" />
	<meta property="og:locale" content="id_ID" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="{{ Library::seo()[0]->meta_title_id }}" />
	<meta property="og:description" content="{{ Library::seo()[0]->meta_description_id }}"/>
	<meta property="og:url" content="{{ url('/') }}" />
	<meta property="og:site_name" content="{{ Library::seo()[0]->site_name_id }}" />
	@endif
	<!--... End Meta Tags -->

    <!-- Critical styles
    ================================================== -->
    <link rel="stylesheet" href="{{ asset('template/v2/css/critical.min.css') }}" type="text/css">
    <!-- Common styles
    ================================================== -->
    <link rel="stylesheet" href="{{ asset('template/v2/css/style.min.css') }}" type="text/css">
    
    @yield('css')

    <!-- Load google font
    ================================================== -->
    <script type="text/javascript">
        WebFontConfig = {
            google: { families: [ 'Open+Sans:300,400,500,600,700,800', 'Raleway:100,400,400i,500,500i,700,700i,900'] }
        };
        (function() {
            var wf = document.createElement('script');
            wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
            wf.type = 'text/javascript';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();
    </script>

    <!-- Load other scripts
    ================================================== -->
    <script type="text/javascript">
        var _html = document.documentElement,
            isTouch = (('ontouchstart' in _html) || (navigator.msMaxTouchPoints > 0) || (navigator.maxTouchPoints));

        _html.className = _html.className.replace("no-js","js");
        _html.classList.add( isTouch ? "touch" : "no-touch");
    </script>
    <script type="text/javascript" src="{{ asset('template/v2/js/device.min.js') }}"></script>

	<!-- Favicon
	============================================= -->
	<link rel="shortcut icon" href="{{ url('uploads/favicon') }}/{{ Library::companyProfile()[0]->favicon }}" type="image/x-icon">
	<link rel="icon" href="{{ url('uploads/favicon') }}/{{ Library::companyProfile()[0]->favicon }}" type="image/x-icon">

	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Document Title
	============================================= -->
	<title>@yield('title') | {{ Library::companyProfile()[0]->company_name }}</title>

</head>

<body class="woocommerce-page shop-home-page">
    <div id="app">
        <!-- start header -->
        @include('public.v2.parts.header')
        <!-- end header -->

        @yield('content')

        <!-- start footer -->
        @include('public.v2.parts.footer')
        <!-- end footer -->
    </div>

    <div id="btn-to-top-wrap">
        <a id="btn-to-top" class="circled" href="javascript:void(0);" data-visible-offset="800"></a>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-2.2.4.min.js"><\/script>')</script>

    <script type="text/javascript" src="{{ asset('template/v2/js/main.min.js') }}"></script>
</body>

</html>