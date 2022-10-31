<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="{{ Library::companyProfile()[0]->company_name }}" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- SEO Meta Tags -->
	@if (Request::segment(1) =="" || Request::segment(1) =="en")
	<meta name="description" content="{{ Library::seo()[0]->meta_description_en }}" />
	<meta name="keywords" content="{{ Library::seo()[0]->meta_keyword_en }}" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="{{ Library::seo()[0]->meta_title_en }}" />
	<meta property="og:description" content="{{ Library::seo()[0]->meta_description_en }}"/>
	<meta property="og:url" content="{{ env('APP_URL') }}" />
	<meta property="og:site_name" content="{{ Library::seo()[0]->site_name_en }}" />
	@elseif (Request::segment(1) =="id")
	<meta name="description" content="{{ Library::seo()[0]->meta_description_id }}" />
	<meta name="keywords" content="{{ Library::seo()[0]->meta_keyword_id }}" />
	<meta property="og:locale" content="id_ID" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="{{ Library::seo()[0]->meta_title_id }}" />
	<meta property="og:description" content="{{ Library::seo()[0]->meta_description_id }}"/>
	<meta property="og:url" content="{{ env('APP_URL') }}" />
	<meta property="og:site_name" content="{{ Library::seo()[0]->site_name_id }}" />
	@endif

	<!-- Stylesheets
	============================================= -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Raleway:300,400,500,600,700|Crete+Round:400i" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('template/v1') }}/css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="{{ asset('template/v1') }}/style.css" type="text/css" />
	<link rel="stylesheet" href="{{ asset('template/v1') }}/css/dark.css" type="text/css" />
	<link rel="stylesheet" href="{{ asset('template/v1') }}/css/font-icons.css" type="text/css" />
	<link rel="stylesheet" href="{{ asset('template/v1') }}/css/animate.css" type="text/css" />
	<link rel="stylesheet" href="{{ asset('template/v1') }}/css/magnific-popup.css" type="text/css" />
	<link rel="stylesheet" href="{{ asset('template/v1') }}/css/responsive.css" type="text/css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.1/css/font-awesome.min.css" />

	<!-- Custom Stylesheets
	============================================= -->
	<link rel="stylesheet" href="{{ asset('template/v1') }}/css/custom.css" type="text/css" />

	<!-- Favicon
	============================================= -->
	<link rel="shortcut icon" href="{{ url('uploads/favicon') }}/{{ Library::companyProfile()[0]->favicon }}" type="image/x-icon">
	<link rel="icon" href="{{ url('uploads/favicon') }}/{{ Library::companyProfile()[0]->favicon }}" type="image/x-icon">

	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Document Title
	============================================= -->
	<title>{{ Library::companyProfile()[0]->company_name }} | @yield('title')</title>
</head>

<body class="stretched bg-light">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Content
		============================================= -->
		@yield('content')
		<!-- #content end -->

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

	<!-- External JavaScripts
	============================================= -->
	<script src="{{ asset('template/v1') }}/js/jquery.js"></script>
	<script src="{{ asset('template/v1') }}/js/plugins.js"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="{{ asset('template/v1') }}/js/functions.js"></script>
	<script src="https://www.google.com/recaptcha/api.js"></script>
	@yield('js')

</body>
</html>