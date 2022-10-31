@extends('admin.layouts.template')

@section('content')
<!-- begin:: Content Head -->
<div class="kt-subheader  kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main"> 
            <h3 class="kt-subheader__title">Manage Popup</h3>

            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Create a new Popup</span>
            </div>
        </div>

        <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">
                <a href="{{ route('manage-popup.index') }}" class="btn kt-subheader__btn-primary">Back To List &nbsp;</a>
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
                <form class="kt-form" action="{{ route('manage-popup.store') }}" method="post" enctype="multipart/form-data">
                	{{ csrf_field() }}
                    <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
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
                            <label>Title <span class="kt-font-danger">*</span></label>
                            <input type="text" name="title"class="form-control" placeholder="Popup Title" value="{{ old('title') }}" required="">
                        </div>
                        <div class="form-group">
                            <label>Text Content <span class="kt-font-danger">*</span></label>
                            <textarea name="text_content" id="text_content" class="form-control summernote" required="">{{ old('text_content') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Close Time (In Second) <span class="kt-font-danger">*</span></label>
                            <input type="number" name="close_time"class="form-control" placeholder="Close Time" value="{{ old('close_time') }}" required="">
                        </div>
                        <div class="form-group">
                            <label for="show_title">Show Title <span class="kt-font-danger">*</span></label>
                            <select class="form-control col-4" name="show_title" required="">
                                <option value="">-- choose one of them --</option>
                                <option value="1" @if(old('show_title')=='1') selected @endif>Yes</option>
                                <option value="0" @if(old('show_title')=='0') selected @endif>No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="is_active">Active <span class="kt-font-danger">*</span></label>
                            <select class="form-control col-4" name="is_active" required="">
                                <option value="">-- choose one of them --</option>
                                <option value="1" @if(old('is_active')=='1') selected @endif>Yes</option>
                                <option value="0" @if(old('is_active')=='0') selected @endif>No</option>
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