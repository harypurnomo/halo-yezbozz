@extends('public.v1.layouts.template')

@section('title')
	@if (Request::segment(1) =="" || Request::segment(1) =="en")
	HOME
	@elseif (Request::segment(1) =="id")
	BERANDA
	@endif
@endsection

@section('content')

<style type="text/css">
	.mfp-content{
		text-align: center !important;
	}
</style>

<section id="slider" class="slider-element slider-parallax full-screen clearfix" style="background: #FFF url('{{ asset('template/v1') }}/demos/seo/images/hero/hero-1.jpg') center center no-repeat; background-size: cover;">

	<div class="vertical-middle">
		<div class="container">
			<div class="row">
				<div class="col-lg-5 col-md-8">
					@if (Request::segment(1) =="" || Request::segment(1) =="en")
					<div class="slider-title">
						<h2>Drive More "Goverment" Through Digital</h2>
						<h3 class="text-rotater mb-2" data-separator="," data-rotate="fadeIn" data-speed="3500">- Boost your own <span class="t-rotate">Awesome,Beautiful,Great</span> Apps.</h3>
						<a href="#ourproduct" class="button button-rounded button-large nott ls0">Free Trial</a>
						<a href="#" class="button button-rounded button-large button-light text-dark bg-white border nott ls0">Contact Us</a>
					</div>
					@elseif (Request::segment(1) =="id")
					<div class="slider-title">
						<h2>Dorong Lebih Banyak "Pemerintah" Melalui Digital</h2>
						<h3 class="text-rotater mb-2" data-separator="," data-rotate="fadeIn" data-speed="3500">- Tingkatkan tata pemerintahan yang <span class="t-rotate">Luar biasa, Indah, Hebat</span> Melalui Aplikasi.</h3>
						<a href="#ourproduct" class="button button-rounded button-large nott ls0">Uji Coba Gratis</a>
						<a href="#" class="button button-rounded button-large button-light text-dark bg-white border nott ls0">Kontak Kami</a>
					</div>
					@endif
				</div>
			</div>
		</div>

	</div>

	<div class="video-wrap h-100 d-block d-lg-none">
		<div class="video-overlay" style="background: rgba(255,255,255,0.85);"></div>
	</div>


</section>

<section id="content">

	<div class="content-wrap pt-0">

		<!-- Client Carousel
		============================================= -->
		@if (!$recPatner->isEmpty())
		<div class="section nobg m-0 border-bottom py-5">
			<div class="container">
				<div class="heading-block nobottomborder center">
					@if (Request::segment(1) =="" || Request::segment(1) =="en")
					<div class="badge badge-pill badge-default">Our Clients</div>
					<h3 class="nott ls0">Trusted by Goverment, NGO and Private</h3>
					@elseif (Request::segment(1) =="id")
					<div class="badge badge-pill badge-default">Klien Kami</div>
					<h3 class="nott ls0">Dipercaya oleh Pemerintah, LSM dan Swasta.</h3>
					@endif
				</div>
				<div id="oc-clients" class="owl-carousel image-carousel carousel-widget" data-margin="100" data-loop="true" data-autoplay="5000" data-nav="false" data-pagi="false" data-items-xs="2" data-items-sm="3" data-items-md="4" data-items-lg="5" data-items-xl="6">
					@foreach ($recPatner as $element)
					<div class="">
						<a href="javascript:;">
							<img src="{{ url('/') }}/uploads/patner/{{ $element->picture }}" alt="{{ $element->title }}">
						</a>
					</div>
					@endforeach
				</div>
			</div>
		</div>
		@endif

		<!-- Features
		============================================= -->
		<div class="section nobg mt-4 mb-0 pb-0">
			<div class="container">
				<div class="heading-block nobottomborder center divcenter mb-0 clearfix" style="max-width: 550px">
					@if (Request::segment(1) =="" || Request::segment(1) =="en")
					<div class="badge badge-pill badge-default">Our Solutions</div>
					<h3 class="nott ls0 mb-3">Improving Your Governance</h3>
					<p>We are solution oriented</p>
					@elseif (Request::segment(1) =="id")
					<div class="badge badge-pill badge-default">Solusi Kami</div>
					<h3 class="nott ls0 mb-3">Meningkatkan Tata Kelola Anda</h3>
					<p>Kami berorientasi pada solusi</p>
					@endif
				</div>
				<div class="row justify-content-between align-items-center clearfix">

					<div class="col-lg-4 col-sm-6">

						<div class="feature-box fbox-right noborder">
							<div class="fbox-icon">
								<a href="#"><img src="{{ asset('template/v1') }}/demos/seo/images/icons/seo.svg" alt="Feature Icon" class="nobg noradius"></a>
							</div>
							<h3 class="nott ls0">Deploy With Docker</h3>
							<p>
								@if (Request::segment(1) =="" || Request::segment(1) =="en")
								Docker Containers are a streamlined way to build, test, and deploy applications on multiple environments. Greater Efficiency, Less Overhead, Increased Portability and More Consistent Operation.
								@elseif (Request::segment(1) =="id")
								Docker Containers adalah cara yang efisien untuk membangun, menguji, dan menerapkan aplikasi di berbagai lingkungan. Efisiensi Lebih Besar, Overhead Lebih Sedikit, Peningkatan Portabilitas, dan Operasi Lebih Konsisten.
								@endif
							</p>
						</div>

						<div class="feature-box fbox-right noborder mt-5">
							<div class="fbox-icon">
								<a href="#"><img src="{{ asset('template/v1') }}/demos/seo/images/icons/adword.svg" alt="Feature Icon" class="nobg noradius"></a>
							</div>
							<h3 class="nott ls0">DevSecOps Concepts</h3>
							<p>
								@if (Request::segment(1) =="" || Request::segment(1) =="en")
								Plan, Code, Build, Test, Release, Deploy, and Operate. DevSecOps automates security within the DevOps Workflow.
								@elseif (Request::segment(1) =="id")
								Plan, Code, Build, Test, Release, Deploy, dan Operate. DevSecOps mengotomatiskan keamanan dalam Alur Kerja DevOps.
								@endif
							</p>
						</div>

						<div class="feature-box fbox-right noborder mt-5">
							<div class="fbox-icon">
								<a href="#"><img src="{{ asset('template/v1') }}/demos/seo/images/icons/analysis.svg" alt="Feature Icon" class="nobg noradius"></a>
							</div>
							<h3 class="nott ls0">Great Documentations</h3>
							<p>
								@if (Request::segment(1) =="" || Request::segment(1) =="en")
								Documentation is important because it's one of the first connections between the human and the machine. It helps us effectively translate our concepts and ideas into the languages that we use to control machines.
								@elseif (Request::segment(1) =="id")
								Dokumentasi penting karena merupakan salah satu koneksi pertama antara manusia dan mesin. Ini membantu kami menerjemahkan konsep dan ide kami secara efektif ke dalam bahasa yang kami gunakan untuk mengontrol mesin.
								@endif
							</p>
						</div>

					</div>

					<div class="col-lg-3 col-7 offset-3 offset-sm-0 d-sm-none d-lg-block center my-5">
						<img src="{{ asset('template/v1') }}/demos/seo/images/sections/2.png" alt="iphone" class="rounded  parallax" data-bottom-top="transform: translateY(-30px)" data-top-bottom="transform: translateY(30px)">
					</div>

					<div class="col-lg-4 col-sm-6">

						<div class="feature-box noborder">
							<div class="fbox-icon">
								<a href="#"><img src="{{ asset('template/v1') }}/demos/seo/images/icons/social.svg" alt="Feature Icon" class="nobg noradius"></a>
							</div>
							<h3 class="nott ls0">User Friendly</h3>
							<p>
								@if (Request::segment(1) =="" || Request::segment(1) =="en")
								Easy to learn, use, understand, or deal with user-friendly software also agreeable, appealing a user-friendly atmosphere.
								@elseif (Request::segment(1) =="id")
								Mudah dipelajari, digunakan, dipahami, atau ditangani dengan perangkat lunak yang ramah pengguna juga menyenangkan, menarik suasana yang ramah pengguna.
								@endif
							</p>
						</div>

						<div class="feature-box noborder mt-5">
							<div class="fbox-icon">
								<a href="#"><img src="{{ asset('template/v1') }}/demos/seo/images/icons/experience.svg" alt="Feature Icon" class="nobg noradius"></a>
							</div>
							<h3 class="nott ls0">Open Platform</h3>
							<p>
								@if (Request::segment(1) =="" || Request::segment(1) =="en")
								Is a way to describe a software system that has published external programming interfaces. External programming interfaces are often called Application Programming Interfaces, or APIs. The published APIs enable a third-party to integrate with the software system.
								@elseif (Request::segment(1) =="id")
								Adalah cara untuk menggambarkan sistem perangkat lunak yang telah menerbitkan antarmuka pemrograman eksternal. Antarmuka pemrograman eksternal sering disebut Antarmuka Pemrograman Aplikasi, atau API. API yang diterbitkan memungkinkan pihak ketiga untuk berintegrasi dengan sistem perangkat lunak.
								@endif
							</p>
						</div>

						<div class="feature-box noborder mt-5">
							<div class="fbox-icon">
								<a href="#"><img src="{{ asset('template/v1') }}/demos/seo/images/icons/content_marketing.svg" alt="Feature Icon" class="nobg noradius"></a>
							</div>
							<h3 class="nott ls0">Fully Support</h3>
							<p>
								@if (Request::segment(1) =="" || Request::segment(1) =="en")
								See how well your website is doing. Track your site’s performance and stats.
								@elseif (Request::segment(1) =="id")
								Lihat seberapa baik kinerja situs web Anda. Lacak kinerja dan statistik situs Anda.
								@endif
							</p>
						</div>

					</div>

				</div>
			</div>
		</div>

		<!-- Works/Projects
		============================================= -->
		@if (!$recProducts->isEmpty())
		<div id="ourproduct" class="section m-0" style="background: url('{{ asset('template/v1') }}/demos/seo/images/sections/5.jpg') no-repeat center center; background-size: cover;padding: 80px 0;">
			<div class="container">
				<div class="heading-block border-bottom-0 center">
					<div class="badge badge-pill badge-default">
					@if (Request::segment(1) =="" || Request::segment(1) =="en")
					Our Products
					@elseif (Request::segment(1) =="id")
					Produk Kami
					@endif
					</div>
					<h3 class="nott ls0">
					@if (Request::segment(1) =="" || Request::segment(1) =="en")
					Our Showcases
					@elseif (Request::segment(1) =="id")
					Etalase Kami
					@endif
					</h3>
				</div>

				<div id="portfolio" class="portfolio row grid-container gutter-20">

					@foreach ($recProducts as $element)
					<article class="portfolio-item col-12 col-sm-6 col-md-4 pf-media pf-icons">
						<div class="grid-inner">
							<div class="portfolio-image">
								<img src="{{ url('/') }}/uploads/product/thumb/{{ $element->thumb }}" alt="{{ $element->product_title_en }}">
							</div>
							<div class="portfolio-desc">
								<h3>
								<a href="{{ $element->external_link }}" target="_blank">
								@if (Request::segment(1) =="" || Request::segment(1) =="en")
								{{ $element->product_title_en }}
								@elseif (Request::segment(1) =="id")
								{{ $element->product_title_id }}
								@endif
								</a>
								</h3>
								<span>{{ $element->category_name }}</span>
							</div>
						</div>
					</article>
					@endforeach

				</div>

			</div>
		</div>
		@endif

		<!-- Form Section
		============================================= -->
		{{-- <div class="section m-0" style="background: url('{{ asset('template/v1') }}/demos/seo/images/sections/1.jpg') no-repeat center center; background-size: cover; padding: 100px 0;">
			<div class="container">
				<div class="row justify-content-between align-items-center">

					<div class="col-md-4">
						<div class="heading-block nobottomborder bottommargin-sm">
							<div class="badge badge-pill badge-default">Our Features</div>
							<h3 class="nott ls0">
								@if (Request::segment(1) =="" || Request::segment(1) =="en")
								Klakklik Features
								@elseif (Request::segment(1) =="id")
								Fitur Klakklik
								@endif
							</h3>
						</div>
						<p>
							@if (Request::segment(1) =="" || Request::segment(1) =="en")
							Discover all the features you can use to design and manage your website online.
							@elseif (Request::segment(1) =="id")
							Temukan semua fitur yang dapat Anda gunakan untuk merancang dan mengelola situs web Anda secara online.
							@endif
						</p>
					</div>

					<div class="col-md-4 mt-5 mt-md-0 center">
						<a href="https://www.youtube.com/watch?v=P3Huse9K6Xs" data-lightbox="iframe" class="play-icon shadow"><i class="icon-play"></i></a>
					</div>

				</div>

			</div>
		</div> --}}

		<!-- Works/Projects
		============================================= -->
		{{-- <div class="section m-0" style="background: url('demos/seo/images/sections/5.jpg') no-repeat center center; background-size: cover;padding: 80px 0;">
			<div class="container">
				<div class="heading-block nobottomborder center">
					<div class="badge badge-pill badge-default">Stunning Templates</div>
					<h3 class="nott ls0">Start with free HTML website templates and bring your vision to life.</h3>
				</div>

				<div id="portfolio" class="portfolio portfolio-3 grid-container clearfix">

					<article class="portfolio-item pf-media pf-icons">
						<div class="portfolio-image">
							<img src="{{ asset('template/v1') }}/demos/seo/images/works/1.jpg" alt="The Atmosphere">
							<div class="portfolio-overlay">
								<a href="#" class="center-icon"><i class="icon-line-ellipsis"></i></a>
							</div>
						</div>
						<div class="portfolio-desc">
							<h3><a href="#">The Atmosphere</a></h3>
							<span>Digital Marketing</span>
						</div>
					</article>

					<article class="portfolio-item pf-illustrations">
						<div class="portfolio-image">
							<img src="{{ asset('template/v1') }}/demos/seo/images/works/2.jpg" alt="Wavelength Structure">
							<div class="portfolio-overlay">
								<a href="#" class="center-icon"><i class="icon-line-ellipsis"></i></a>
							</div>
						</div>
						<div class="portfolio-desc">
							<h3>Wavelength Structure</h3>
							<span>SEO</span>
						</div>
					</article>

					<article class="portfolio-item pf-graphics pf-uielements">
						<div class="portfolio-image">
							<img src="{{ asset('template/v1') }}/demos/seo/images/works/3.jpg" alt="Greenhouse Garden">
							<div class="portfolio-overlay">
								<a href="#" class="center-icon"><i class="icon-line-ellipsis"></i></a>
							</div>
						</div>
						<div class="portfolio-desc">
							<h3>Simplicity Pages</h3>
							<span>Analytics</span>
						</div>
					</article>

					<article class="portfolio-item pf-icons pf-illustrations">
						<div class="portfolio-image">
							<img src="{{ asset('template/v1') }}/demos/seo/images/works/4.jpg" alt="Industrial Hub">
							<div class="portfolio-overlay">
								<a href="#" class="center-icon"><i class="icon-line-ellipsis"></i></a>
							</div>
						</div>
						<div class="portfolio-desc">
							<h3>SEO Analysis</h3>
							<span>SEO</span>
						</div>
					</article>

					<article class="portfolio-item pf-uielements pf-media">
						<div class="portfolio-image">
							<img src="{{ asset('template/v1') }}/demos/seo/images/works/5.jpg" alt="Corporate Headquarters">
							<div class="portfolio-overlay">
								<a href="#" class="center-icon"><i class="icon-line-ellipsis"></i></a>
							</div>
						</div>
						<div class="portfolio-desc">
							<h3>Marketing Strategy</h3>
							<span>Digital Marketing</span>
						</div>
					</article>

					<article class="portfolio-item pf-graphics pf-illustrations">
						<div class="portfolio-image">
							<img src="{{ asset('template/v1') }}/demos/seo/images/works/6.jpg" alt="Space Station">
							<div class="portfolio-overlay" data-lightbox="gallery">
								<a href="#" class="center-icon"><i class="icon-line-ellipsis"></i></a>
							</div>
						</div>
						<div class="portfolio-desc">
							<h3>Space Station</h3>
							<span>Social Media</span>
						</div>
					</article>

				</div>

				<div class="center">
					<a href="#" class="button button-large button-rounded capitalize ml-0 mt-5 ls0">View All Templates</a>
				</div>

			</div>
		</div> --}}
		
		<!-- Testimonials
		============================================= -->
		@if (!$recTestimonial->isEmpty())
		<div class="section mt-0" style="background: url('demos/seo/images/sections/3.jpg') no-repeat top center; background-size: cover; padding: 80px 0 70px;">
			<div class="container">
				<div class="heading-block nobottomborder center">
					<div class="badge badge-pill badge-default">Testimonials</div>
					<h3 class="nott ls0">What Clients Says</h3>
				</div>

				<div id="oc-testi" class="owl-carousel testimonials-carousel carousel-widget clearfix" data-margin="0" data-pagi="true" data-loop="true" data-center="true" data-autoplay="5000" data-items-sm="1" data-items-md="2" data-items-xl="3">

					<div class="oc-item">
						<div class="testimonial">
							<div class="testi-image">
								<a href="#"><img src="{{ asset('template/v1') }}/demos/pet/images/testimonials/1.jpg" alt="Customer Testimonails"></a>
							</div>
							<div class="testi-content">
								<p>Incidunt deleniti blanditiis quas aperiam recusandae consequatur ullam quibusdam cum libero illo rerum repellendus!</p>
								<div class="testi-meta">
									John Doe
									<span>XYZ Inc.</span>
								</div>
							</div>
						</div>
					</div>

					<div class="oc-item">
						<div class="testimonial">
							<div class="testi-image">
								<a href="#"><img src="{{ asset('template/v1') }}/demos/pet/images/testimonials/2.jpg" alt="Customer Testimonails"></a>
							</div>
							<div class="testi-content">
								<p>Natus voluptatum enim quod necessitatibus quis expedita harum provident eos obcaecati id culpa corporis molestias.</p>
								<div class="testi-meta">
									Collis Ta'eed
									<span>Envato Inc.</span>
								</div>
							</div>
						</div>
					</div>
					<div class="oc-item">
						<div class="testimonial">
							<div class="testi-image">
								<a href="#"><img src="{{ asset('template/v1') }}/demos/pet/images/testimonials/3.jpg" alt="Customer Testimonails"></a>
							</div>
							<div class="testi-content">
								<p>Natus voluptatum enim quod necessitatibus quis expedita harum provident eos obcaecati id culpa corporis molestias.</p>
								<div class="testi-meta">
									Collis Ta'eed
									<span>Envato Inc.</span>
								</div>
							</div>
						</div>
					</div>
					<div class="oc-item">
						<div class="testimonial">
							<div class="testi-image">
								<a href="#"><img src="{{ asset('template/v1') }}/demos/pet/images/testimonials/4.jpg" alt="Customer Testimonails"></a>
							</div>
							<div class="testi-content">
								<p>Natus voluptatum enim quod necessitatibus quis expedita harum provident eos obcaecati id culpa corporis molestias.</p>
								<div class="testi-meta">
									Mary Jane
									<span>Google Inc.</span>
								</div>
							</div>
						</div>
					</div>
					<div class="oc-item">
						<div class="testimonial">
							<div class="testi-image">
								<a href="#"><img src="{{ asset('template/v1') }}/images/testimonials/5.jpg" alt="Customer Testimonails"></a>
							</div>
							<div class="testi-content">
								<p>Natus voluptatum enim quod necessitatibus quis expedita harum provident eos obcaecati id culpa corporis molestias.</p>
								<div class="testi-meta">
									Steve Jobs
								<span>Apple Inc.</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif
		

		<!-- Promo/Contact
		============================================= -->
		<div class="section mt-5 footer-stick promo-section nobg" style="padding: 100px 0; overflow: visible">
			<div class="container">
				<div class="heading-block nobottomborder center">
					<h4 class="uppercase ls1 mb-1">
						@if (Request::segment(1) =="" || Request::segment(1) =="en")
						Manage and Grow Your Business Online
						@elseif (Request::segment(1) =="id")
						Kelola dan Kembangkan Bisnis Anda Secara Online
						@endif
					</h4>
					<h2 class="nott ls0">
						@if (Request::segment(1) =="" || Request::segment(1) =="en")
						The Klakklik website builder makes it possible for anyone to create a apps and manage their business—all in one place.
						@elseif (Request::segment(1) =="id")
						Pembuat situs web Klakklik memungkinkan siapa saja untuk membuat aplikasi dan mengelola bisnis mereka—semuanya di satu tempat.
						@endif
					</h2>
					<a href="https://wa.me/{{ Library::companyProfile()[0]->whatsapp_number }}" class="button button-large button-rounded nott ml-0 ls0 mt-4" target="blank">
						@if (Request::segment(1) =="" || Request::segment(1) =="en")
						Contact Us Now
						@elseif (Request::segment(1) =="id")
						Hubungi Kami Sekarang
						@endif
					</a>

					<div class="widget subscribe-widget clearfix">
						@if (Request::segment(1) =="" || Request::segment(1) =="en")
						<h4><strong>Subscribe</strong> to Our Newsletter to get Important News, Amazing Offers &amp; Inside Scoops:</h4>
						@elseif (Request::segment(1) =="id")
						<h4> <strong> Berlangganan </strong> ke Newsletter Kami untuk mendapatkan Berita Penting, Penawaran Luar Biasa &amp; Di dalam Scoops: </h4>
						@endif
						
						<div class="widget-subscribe-form-result"></div>
						<center>
							<form style="width: 500px;" id="widget-subscribe-form" method="post" action="{{ url('subscribe') }}" class="nobottommargin">
								{{ csrf_field() }}
								<input type="hidden" name="lang" value="{{ (Request::segment(1)=="")?'en':Request::segment(1) }}">
								<input type="hidden" name="ipaddress" value="{{ Request::ip() }}">
								<div class="input-group divcenter">
									<div class="input-group-prepend">
										<div class="input-group-text nobg"><i class="icon-email2"></i></div>
									</div>
									<input type="email" id="widget-subscribe-form-email" name="email" class="form-control required email" placeholder="Enter your Email">
									<div class="input-group-append">
										<button class="btn btn-success button button-color nott ls0 m-0" type="submit">Subscribe</button>
									</div>
								</div>
								@if(config('services.recaptcha.key'))
								<div class="col_full" style="padding-top: 20px;">
									<div class="g-recaptcha"
										data-sitekey="{{config('services.recaptcha.key')}}">
									</div>
								</div>
								@endif
							</form>
						</center>
					</div>
				</div>
			</div>
		</div>

	</div>

</section>

<div id="popup-content" style="display: none;">
	@if($recPopup)
		@if($recPopup->show_title=="1")
		<div class="white-popup"><div class="text-center"><h5>{{ $recPopup->title }}</h5></div> <div class="popup-content">{!! $recPopup->text_content !!}</div></div>
		@else
		<div class="white-popup">{!! $recPopup->text_content !!}</div> </div>
		@endif
	@endif
</div>

<!-- Large modal -->
{{-- <a id="myModal" href="https://amp.klakklik.id/" target="_blank">
	<img src="{{ asset('example-amp.jpg') }}" width="75%">
</a> --}}
@endsection

@if($recPopup)
@section('js')
<script>
	$(function(){ 
		var popupContent = $('#popup-content').html();
		$.magnificPopup.open({
			items: {
				src: popupContent,
				type: 'inline'
			}
		});
		$(document).on('click','.mfp-content', function () {
			// $('#popup-content').css('display','none')
		})
		$(document).on('click','.mfp-close', function () {
			// $('#popup-content').css('display','none')
		});
	})
	setTimeout(function(){
		$.magnificPopup.close()
    },{{ $recPopup->close_time*1000 }});
</script>	
@endsection

@if($recPopup->show_title!="1")
<style>
.mfp-close-btn-in .mfp-close {
	color: #fff !important;
	font-weight: bolder !important;
	background-color: red !important;
}
</style>
@endif

@endif