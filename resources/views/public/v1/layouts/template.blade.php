<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="{{ Library::companyProfile()[0]->company_name }}" />
	<meta name='viewport' content='initial-scale=1, viewport-fit=cover'>

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

	<!-- Stylesheets
	============================================= -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,900" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="{{ asset('template/v1/css/bootstrap.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('template/v1/style.css') }}" type="text/css" />

	<link rel="stylesheet" href="{{ asset('template/v1/css/dark.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('template/v1/css/font-icons.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('template/v1/css/animate.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('template/v1/css/magnific-popup.css') }}" type="text/css" />

	<!-- Bootstrap Switch CSS -->
	<link rel="stylesheet" href="{{ asset('template/v1/css/components/bs-switches.css') }}" type="text/css" />

	<link rel="stylesheet" href="{{ asset('template/v1/css/responsive.css') }}" type="text/css" />

	<!-- Seo Demo Specific Stylesheet -->
	<link rel="stylesheet" href="{{ asset('template/v1/css/colors.php?color=FE9603') }}" type="text/css" /> <!-- Theme Color -->
	<link rel="stylesheet" href="{{ asset('template/v1/demos/seo/css/fonts.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('template/v1/demos/seo/seo.css') }}" type="text/css" />
	<!-- / -->

	<link rel="stylesheet" href="{{ asset('template/v1/custom.css') }}" type="text/css" />

	@yield('css')

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

<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Top Bar
		============================================= -->
		@include('public.v1.parts.topbar')
		<!-- #top-bar end -->

		<!-- Header
		============================================= -->
		<header id="header" class="transparent-header floating-header clearfix">

			<div id="header-wrap">

				<div class="container clearfix">

					<div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

					<!-- Logo
					============================================= -->
					<div id="logo">
						<a href="{{ url('/') }}" class="standard-logo">
							<img src="{{ url('uploads/logo') }}/{{ Library::companyProfile()[0]->logo }}" alt="{{ Library::companyProfile()[0]->company_name }} Logo">
						</a>
						<a href="{{ url('/') }}" class="retina-logo" >
							<img src="{{ url('uploads/logo') }}/{{ Library::companyProfile()[0]->logo }}" alt="{{ Library::companyProfile()[0]->company_name }} Logo">
						</a>
					</div><!-- #logo end -->

					<!-- Primary Navigation
					============================================= -->
					@include('public.v1.parts.navbar')
					<!-- #primary-menu end -->

				</div>

			</div>

		</header><!-- #header end -->

		<!-- Content
		============================================= -->
		@yield('content')
		<!-- #content end -->

		<!-- Footer
		============================================= -->
		<footer id="footer" class="noborder bg-white">
		@include('public.v1.parts.footer')
		</footer><!-- #footer end -->


	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

	<!-- Internal JavaScripts
	============================================= -->
	<script src="https://www.google.com/recaptcha/api.js"></script>
	<script src="{{ asset('template/v1/js/jquery.js') }}"></script>
	<script src="{{ asset('template/v1/js/plugins.js') }}"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="{{ asset('template/v1/js/functions.js') }}?{{date('YmdHis')}}"></script>

	<!-- External JavaScripts
	============================================= -->

	

	<script>
		//Pricing Table Script
		jQuery(document).ready( function($){
			function pricingSwitcher( elementCheck, elementParent, elementPricing ) {
				elementParent.find('.pts-left,.pts-right').removeClass('pts-switch-active');
				elementPricing.find('.pts-switch-content-left,.pts-switch-content-right').addClass('hidden');

				if( elementCheck.filter(':checked').length > 0 ) {
					elementParent.find('.pts-right').addClass('pts-switch-active');
					elementPricing.find('.pts-switch-content-right').removeClass('hidden');
				} else {
					elementParent.find('.pts-left').addClass('pts-switch-active');
					elementPricing.find('.pts-switch-content-left').removeClass('hidden');
				}
			}

			$('.pts-switcher').each( function(){
				var element = $(this),
					elementCheck = element.find(':checkbox'),
					elementParent = $(this).parents('.pricing-tenure-switcher'),
					elementPricing = $( elementParent.attr('data-container') );

				pricingSwitcher( elementCheck, elementParent, elementPricing );

				elementCheck.on( 'change', function(){
					pricingSwitcher( elementCheck, elementParent, elementPricing );
				});
			});
		});

	</script>
	<script type="text/javascript">
	// $(document).ready(function () {

	// 	$('#myModal').hide();

	// 	setTimeout(function() {
	// 		if ($('#myModal').length) {
	// 			$.magnificPopup.open({
	// 					items: {
	// 					    src: '#myModal' 
	// 					}
	// 			  });
	// 			}

	// 		$('#myModal').show();

	// 		}, 5000);

	// 	setTimeout(function() {

	// 		$('#myModal').css("display", "none");

	// 		}, 10000);


	// });
	</script>
	@yield('js')
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-133445039-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-133445039-1');
	</script>

</body>
</html>