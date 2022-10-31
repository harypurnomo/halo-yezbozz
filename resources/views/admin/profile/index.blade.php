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
<div class="kt-grid__item kt-grid__item--fluid kt-app__content">
    <div class="row">
        <div class="col-xl-12">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Form Update</h3>
                    </div>
                </div>

                <div class="kt-portlet__body">
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
                    <div class="kt-section kt-section--first">
                        <div class="kt-section__body">
                            
                            <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-general" data-toggle="tab" href="#general-info" role="tab" aria-controls="One" aria-selected="true">General Information</a>
                                </li>
                                @if (Auth::user()->user_type_id==2)
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-specific" data-toggle="tab" href="#specific-info" role="tab" aria-controls="Two" aria-selected="false">Spesific Information</a>
                                </li>
                                @endif
                            </ul>

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active p-3" id="general-info" role="tabpanel" aria-labelledby="tab-general">
                                    <form class="kt-form kt-form--label-right" method="POST" action="{{ route('update.personal.info') }}" enctype="multipart/form-data">
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        {!! csrf_field() !!}
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">My Pic</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar">
                                                    @if(Auth::user()->mypic=='')
                                                    <div class="kt-avatar__holder" style="background-image: url({{ asset('admin/template/client/noimage.png') }});"></div>
                                                    @else 
                                                    <div class="kt-avatar__holder" style="background-image: url({{ asset('uploads/mypic') }}/{{ Auth::user()->mypic }})"></div>
                                                    @endif
                                                    <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change">
                                                        <i class="fa fa-pen"></i>
                                                        <input type="file" name="mypic" accept=".png, .jpg, .jpeg">
                                                    </label>
                                                    <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Remove">
                                                        <i class="fa fa-times"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Fullname <span class="kt-font-danger">*</span>
                                            </label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input class="form-control" type="text" name="name" value="{{ Auth::user()->name }}" required="" minlength="5" maxlength="100">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Phone Number <span class="kt-font-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="no_hp" value="{{ Auth::user()->no_hp }}" placeholder="Your Phone Number" required="" minlength="8" maxlength="30">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Address <span class="kt-font-danger">*</span>
                                            </label>
                                            <div class="col-lg-9 col-xl-6">
                                                <textarea name="address" class="form-control" required="">{{ Auth::user()->address }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Email</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="input-group">
                                                    <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" disabled="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">User Type</label>
                                            <div class="col-lg-9 col-xl-6">
                                                @foreach ($recUserType as $element)
                                                <div class="form-check">
                                                    <input id="user_type_id{{ $element->type_id }}" class="form-check-input required valid" type="radio" name="user_type_id" value="{{ $element->type_id }}" @if(Auth::user()->user_type_id==$element->type_id) checked="checked" @endif>
                                                    <label for="user_type_id{{ $element->type_id }}" class="form-check-label">
                                                        {{ $element->type_name }}
                                                    </label>
                                                </div><hr>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"></label>
                                            <div class="col-lg-9 col-xl-9">
                                                <button type="submit" class="btn btn-success"><i class="fa fa-arrow-alt-circle-up"></i> Update</button>&nbsp;
                                                <button type="reset" class="btn btn-secondary"><i class="fa fa-history"></i> Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade p-3" id="specific-info" role="tabpanel" aria-labelledby="tab-specific">
                                    {{-- for company --}}
                                    @if (Auth::user()->user_type_id==2)

                                    <form class="kt-form kt-form--label-right" method="POST" action="{{ route('update.specific.info') }}">
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        {!! csrf_field() !!}

                                        @inject('company', 'App\Services\CompanyService')
                                    
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Company Name <span class="kt-font-danger">*</span>
                                            </label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input class="form-control" type="text" name="company_name" value="{{ (empty($recCompanyByUserID))?'':$company->getCompanyByUserID(Auth::user()->id)[0]->name }}" required="" minlength="8" maxlength="100">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Company Email <span class="kt-font-danger">*</span>
                                            </label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input class="form-control" type="email" name="company_email" value="{{ (empty($recCompanyByUserID))?'':$company->getCompanyByUserID(Auth::user()->id)[0]->email }}" required="" minlength="8" maxlength="50">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Company Phone <span class="kt-font-danger">*</span>
                                            </label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input class="form-control" type="tel" name="company_phone" value="{{ (empty($recCompanyByUserID))?'':$company->getCompanyByUserID(Auth::user()->id)[0]->phone }}" required="" minlength="8" maxlength="50">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Company Fax
                                            </label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input class="form-control" type="tel" name="company_fax" value="{{ (empty($recCompanyByUserID))?'':$company->getCompanyByUserID(Auth::user()->id)[0]->fax }}" maxlength="50">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Company Address <span class="kt-font-danger">*</span>
                                            </label>
                                            <div class="col-lg-9 col-xl-6">
                                                <textarea class="form-control" name="company_address" required="">{!! (empty($recCompanyByUserID))?'':$company->getCompanyByUserID(Auth::user()->id)[0]->address !!}</textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"></label>
                                            <div class="col-lg-9 col-xl-9">
                                                <button type="submit" class="btn btn-success"><i class="fa fa-arrow-alt-circle-up"></i> Update</button>&nbsp;
                                                <button type="reset" class="btn btn-secondary"><i class="fa fa-history"></i> Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End:: App Content-->

@endsection

@section('js')
<script>
@if(Session::has('profile-tab'))
$('#tab-specific').trigger('click');
@endif
</script>
@endsection