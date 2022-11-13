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
                <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">List Data</span>
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
                    <h3 class="kt-portlet__head-title">{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }}</h3>
                </div>
            </div>
            
            <div class="kt-portlet__body">

                @foreach ($recSeo as $element)
                <!--begin::Form-->
                <form class="kt-form" action="{{ route('master-seo.update',['id'=>$element->id]) }}" method="POST">
                    {{method_field('PUT')}}
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
                            <label>Site Name EN <span class="kt-font-danger">*</span></label>
                            <input type="text" name="site_name_en" class="form-control" placeholder="Your Site Name" value="{{ $element->site_name_en }}" required="">
                        </div>
                        <div class="form-group">
                            <label>Site Name ID <span class="kt-font-danger">*</span></label>
                            <input type="text" name="site_name_id" class="form-control" placeholder="Your Site Name" value="{{ $element->site_name_id }}" required="">
                        </div>

                        <div class="form-group">
                            <label>Meta Title EN<span class="kt-font-danger">*</span></label>
                            <input type="text" name="meta_title_en" class="form-control" placeholder="Your Meta Title" value="{{ $element->meta_title_en }}" required="">
                        </div>
                        <div class="form-group">
                            <label>Meta Title ID<span class="kt-font-danger">*</span></label>
                            <input type="text" name="meta_title_id" class="form-control" placeholder="Your Meta Title" value="{{ $element->meta_title_id }}" required="">
                        </div>

                        <div class="form-group">
                            <label>Meta Description EN <span class="kt-font-danger">*</span></label>
                            <input type="text" name="meta_description_en" class="form-control" placeholder="Your Meta Description" value="{{ $element->meta_description_en }}" required="">
                        </div>
                        <div class="form-group">
                            <label>Meta Description ID <span class="kt-font-danger">*</span></label>
                            <input type="text" name="meta_description_id" class="form-control" placeholder="Your Meta Description" value="{{ $element->meta_description_id }}" required="">
                        </div>

                        <div class="form-group">
                            <label>Meta Keyword EN <span class="kt-font-danger">*</span></label>
                            <input type="text" name="meta_keyword_en" class="form-control" placeholder="Your Meta Keyword" value="{{ $element->meta_keyword_en }}" required="">
                        </div>
                        <div class="form-group">
                            <label>Meta Keyword ID <span class="kt-font-danger">*</span></label>
                            <input type="text" name="meta_keyword_id" class="form-control" placeholder="Your Meta Keyword" value="{{ $element->meta_keyword_id }}" required="">
                        </div>

                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="submit" class="btn btn-success"><i class="fa fa-arrow-alt-circle-up"></i> Update</button>&nbsp;
                            <button type="reset" class="btn btn-secondary"><i class="fa fa-history"></i> Reset</button>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
                @endforeach
                
            </div>
        </div>
    </div>

</div>
    
@endsection