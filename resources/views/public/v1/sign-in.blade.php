@extends('public.v1.layouts.template-auth')

@section('title')
	@if (Request::segment(1) =="" || Request::segment(1) =="en")
	SIGN IN
	@elseif (Request::segment(1) =="id")
	MASUK
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
						<form class="nobottommargin" action="{{ route('post.signin',['lang'=>Request::segment(1)]) }}" method="post">
							{{ csrf_field() }}
							<center>
								<h3>
									@if (Request::segment(1) =="" || Request::segment(1) =="en")
									Login to your Account
									@elseif (Request::segment(1) =="id")
									Login menggunakan akun Anda
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

							<div class="col_full">
								<label for="login-form-username">Email:</label>
								<input type="email" name="email" class="form-control not-dark" id="login-form-username" placeholder=""  required=""  />
							</div>

							<div class="col_full">
								<label for="login-form-password">Password:</label>
								<div class="input-group" id="show_hide_password">
									<input type="password" name="password" class="form-control not-dark" id="login-form-password" placeholder="" required="">
									<div class="input-group-append hoverable">
										<span class="input-group-text">
											<i class="fa fa-eye-slash" aria-hidden="true"></i>
										</span>
									</div>
								</div>
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
								Sign In
								@elseif (Request::segment(1) =="id")
								Masuk
								@endif
								</button>
								<a href="{{ route('lang.forgotpassword',['lang'=>Request::segment(1)]) }}" class="fright t-blue p-10">
									@if (Request::segment(1) =="" || Request::segment(1) =="en")
									Forgot Password?
									@elseif (Request::segment(1) =="id")
									Lupa Password?
									@endif
								</a>
							</div>
						</form>

						{{-- <div class="line line-sm"></div>

						<div class="center">
							<h4 style="margin-bottom: 15px;">
								@if (Request::segment(1) =="" || Request::segment(1) =="en")
								Don't have an account?
								@elseif (Request::segment(1) =="id")
								Belum punya akun?
								@endif
							</h4>
							<a href="{{ route('lang.signup',['lang'=>Request::segment(1)]) }}" class="button button-3d button-rounded gradient-ocean">
								@if (Request::segment(1) =="" || Request::segment(1) =="en")
								Sign Up Now
								@elseif (Request::segment(1) =="id")
								Daftar Sekarang
								@endif
							</a>
							<span class="d-none d-md-block">
								@if (Request::segment(1) =="" || Request::segment(1) =="en")
								Or register with :
								@elseif (Request::segment(1) =="id")
								Atau mendaftar dengan :
								@endif
							</span>
							<a href="{{ route('lang.google.signup',['lang'=>Request::segment(1)]) }}" class="button button-3d button-rounded gradient-light button-light">
								@if (Request::segment(1) =="" || Request::segment(1) =="en")
								Google Account
								@elseif (Request::segment(1) =="id")
								Akun Google
								@endif
							</a>
						</div> --}}
					</div>
				</div>

				<div class="center dark"><small class="t-white">Copyrights &copy; {{ date('Y') }} {{ Library::companyProfile()[0]->company_name }}.</small></div>

			</div>
		</div>

	</div>

</section>
@endsection

@section('js')
<script>
	$(document).ready(function() {
		$("#show_hide_password span").on('click', function(event) {
			event.preventDefault();
			if($('#show_hide_password input').attr("type") == "text"){
				$('#show_hide_password input').attr('type', 'password');
				$('#show_hide_password i').addClass( "fa-eye-slash" );
				$('#show_hide_password i').removeClass( "fa-eye" );
			}else if($('#show_hide_password input').attr("type") == "password"){
				$('#show_hide_password input').attr('type', 'text');
				$('#show_hide_password i').removeClass( "fa-eye-slash" );
				$('#show_hide_password i').addClass( "fa-eye" );
			}
		});
	});
</script>
@endsection