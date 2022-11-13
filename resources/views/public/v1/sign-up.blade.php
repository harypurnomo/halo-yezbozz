@extends('public.v1.layouts.template-auth')

@section('title')
	@if (Request::segment(1) =="" || Request::segment(1) =="en")
	SIGN UP
	@elseif (Request::segment(1) =="id")
	DAFTAR
	@endif
@endsection

@section('content')
<section id="content">

	<div class="content-wrap nopadding">

		<div class="section nopadding nomargin" style="width: 100%; height: 100%; position: absolute; left: 0; top: 0; background: #444;"></div>

		<div class="section bg-img nopadding nomargin">
			<div class="container-fluid divcenter clearfix">

				<div class="center">
					<a href="{{ url('/') }}">
						<img src="{{ url('uploads/logo') }}/{{ Library::companyProfile()[0]->logo }}" alt="{{ Library::companyProfile()[0]->company_name }} Logo" width="100" class="img-responsive">
					</a>
				</div>
				<div class="card divcenter m-top-10 m-bottom-10" style="max-width: 400px;">
					<div class="card-body p-40 b-shadow-v1">
						<form class="nobottommargin" action="{{ route('post.signup',['lang'=>Request::segment(1)]) }}" method="post">
							<input type="hidden" name="lang" value="{{ Request::segment(1) }}">
							{{ csrf_field() }}
							<center>
								<h3>
									@if (Request::segment(1) =="" || Request::segment(1) =="en")
									Registration Form
									@elseif (Request::segment(1) =="id")
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
								<input type="text" name="name" value="{{old('name')}}" class="form-control not-dark" id="login-form-name" placeholder="" required="" />
							</div>

							<div class="col_full">
								<label for="login-form-username">Email:</label>
								<input type="email" name="email" value="{{old('email')}}" class="form-control not-dark" id="login-form-email" placeholder="" required=""/>
							</div>

							<div class="col_full">
								<label for="login-form-username">Phone Number:</label>
								<input type="number" name="no_hp" value="{{old('no_hp')}}" class="form-control not-dark" id="login-form-no_hp" placeholder="" required="" />
							</div>

							<div class="col_full">
								<label for="login-form-username">User Type:</label>
								<select name="user_type" class="form-control not-dark" required="">
									<option value="">-- Select User Type --</option>
									@foreach ($recUserType as $item)
									<option value="{{$item->type_id}}" {{ ($item->type_id==old('user_type'))?'selected':'' }}>{{$item->type_name}}</option>	
									@endforeach
								</select>
							</div>

							<div class="col_full">
								<label for="login-form-username">Password:</label>
								<div class="input-group" id="show_hide_password">
									<input type="password" name="password" class="form-control not-dark" id="login-form-password" placeholder="" required="">
									<div class="input-group-append hoverable">
										<span class="input-group-text">
											<i class="fa fa-eye-slash" aria-hidden="true"></i>
										</span>
									</div>
								</div>
							</div>

							<div class="col_full form-check">
								<input type="checkbox" name="agree" class="form-check-input" id="exampleCheck1" required="">
								<label class="form-check-label" for="exampleCheck1">
									@if (Request::segment(1) =="" || Request::segment(1) =="en")
									I have read and agree to the Terms of Service 
									@elseif (Request::segment(1) =="id")
									Saya telah membaca dan menyetujui ketentuan layanan
									@endif
								</label>
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
								Sign Up
								@elseif (Request::segment(1) =="id")
								Daftar
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