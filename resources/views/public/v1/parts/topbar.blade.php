<div id="top-bar" class="transparent-topbar">

	<div class="container clearfix">

		<div class="col_half nobottommargin clearfix">

			<!-- Top Links
			============================================= -->
			<div class="top-links">
				<ul>
					<li><a href="javascript:;"><img src="{{ asset('template/v1') }}/demos/seo/images/flags/icon-lang.png" alt="Language"></a>
						<ul>
							{{-- English --}}
							@if (Request::segment(1) == "")
							<li><a href="{{ route('lang.home',['lang'=>'en']) }}"><img src="{{ asset('template/v1') }}/demos/seo/images/flags/eng.png" alt="English">English</a></li>
							@else
							<li><a href="{{ url('/') }}/{{ str_replace("id","en",Request::path()) }}"><img src="{{ asset('template/v1') }}/demos/seo/images/flags/eng.png" alt="English">English</a></li>
							@endif

							{{-- Bahasa --}}
							@if (Request::segment(1) == "")
							<li><a href="{{ route('lang.home',['lang'=>'id']) }}"><img src="{{ asset('template/v1') }}/demos/seo/images/flags/ina.png" alt="Bahasa">Bahasa</a></li>
							@else
							<li><a href="{{ url('/') }}/{{ str_replace("en","id",Request::path()) }}"><img src="{{ asset('template/v1') }}/demos/seo/images/flags/ina.png" alt="Bahasa">Bahasa</a></li>
							@endif
						</ul>
					</li>
				</ul>
			</div><!-- .top-links end -->

		</div>

		<div class="col_half fright dark col_last clearfix nobottommargin">

			<!-- Top Social
			============================================= -->
			<div id="top-social">
				<ul>
					<li><a href="{{ Library::companyProfile()[0]->instagram }}" class="si-instagram" target="_blank"><span class="ts-icon"><i class="icon-instagram2"></i></span><span class="ts-text">Instagram</span></a></li>
					<li><a href="https://wa.me/{{ Library::companyProfile()[0]->whatsapp_number }}" class="si-call"><span class="ts-icon"><i class="icon-comment"></i></span><span class="ts-text">{{ Library::companyProfile()[0]->phone_number }}</span></a></li>
					{{-- <li><a onClick="javascript:window.open('mailto:{{ Library::companyProfile()[0]->email }}', 'mail');event.preventDefault()" href="mailto:{{ Library::companyProfile()[0]->email }}" class="si-email3"><span class="ts-icon"><i class="icon-envelope-alt"></i></span><span class="ts-text">{{ Library::companyProfile()[0]->email }}</span></a></li> --}}
				</ul>
			</div><!-- #top-social end -->

		</div>

	</div>

</div>