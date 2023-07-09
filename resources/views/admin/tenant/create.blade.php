@extends('admin.layouts.template')

@section('content')
<!-- begin:: Content Head -->
<div class="kt-subheader  kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main"> 
            <h3 class="kt-subheader__title">{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }}</h3>

            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Create a new</span>
            </div>
        </div>

        <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">
                <a href="{{ route('master-tenant.index') }}" class="btn kt-subheader__btn-primary">Back To List &nbsp;</a>
            </div>
        </div>
    </div>
</div>
<!-- end:: Content Head -->					

<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<div class="row">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon-more"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">Form Create</h3>
                </div>
            </div>
            
            <div class="kt-portlet__body">

                <!--begin::Form-->
                <form class="kt-form" action="{{ route('master-tenant.store') }}" method="post" enctype="multipart/form-data">
                	{{ csrf_field() }}
                    <div class="kt-portlet__body">
                    	@if ($errors->any())
					    <div class="alert alert-danger">
					        <ul>
					            @foreach ($errors->all() as $error)
					                <li>{{ $error }}</li>
					            @endforeach
					        </ul>
					    </div>
						@endif

                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="tab-general" data-toggle="tab" href="#general-info" role="tab" aria-controls="One" aria-selected="true">General</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-optional" data-toggle="tab" href="#optional-info" role="tab" aria-controls="Two" aria-selected="false">Optional</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active p-3" id="general-info" role="tabpanel" aria-labelledby="tab-general">
                                <div class="form-group">
                                    <label>{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} <span class="kt-font-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" placeholder="{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }}" value="{{ old('name') }}" required="" minlength="3" maxlength="100">
                                </div>
        
                                <div class="form-group">
                                    <label for="is_active">Category of {{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} <span class="kt-font-danger">*</span></label>
                                    <select class="form-control col-4" name="tenant_type_id" required="">
                                        <option value="">-- choose one of them --</option>
                                        @foreach ($recTenantsType as $element)
                                             <option value="{{ $element->id }}">{{ $element->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
        
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea name="address" class="form-control" rows="5">{{ old('address') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Google Maps</label>
                                    <input type="text" name="google_maps" class="form-control" placeholder="Your Link Maps" value="{{ old('google_maps') }}">
                                </div>

                                <div class="form-group">
                                    <label>Coordinate</label>
                                    <input type="text" name="coordinate" class="form-control" placeholder="Your Coordinate" value="{{ old('coordinate') }}">
                                </div>

                                <div class="form-group">
                                    <label for="type">Type of {{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }}<span class="kt-font-danger">*</span></label>
                                    <select class="form-control col-4" name="type" required="">
                                        <option value="">-- choose one of them --</option>
                                        <option value="Langganan Online">Langganan Online</option>
                                        <option value="Langganan Offline">Langganan Offline</option>
                                        <option value="Langganan Online & Offline">Langganan Online & Offline</option>
                                        <option value="Prospect">Prospect</option>
                                    </select>
                                </div>
        
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Your Phone Number" value="{{ old('phone') }}" minlength="8" maxlength="30">
                                    <small>Must be at least 8 number long </small>
                                </div>
        
                                <div class="form-group">
                                    <label>Whatsapp</label>
                                    <input type="text" name="whatsapp" class="form-control" placeholder="Your Whatsapp" value="{{ old('whatsapp') }}" minlength="8" maxlength="30">
                                    <small>Must be at least 8 number long </small>
                                </div>
        
                                <div class="form-group">
                                    <label for="is_active">Active <span class="kt-font-danger">*</span></label>
                                    <select class="form-control col-4" name="is_active" required="">
                                        <option value="">-- choose one of them --</option>
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="tab-pane fade p-3" id="optional-info" role="tabpanel" aria-labelledby="tab-optional">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label>Instagram Link</label>
                                        <input type="text" name="instagram" class="form-control" placeholder="Your Instagram Link" value="{{ old('instagram') }}" maxlength="250">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Facebook Link</label>
                                        <input type="text" name="facebook" class="form-control" placeholder="Your Facebook Link" value="{{ old('facebook') }}" maxlength="250">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label>Youtube Link</label>
                                        <input type="text" name="youtube" class="form-control" placeholder="Your Youtube Link" value="{{ old('youtube') }}" maxlength="250">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Website Link</label>
                                        <input type="text" name="website_url" class="form-control" placeholder="Your Website Link" value="{{ old('website_url') }}" maxlength="250">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label>Company Description</label>
                                        <textarea name="description" id="article_desc_en" class="form-control summernote">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Your Email" value="{{ old('email') }}" minlength="5" maxlength="100">
                                </div>
                                <div class="form-group">
                                    <label>Logo/Picture {{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }}</label>
                                    <div class="col-4">
                                        <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar">
                                            <div class="kt-avatar__holder" style="background-image: url({{ asset('admin/template/client/noimage.png') }});"></div>
                                            <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change">
                                                <i class="fa fa-pen"></i>
                                                <input type="file" name="picture">
                                            </label>
                                            <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Remove">
                                                <i class="fa fa-times"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <small>The best size 300 x 150</small>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-arrow-alt-circle-up"></i> Submit</button>&nbsp;
                            <button type="reset" class="btn btn-secondary"><i class="fa fa-history"></i> Reset</button>
                        </div>
                    </div>
                </form>
                <!--end::Form-->			

            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

@endsection

