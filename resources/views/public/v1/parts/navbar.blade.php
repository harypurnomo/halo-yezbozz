<nav id="primary-menu" class="with-arrows">

	<ul>
		<li class="{{ (Request::path()=='en/home' || Request::path()=='id/home')?'active':'' }}">
			@if (Request::segment(1) =="" || Request::segment(1) =="en")
			<a href="{{ url('/') }}/en/home">Home</a>
			@elseif (Request::segment(1) =="id")
			<a href="{{ url('/') }}/id/home">Beranda</a>
			@endif
		</li>
		<li class="{{ (Request::path()=='en/home' || Request::path()=='id/home')?'active':'' }}">
			@if (Request::segment(1) =="" || Request::segment(1) =="en")
			<a href="#ourproduct">Our Products</a>
			@elseif (Request::segment(1) =="id")
			<a href="#ourproduct">Produk Kami</a>
			@endif
		</li>
		<li class="{{ (Request::path()=='en/contact-us' || Request::path()=='id/contact-us')?'active':'' }}">
			@if (Request::segment(1) =="" || Request::segment(1) =="en")
			<a href="{{ url('/') }}/en/contact-us">Contact Us</a>
			@elseif (Request::segment(1) =="id")
			<a href="{{ url('/') }}/id/contact-us">Kontak Kami</a>
			@endif
		</li>
	</ul>

	<!-- Menu Buttons
	============================================= -->
	@if(Auth::check())
        <a href="{{ route('dashboard') }}" class="button button-rounded fright leftmargin-sm">Dashboard</a>
    @else
    	@if (Request::segment(1) =="" || Request::segment(1) =="en")
		<a href="{{ url('/') }}/en/sign-in" class="button button-rounded fright leftmargin-sm">Sign Up Free</a>
		@elseif (Request::segment(1) =="id")
		<a href="{{ url('/') }}/id/sign-in" class="button button-rounded fright leftmargin-sm">Daftar Sekarang</a>
		@endif
    @endif

</nav>