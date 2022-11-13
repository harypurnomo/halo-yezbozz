@extends('public.v1.layouts.template')

@section('title')
	@if (Request::segment(1) =="" || Request::segment(1) =="en")
	Contact Us
	@elseif (Request::segment(1) =="id")
	Kontak Kami
	@endif
@endsection

@section('content')
<!-- Content
============================================= -->
<section>

	<div class="content-wrap">

		<div class="container clearfix">
			<h1>
				@if (Request::segment(1) =="" || Request::segment(1) =="en")
				Ready to get started with KLAKKLIK ?
				@elseif (Request::segment(1) =="id")
				Siap memulainya dengan KLAKKLIK ?
				@endif
			</h1>

			<!-- Contact Form
			============================================= -->
			<div class="col_half">

				<div class="fancy-title title-dotted-border">
					<h3>
						@if (Request::segment(1) =="" || Request::segment(1) =="en")
						Send us an Email
						@elseif (Request::segment(1) =="id")
						Kirimkan Email kepada kami
						@endif
					</h3>
				</div>
				<p class="text-justify">
					@if (Request::segment(1) =="" || Request::segment(1) =="en")
					Our team is happy to answer any questions that you may have and help you get started on your journey asap. <b>Please fill in the details below.</b>
					@elseif (Request::segment(1) =="id")
					Tim kami dengan senang hati menjawab pertanyaan apa pun yang Anda miliki dan membantu Anda memulai perjalanan Anda secepatnya. <b>Silakan isi detail di bawah ini.</b>
					@endif
				</p>


				<div class="form-widget" >

					<div class="form-result"></div>

					<form class="nobottommargin" id="template-contactform" name="template-contactform" action="{{ url('contact-us') }}" method="post">

						{{ csrf_field() }}
						<input type="hidden" name="lang" value="{{ (Request::segment(1)=="")?'en':Request::segment(1) }}">
						<input type="hidden" name="ipaddress" value="{{ Request::ip() }}">

						<div class="form-process"></div>

						<div class="col_half">
							<label for="template-contactform-name">Fullname <small class="text-danger">*</small></label>
							<input type="text" id="template-contactform-name" name="name" value="{{ old('name') }}" class="sm-form-control required" minlength="3" maxlength="50" />
						</div>

						<div class="col_half col_last">
							<label for="template-contactform-phone">Phone Number <small class="text-danger">*</small></label>
							<input type="text" id="template-contactform-phone" name="phone_number" value="{{ old('phone_number') }}" class="sm-form-control required" minlength="8" maxlength="20"/>
						</div>


						<div class="col_full">
							<label for="template-contactform-email">Email <small class="text-danger">*</small></label>
							<input type="email" id="template-contactform-email" name="email" value="{{ old('email') }}" class="required email sm-form-control" />
						</div>

						
						<div class="col_full">
							<label for="template-contactform-subject">Subject <small class="text-danger">*</small></label>
							<input type="text" id="template-contactform-subject" name="subject" value="{{ old('subject') }}" class="required sm-form-control" minlength="3" maxlength="50"/>
						</div>

						<div class="clear"></div>

						<div class="col_full">
							<label for="template-contactform-message">Message <small class="text-danger">*</small></label>
							<textarea class="required sm-form-control" id="template-contactform-message" name="message" rows="6" cols="30" minlength="3" maxlength="240"></textarea>
						</div>

						@if(config('services.recaptcha.key'))
						<div class="col_full">
							<div class="g-recaptcha"
								data-sitekey="{{config('services.recaptcha.key')}}">
							</div>
						</div>
						@endif

						<div class="col_full hidden">
							
						</div>

						<div class="col_full">
							<button name="submit" type="submit" id="submit-button" tabindex="5" value="Submit" class="button button-3d nomargin g-recaptcha">
							@if (Request::segment(1) =="" || Request::segment(1) =="en")
							Send Message
							@elseif (Request::segment(1) =="id")
							Kirim Pesan
							@endif
							</button>
						</div>

						<input type="hidden" name="prefix" value="template-contactform-">

					</form>
				</div>

			</div><!-- Contact Form End -->

			<!-- Google Map
			============================================= -->
			<div class="col_half col_last">

				<img src="{{ asset('template/v1') }}/images/contact-us.png" class="img-responsive">

			</div><!-- Google Map End -->

			<div class="clear"></div>

			<!-- Contact Info
			============================================= -->
			<div class="row clear-bottommargin">

				<div class="col-lg-4 col-md-12 bottommargin clearfix">
					<div class="feature-box fbox-center fbox-bg fbox-plain">
						<div class="fbox-icon">
							<a href="https://goo.gl/maps/zWQMN2QJBWdicnmL9" target="_blank"><i class="icon-map-marker2"></i></a>
						</div>
						<a href="https://goo.gl/maps/zWQMN2QJBWdicnmL9" target="_blank">
							<h3>Our Headquarters<span class="subtitle">{{ Library::companyProfile()[0]->address }}</span></h3>
						</a>
					</div>
				</div>

				<div class="col-lg-4 col-md-12 bottommargin clearfix">
					<div class="feature-box fbox-center fbox-bg fbox-plain">
						<div class="fbox-icon">
							<a href="https://wa.me/{{ Library::companyProfile()[0]->whatsapp_number }}" target="_blank"><i class="icon-chat-3"></i></a>
						</div>
						<a href="https://wa.me/{{ Library::companyProfile()[0]->whatsapp_number }}" target="_blank">
							<h3>Chat to Us<span class="subtitle">{{ Library::companyProfile()[0]->phone_number }}</span>
							</h3>
						</a>
					</div>
				</div>

				<div class="col-lg-4 col-md-12 bottommargin clearfix">
					<div class="feature-box fbox-center fbox-bg fbox-plain">
						<div class="fbox-icon">
							<a href="{{ Library::companyProfile()[0]->instagram }}" target="_blank"><i class="icon-instagram2"></i></a>
						</div>
						<a href="{{ Library::companyProfile()[0]->instagram }}" target="_blank">
							<h3>Our Instagram<span class="subtitle">Follow Us</span></h3>
						</a>
					</div>
				</div>

			</div><!-- Contact Info End -->

		</div>

	</div>

</section><!-- #content end -->
@endsection