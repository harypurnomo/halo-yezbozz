@extends('public.v1.layouts.template-auth')

@section('title')
	@if (Request::segment(1) =="" || Request::segment(1) =="en")
	SUCCESS MESSAGE
	@elseif (Request::segment(1) =="id")
	PESAN SUKSES 
	@endif
@endsection

@section('content')
<section id="content">

	<div class="content-wrap nopadding">

		<div class="section nopadding nomargin" style="width: 100%; height: 100%; position: absolute; left: 0; top: 0; background: #444;"></div>

		<div class="section bg-img full-screen nopadding nomargin">
			<div class="container-fluid vertical-middle divcenter clearfix">

				<div class="center">
					<a href="{{ url('/') }}">
						<img src="{{ url('uploads/logo') }}/{{ Library::companyProfile()[0]->logo }}" alt="{{ Library::companyProfile()[0]->company_name }} Logo" width="100" class="img-responsive">
					</a>
				</div>
				<div class="card divcenter m-top-10 m-bottom-10" style="max-width: 400px;">
					<div class="card-body p-40 b-shadow-v1">
						<h4>
                        	@if (Request::segment(1) =="" || Request::segment(1) =="en")
							Thank You ! <br>
							Your submission has been sent.
							<br><br>
							We sent an email, to make sure you own it. Please check your email inbox.
							@elseif (Request::segment(1) =="id")
							Terima Kasih  ! <br>
							Kiriman Anda telah dikirim.
							<br><br>
							Kami mengirim email, untuk memastikan Anda memilikinya. Silakan periksa kotak masuk email Anda.
							@endif
	                    </h4>
	                    <center>
		                    <a href="{{ route('lang.home',['lang'=>Request::segment(1)]) }}" class="button button-3d button-rounded gradient-light button-light">
								@if (Request::segment(1) =="" || Request::segment(1) =="en")
								Back to Home
								@elseif (Request::segment(1) =="id")
								Kembali ke Beranda
								@endif
							</a>
						</center>
					</div>
				</div>

				<div class="center dark"><small class="t-white">Copyrights &copy; {{ date('Y') }} {{ Library::companyProfile()[0]->company_name }}.</small></div>

			</div>
		</div>

	</div>

</section>
@endsection