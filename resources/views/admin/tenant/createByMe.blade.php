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
                        <div class="form-group">
                            <label>Company Name <span class="kt-font-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Company Name" value="{{ old('name') }}" required="">
                        </div>

                        <div class="form-group">
                            <label for="is_active">Type of Company <span class="kt-font-danger">*</span></label>
                            <select class="form-control col-4" name="tenant_type_id" required="">
                                <option value="">-- choose one of them --</option>
                                @foreach ($recTenantsType as $element)
                                     <option value="{{ $element->id }}">{{ $element->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Location (Floor/Suite) <span class="kt-font-danger">*</span></label>
                            <div class="row">
                                <div class="col-md-2 col-lg-2 col-xl-2">
                                    <input type="text" name="floor" class="form-control" placeholder="Your Floor" value="{{ old('floor') }}" required="">
                                </div>
                                <div class="col-md-10 col-lg-10 col-xl-10">
                                    <input type="text" name="suite" class="form-control" placeholder="Your Suite" value="{{ old('suite') }}" required="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Total Area <span class="kt-font-danger">*</span></label>
                            <div class="row">
                                <div class="col-md-2 col-lg-2 col-xl-2">
                                    <input type="number" name="total_area" class="form-control" placeholder="Your Area" value="{{ old('total_area') }}" required="">
                                </div>
                                <div class="col-md-2 col-lg-2 col-xl-2">
                                    <label style="padding-top: 10px;">m2 (meter persegi)</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Population <span class="kt-font-danger">*</span></label>
                            <div class="row">
                                <div class="col-md-2 col-lg-2 col-xl-2">
                                    <input type="number" name="population" class="form-control" placeholder="Your Population" value="{{ old('population') }}" required="">
                                </div>
                                <div class="col-md-2 col-lg-2 col-xl-2">
                                    <label style="padding-top: 10px;">Peoples</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Email <span class="kt-font-danger">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="Your Email" value="{{ old('email') }}" required="">
                        </div>

                        <div class="form-group">
                            <label>Phone Number <span class="kt-font-danger">*</span></label>
                            <input type="text" name="phone" class="form-control" placeholder="Your Phone Number" value="{{ old('phone') }}" required="">
                        </div>

                        <div class="form-group">
                            <label>Fax</label>
                            <input type="text" name="fax" class="form-control" placeholder="Your Fax" value="{{ old('fax') }}">
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" id="article_desc_en" class="form-control summernote">{{ old('description') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Logo/Picture </label>
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

                        <div class="form-group">
                            <label for="is_active">Active <span class="kt-font-danger">*</span></label>
                            <select class="form-control col-4" name="is_active" required="">
                                <option value="">-- choose one of them --</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
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

