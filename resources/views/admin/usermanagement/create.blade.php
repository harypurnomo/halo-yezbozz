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
                <a href="{{ route('master-user.index') }}" class="btn kt-subheader__btn-primary">Back To List &nbsp;</a>
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
                <form class="kt-form" action="{{ route('master-user.store') }}" method="post">
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
                            <label>Fullname <span class="kt-font-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Your Name" value="{{ old('name') }}" required="" minlength="5" maxlength="100">
                        </div>
                        <div class="form-group">
                            <label>Email <span class="kt-font-danger">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="Your Email" required="" minlength="5" maxlength="100">
                        </div>
                        <div class="form-group">
                            <label>Phone Number <span class="kt-font-danger">*</span></label>
                            <input type="number" name="no_hp" class="form-control" placeholder="Your Phone Number" value="{{ old('no_hp') }}" required="" minlength="8" maxlength="30">
                            <small>Must be at least 8 number long </small>
                        </div>
                        <div class="form-group">
                            <label for="exampleSelect1">Group <span class="kt-font-danger">*</span></label>
                            <select class="form-control col-4" name="group_id" required="">
                                <option value="">-- choose one of them --</option>
                                @foreach ($recGroup as $item)
                                    <option value="{{ $item->group_id }}">{{ $item->group_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleSelect2">User Type <span class="kt-font-danger">*</span></label>
                            <select class="form-control col-4" name="user_type_id" required="">
                                <option value="">-- choose one of them --</option>
                                @foreach ($recUserType as $item)
                                    <option value="{{ $item->type_id }}">{{ $item->type_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password <span class="kt-font-danger">*</span></label>
                            <input type="password" name="password" class="form-control col-4" placeholder="Your Password" required="" minlength="8" maxlength="100">
                            <small>Must be at least 8 characters long </small>
                        </div>
                        <div class="form-group">
                            <div class="checkbox-list">
                                <label class="checkbox">
                                    <input type="checkbox" name="verified"> Send verification email
                                </label>
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