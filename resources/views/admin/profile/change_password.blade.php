@extends('admin.layouts.template')

@section('content')

<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                <button class="kt-subheader__mobile-toggle kt-subheader__mobile-toggle--left" id="kt_subheader_mobile_toggle"><span></span></button>
                My Profile
            </h3>
        </div>
    </div>
</div>
<!-- end:: Subheader -->

<!--Begin:: App Content-->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon-more"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">Form Update</h3>
                </div>
            </div>
            
            <div class="kt-portlet__body">

                <div class="alert alert-light alert-elevate fade show" role="alert">
                    <div class="alert-icon"><i class="flaticon-information kt-font-brand"></i></div>
                    <div class="alert-text">
                        <b>How can I see my current password ?</b> Please, use the <b><a href="{{ route('lang.forgotpassword',['lang'=>'en']) }}" target="_blank">forgot password</a></b> feature
                    </div>
                </div>

                <!--begin::Form-->
                <form class="kt-form kt-form--label-right" method="POST" action="{{ route('change.password.action') }}">
                    {{ csrf_field() }}
                    <div class="kt-portlet__body">
                        <div class="kt-section kt-section--first">
                            <div class="kt-section__body">
                                @if(Session::has('errors'))
                                <div class="alert alert-solid-danger alert-bold fade show kt-margin-t-20 kt-margin-b-40" role="alert">
                                    <div class="alert-icon"><i class="fa fa-exclamation-triangle"></i></div>
                                    <div class="alert-text">{!! Session::get('errors') !!}</div>
                                    <div class="alert-close">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="la la-close"></i></span>
                                        </button>
                                    </div>
                                </div>
                                @endif
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Current Password <span class="kt-font-danger">*</span>
                                    </label>
                                    <div class="col-lg-9 col-xl-6">
                                        <input type="password" name="current_password" class="form-control" value="" placeholder="Enter Current Password" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">New Password <span class="kt-font-danger">*</span>
                                    </label>
                                    <div class="col-lg-9 col-xl-6">
                                        <div class="input-group">
                                            <input type="password" name="new_password" class="form-control" value="" placeholder="Enter New Password" required="" minlength="8" maxlength="100" id="password">
                                            <div class="input-group-append">
                                                <a href="javascript:;" class="btn btn-secondary" id="viewMyPassword">
                                                    <i id="iconEye" class="fa fa-eye"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <small>Must be at least 8 characters, one uppercase, one number digit and one special character.</small>
                                        <i class="password-strength-indicator"></i>
                                    </div>
                                </div>
                                <div class="form-group form-group-last row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Confirm New Password <span class="kt-font-danger">*</span>
                                    </label>
                                    <div class="col-lg-9 col-xl-6">
                                        <input type="password" name="verify_password" class="form-control" value="" placeholder="Enter Confirm New Password" required="" minlength="8" maxlength="100">
                                        <small>Must be at least 8 characters, one uppercase, one number digit and one special character.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-lg-3 col-xl-3">
                                </div>
                                <div class="col-lg-9 col-xl-9">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-arrow-alt-circle-up"></i> Update</button>&nbsp;
                                    <button type="reset" class="btn btn-secondary"><i class="fa fa-history"></i> Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!--end::Form-->            

            </div>
        </div>
    </div>
</div>
<!--End:: App Content-->
@endsection


@section('js')
<script type="text/javascript">
$(function() {
    $( "#viewMyPassword" ).click(function() {

        var pass = $('#password');
        var iconEye = $('#iconEye');

        if (pass.attr("type") == "password") {
            pass.attr("type","text");
            iconEye.attr("class","fa fa-eye-slash")
        } else {
            pass.attr("type","password");
            iconEye.attr("class","fa fa-eye")
        }
    });
});
</script>
<script type="text/javascript">
    $(function() {
        $("#password").PasswordIndicator({
            // The password strength you consider secure
            secureStrength: 25,

            // Allows you to specify a custom indicator element (arbitrary jQuery selection)
            $indicator: undefined,

            // The class that the indicator element will have
            indicatorClassName: "password-strength-indicator",

            // CSS "display" property of the indicator elements
            indicatorDisplayType: "inline-block",

            // Set Multiple CSS Properties
            cssProperties: {"float": "right", "font-size": "13px"},

            // Points for different character sets
            points: {
                forEachCharacter: 1,
                forEachSpace: 1,
                containsLowercaseLetter: 2,
                containsUppercaseLetter: 2,
                containsNumber: 4,
                containsSymbol: 5
            },

            // The class names to give the indicator element, according to the current password strength
            strengthClassNames: [{
                name: "very-weak",
                text: "Password strength : very weak"
              }, {
                name: "weak",
                text: "Password strength : weak"
              }, {
                name: "mediocre",
                text: "Password strength : mediocre"
              }, {
                name: "strong",
                text: "Password strength : strong"
              }, {
                name: "awesome",
                text: "Password strength : Awesome"
              }]
        });
    });
</script>
@endsection