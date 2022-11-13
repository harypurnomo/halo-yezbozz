@extends('public.v1.layouts.template-auth')

@section('title')
	@if ($lang =="" || $lang =="en")
	SIGN UP
	@elseif ($lang =="id")
	DAFTAR
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
						<form class="nobottommargin" action="{{ route('lang.google.signup.action',['lang'=>$lang]) }}" method="post">
							<input type="hidden" name="lang" value="{{ $lang }}">
							{{ csrf_field() }}
							<center>
								<h3>
									@if ($lang =="" || $lang =="en")
									Registration Form
									@elseif ($lang =="id")
									Formulir Registrasi
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
								<label for="login-form-username">Name:</label>
								<input type="text" name="name" value="{{$name}}" class="form-control not-dark" id="login-form-name" placeholder="" required="" readonly="" />
							</div>

							<div class="col_full">
								<label for="login-form-username">Email:</label>
								<input type="email" name="email" value="{{$email}}" class="form-control not-dark" id="login-form-email" placeholder="" readonly="" required=""/>
							</div>

							<div class="col_full">
								<label for="login-form-username">Password:</label>
								<input type="password" name="password" class="form-control not-dark" id="login-form-password" placeholder="" required="" minlength="8" />
							</div>

							<div class="col_full form-check">
								<input type="checkbox" name="agree" class="form-check-input" id="exampleCheck1" required="">
								<label class="form-check-label" for="exampleCheck1">
									@if ($lang =="" || $lang =="en")
									I have read and agree to the Terms of Service 
									@elseif ($lang =="id")
									Saya telah membaca dan menyetujui ketentuan layanan
									@endif
								</label>
							</div>

							<div class="col_full nobottommargin">
								<button class="button button-3d button-rounded gradient-blue-purple nomargin" id="login-form-submit" name="login-form-submit" value="login">
								@if ($lang =="" || $lang =="en")
								Sign Up
								@elseif ($lang =="id")
								Daftar
								@endif
								</button>
								<a href="{{ route('lang.signin',['lang'=>$lang]) }}" class="fright t-blue p-10">
									@if ($lang =="" || $lang =="en")
									Sign In
									@elseif ($lang =="id")
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