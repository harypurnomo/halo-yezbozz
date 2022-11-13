@extends('public.v1.layouts.template-auth')

@section('title')
	@if (Request::segment(1) =="" || Request::segment(1) =="en")
	FORGOT PASSWORD
	@elseif (Request::segment(1) =="id")
	LUPA KATA SANDI
	@endif
@endsection

@section('content')
<section id="content" class="m-top-75">

	<div class="content-wrap nopadding">

		<div class="section nopadding nomargin" style="width: 100%; height: 100%; position: absolute; left: 0; top: 0; background: #444;"></div>

		<div class="section bg-light nopadding nomargin">
			<div class="container-fluid divcenter clearfix">

				<div class="center">
					<a href="{{ url('/') }}">
						<img src="{{ url('uploads/logo') }}/{{ Library::companyProfile()[0]->logo }}" alt="{{ Library::companyProfile()[0]->company_name }} Logo" width="100" class="img-responsive">
					</a>
				</div>
				<div class="card divcenter m-top-10 m-bottom-10" style="max-width: 400px;">
					<div class="card-body p-40 b-shadow-v1">
						<form class="nobottommargin" action="{{ route('post.forgot.password',['lang'=>Request::segment(1)]) }}" method="post">
							{{ csrf_field() }}
							<center>
								<h3>
									@if (Request::segment(1) =="" || Request::segment(1) =="en")
									Lost Password Reset
									@elseif (Request::segment(1) =="id")
									Ubah Kata Sandi
									@endif
								</h3>
							</center>
							@if ($errors->any())
	                        <div class="alert alert-danger">
	                            <ul>
	                                @foreach ($errors->all() as $error)
	                                    <li>{{ $error }}</li>
	                                @endforeach
	                            </ul>
	                        </div>
	                        @elseif(!empty($error))
	                        <div class="alert alert-danger">
	                            <ul>
	                            	<li>{{ $error }}</li>
	                            </ul>
	                        </div>
	                        @endif
	                        <p>
                        	@if (Request::segment(1) =="" || Request::segment(1) =="en")
							Forgotten your password ? Enter your email address below to begin the reset process.
							@elseif (Request::segment(1) =="id")
							Lupa kata sandi ? Masukan alamat email Anda dibawah ini untuk memulai proses reset
							@endif
	                        </p>
							<div class="col_full">
								<label for="login-form-username">Email:</label>
								<input type="email" id="login-form-username" placeholder="" type="email" name="email" required="" class="form-control not-dark" />
							</div>

							@if(config('services.recaptcha.key'))
							<div class="col_full">
								<div class="g-recaptcha"
									data-sitekey="{{config('services.recaptcha.key')}}">
								</div>
							</div>
							@endif

							<div class="col_full nobottommargin">
								<button class="button button-3d button-rounded gradient-blue-purple nomargin" id="login-form-submit" name="login-form-submit" value="login">
								@if (Request::segment(1) =="" || Request::segment(1) =="en")
								Submit
								@elseif (Request::segment(1) =="id")
								Kirim
								@endif
								</button>

								<a href="{{ route('lang.signin',['lang'=>Request::segment(1)]) }}" class="fright t-blue p-10">
									@if (Request::segment(1) =="" || Request::segment(1) =="en")
									Sign In
									@elseif (Request::segment(1) =="id")
									Masuk
									@endif
								</a>

							</div>
						</form>
					</div>
				</div>

				<div class="center dark"><small class="t-white">Copyrights &copy; {{ date('Y') }} {{ Library::companyProfile()[0]->company_name }}.</small></div>

			</div>
		</div>

	</div>

</section>
@endsection