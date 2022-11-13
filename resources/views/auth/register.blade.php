@extends('layouts.appfront')

@section('content')

<div class="main-content">
        <!-- Section: inner-header -->
        <section class="inner-header divider parallax layer-overlay overlay-white-8" data-bg-img="http://placehold.it/1920x743">
          <div class="container pt-60 pb-60">
            <!-- Section Content -->
            <div class="section-content">
              <div class="row">
                <div class="col-md-12 text-center">
                  <h3 class="font-28">My Account</h2>
                </div>
              </div>
            </div>
          </div>      
        </section>
    
        <section>
          <div class="container">
            <div class="row">
              <div class="col-md-6 col-md-push-3">
                <form name="reg-form" class="register-form" method="post" action="{{ route('register') }}">
                  <div class="icon-box mb-0 p-0">
                    <a href="#" class="icon icon-bordered icon-rounded icon-sm pull-left mb-0 mr-10">
                      <i class="pe-7s-users"></i>
                    </a>
                    <h4 class="text-gray pt-10 mt-0 mb-30">Dont have an Account? Register Now.</h4>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label>Name</label>
                      <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                      @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                      @endif
                    </div>
                    <div class="form-group col-md-6">
                      <label>Email Address</label>
                      <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                      @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                    </div>
                  </div>
                  <div class="row">
                      <div class="form-group col-md-12">
                        <label>No. Handphone</label>
                        <input name="no_hp" class="form-control" type="text">
                      </div>
                    </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="form_choose_password">Choose Password</label>
                      <input id="form_choose_password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Re-enter Password</label>
                      <input id="form_re_enter_password" type="password" class="form-control" name="password_confirmation" required>
                      @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                    </div>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-dark btn-lg btn-block mt-15" type="submit">Register Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </section>
      </div>

@endsection
