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
                <a href="{{ route('master-vendor-contact.index') }}" class="btn kt-subheader__btn-primary">Back To List &nbsp;</a>
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
                <form class="kt-form" action="{{ route('master-vendor-contact.store') }}" method="post" enctype="multipart/form-data">
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
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tab-general" data-toggle="tab" href="#general" role="tab" aria-controls="One" aria-selected="true">General</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active p-3" id="general" role="tabpanel" aria-labelledby="tab-general">
                                <div class="form-group">
                                    <label for="vendor_id">Vendor <span class="kt-font-danger">*</span></label>
                                    <select class="form-control col-4" name="vendor_id" required="">
                                        <option value="">-- choose one of them --</option>
                                        @foreach ($recVendor as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Name <span class="kt-font-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} Name" value="{{ old('name') }}" required="" minlength="3" maxlength="100">
                                    <span id="char-name">100</span> Character(s) Remaining
                                </div>
                                <div class="form-group">
                                    <label for="position">Position <span class="kt-font-danger">*</span></label>
                                    <select class="form-control col-4" name="position" required="">
                                        <option value="">-- choose one of them --</option>
                                        <option value="admin">Admin</option>
                                        <option value="sales">Sales</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Email </label>
                                    <input type="email" name="email" class="form-control " placeholder="{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} Email" value="{{ old('email') }}">
                                </div>
                                <div class="form-group">
                                    <label>Phone Number </label>
                                    <input type="number" class="form-control" name="phone" value="value="{{ old('phone') }}" placeholder="{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} Phone Number" minlength="8" maxlength="30">
                                </div>
                                <div class="form-group">
                                    <label>Avatar</label>
                                    <div class="col-4">
                                        <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar">
                                            <div class="kt-avatar__holder" style="background-image: url({{ asset('admin/template/client/noimage.png') }});"></div>
                                            <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change">
                                                <i class="fa fa-pen"></i>
                                                <input type="file" name="avatar">
                                            </label>
                                            <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Remove">
                                                <i class="fa fa-times"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <small>The best size 500 x 500</small>
                                </div>
                                <div class="form-group">
                                    <label>KTP</label>
                                    <div class="col-4">
                                        <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar2">
                                            <div class="kt-avatar__holder" style="background-image: url({{ asset('admin/template/client/noimage.png') }});"></div>
                                            <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change">
                                                <i class="fa fa-pen"></i>
                                                <input type="file" name="ktp">
                                            </label>
                                            <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Remove">
                                                <i class="fa fa-times"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <small>The best size 800 x 400</small>
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

    <script language="javascript" type="text/javascript">
    $(function(){
        var maxLength = 100;
        $('#name').keyup(function() {
        var textlen = maxLength - $(this).val().length;
        $('#char-name').text(textlen);
        });
    });
    </script>

@endsection

