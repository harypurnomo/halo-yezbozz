<!-- Copyrights
============================================= -->
<div id="copyrights" style="background: url('{{ asset('template/v1') }}/demos/seo/images/hero/footer.svg') no-repeat top center; background-size: cover; padding-top: 70px;">

	<div class="container clearfix">

		<div class="col_half">
			Copyrights &copy; 2016 - {{ date('Y') }} All Rights Reserved by klakklik.id<br>
			<div class="copyright-links"><a href="#">Terms of Use</a> / <a href="#">Privacy Policy</a></div>
		</div>

		<div class="col_half col_last tright">
			<div class="copyrights-menu copyright-links clearfix">
				<a href="#">
					@if (Request::segment(1) =="" || Request::segment(1) =="en")
					<a href="{{ url('/') }}/en/home">Home</a>
					@elseif (Request::segment(1) =="id")
					<a href="{{ url('/') }}/id/home">Beranda</a>
					@endif
				</a>/
				<a href="#">
					@if (Request::segment(1) =="" || Request::segment(1) =="en")
					<a href="#ourproduct">Our Products</a>
					@elseif (Request::segment(1) =="id")
					<a href="#ourproduct">Produk Kami</a>
					@endif
				</a>/
				<a href="#">
					@if (Request::segment(1) =="" || Request::segment(1) =="en")
					<a href="{{ url('/') }}/en/contact-us">Contact Us</a>
					@elseif (Request::segment(1) =="id")
					<a href="{{ url('/') }}/id/contact-us">Kontak Kami</a>
					@endif
				</a>
			</div>
		</div>

	</div>

</div><!-- #copyrights end -->