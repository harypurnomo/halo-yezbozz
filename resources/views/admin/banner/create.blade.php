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
                <a href="{{ route('master-banner.index') }}" class="btn kt-subheader__btn-primary">Back To List &nbsp;</a>
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
                <form class="kt-form" action="{{ route('master-banner.store') }}" method="post" enctype="multipart/form-data">
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
                            <label>Title EN<span class="kt-font-danger">*</span></label>
                            <textarea name="title_en" class="form-control summernote" required="">{{ old('title_en') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Title ID<span class="kt-font-danger">*</span></label>
                            <textarea name="title_id" class="form-control summernote" required="">{{ old('title_id') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Brief EN <span class="kt-font-danger">*</span></label>
                            <textarea name="brief_en" id="brief_en" class="form-control" maxlength="140" required="">{{ old('brief_en') }}</textarea>
                            <span id="char-brief_en">140</span> Character(s) Remaining
                        </div>
                        <div class="form-group">
                            <label>Brief ID <span class="kt-font-danger">*</span></label>
                            <textarea name="brief_id" id="brief_id" class="form-control" maxlength="140" required="">{{ old('brief_id') }}</textarea>
                            <span id="char-brief_id">140</span> Character(s) Remaining
                        </div>

                        <div class="form-group">
                            <label>Banner <span class="kt-font-danger">*</span></label>
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
                            <small>The best size 1746 × 980</small>
                        </div>

                        <div class="form-group">
                            <label>Sort <span class="kt-font-danger">*</span></label>
                            <input type="number" name="sort" class="form-control" placeholder="Your Sort Menu" value="{{ old('sort') }}" required="">
                        </div>

                        <div class="form-group">
                            <label>Link EN</label>
                            <input type="text" name="link_en" class="form-control" placeholder="Your Link ID" value="{{ old('link_en') }}" minlength="5" maxlength="100">
                            <small>If you only have one link use the (Link EN)</small>
                        </div>
                        <div class="form-group">
                            <label>Link ID</label>
                            <input type="text" name="link_id" class="form-control" placeholder="Your Link ID" value="{{ old('link_id') }}" minlength="5" maxlength="100">
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
<script language="javascript" type="text/javascript">
$(function(){
    var maxLength = 140;
    $('#brief_en').keyup(function() {
      var textlen = maxLength - $(this).val().length;
      $('#char-brief_en').text(textlen);
    });
});

$(function(){
    var maxLength = 140;
    $('#brief_id').keyup(function() {
      var textlen = maxLength - $(this).val().length;
      $('#char-brief_id').text(textlen);
    });
});
</script>
@endsection

