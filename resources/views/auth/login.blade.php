@extends('layouts.appfront')

@section('content')

<!-- Start main-content -->
  <div class="main-content">
    <!-- Section: inner-header -->
    <section class="inner-header divider parallax" data-bg-img="{{ asset('assets/bg.jpg') }}">
      <div class="container pt-60 pb-60">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12 text-left">
              <h3 class="font-28 text-white">Login/Register</h2>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-4 mb-40">
            <h4 class="text-gray mt-0 pt-5"> Login Member</h4>
            <hr>
            <form name="login-form" class="clearfix" method="post" action="{{ route('login') }}">
                @csrf
              <div class="row">
                <div class="form-group col-md-12">
                  <label for="form_username_email">Email</label>
                  <input id="form_username_email" name="email" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" type="email" required>
                  @if ($errors->has('email'))
                    <span class="invalid-feedback" style="color:red">
                        {{ $errors->first('email') }}
                    </span>
                @endif
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-12">
                  <label for="form_password">Password</label>
                  <input id="form_password" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" required>
                  @if ($errors->has('password'))
                    <span class="invalid-feedback" style="color:red">
                        {{ $errors->first('password') }}
                    </span>
                  @endif
                </div>
              </div>
              <div class="checkbox pull-left mt-15">
                <label for="form_checkbox">
                  <input id="form_checkbox" name="form_checkbox" type="checkbox"  {{ old('remember') ? 'checked' : '' }}>
                  Remember me </label>
              </div>
              <div class="form-group pull-right mt-10">
                <button type="submit" class="btn btn-dark btn-sm">Login</button>
              </div>
              <div class="clear text-center pt-10">
                <a class="text-theme-colored font-weight-600 font-12" href="{{ route('password.request') }}">Forgot Your Password?</a>
              </div>
            </form>
          </div>


          <div class="col-md-7 col-md-offset-1">
            <form name="reg-form" class="register-form" method="post" action="{{ route('register') }}">
                @csrf
              <div class="icon-box mb-0 p-0">
                <a href="#" class="icon icon-bordered icon-rounded icon-sm pull-left mb-0 mr-10">
                  <i class="pe-7s-users"></i>
                </a>
                <h4 class="text-gray pt-10 mt-0 mb-30">Do not have an Member Account yet? Sign up to become a Member now.</h4>
              </div>
              <hr>

              <div class="row">
                <div class="form-group col-md-6">
                  <label>Name</label>
                  <input name="name" class="form-control" type="text" value="{{ old('name') }}">
                  @if ($errors->has('name'))
                        <span class="invalid-feedback" style="color: red">
                            {{ $errors->first('name') }}
                        </span>
                      @endif
                </div>
                <div class="form-group col-md-6">
                  <label>Email</label>
                  <input name="email" class="form-control" type="email" value="{{ old('email') }}">
                  @if ($errors->has('email'))
                        <span class="invalid-feedback" style="color: red">
                            {{ $errors->first('email') }}
                        </span>
                    @endif
                </div>
              </div>
              <div class="row">
                  <div class="form-group col-md-12">
                    <label>No. Handphone</label>
                    <input name="no_hp" class="form-control" type="text" value="{{ old('no_hp') }}">
                    @if ($errors->has('no_hp'))
                        <span class="invalid-feedback" style="color: red">
                            {{ $errors->first('no_hp') }}
                        </span>
                    @endif
                  </div>
                </div>
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="form_choose_password">Choose Password</label>
                  <input id="form_choose_password" name="password" class="form-control" type="password">
                </div>
                <div class="form-group col-md-6">
                  <label>Re-enter Password</label>
                  <input id="form_re_enter_password" name="password_confirmation"  class="form-control" type="password">
                  @if ($errors->has('password'))
                      <span class="invalid-feedback" style="color: red">
                          {{ $errors->first('password') }}
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
  <!-- end main-content -->

  @endsection
