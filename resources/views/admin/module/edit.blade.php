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
                <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Form update</span>
            </div>
        </div>

        <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">
                <a href="{{ route('master-module.index') }}" class="btn kt-subheader__btn-primary">Back To List &nbsp;</a>
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
                        <i class="kt-font-brand flaticon-users"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">Form Update</h3>
                </div>
            </div>
            
            <div class="kt-portlet__body">

                <!--begin::Form-->
                <form class="kt-form form-submit-ajax" action="{{ url('administrator/master-module') }}/{{ $row->module_id }}" method="POST">
                    {{method_field('PUT')}}
                    <div class="kt-portlet__body">
                        <div class="form-group">
                            <label>Module Name <span class="kt-font-danger">*</span></label>
                            <input type="text" name="module_name" value="{{ $row->module_name }}" class="form-control" placeholder="Your Module Name" required="" minlength="5" maxlength="50">
                        </div>
                        <div class="form-group">
                            <label>Type Menu</label>
                            <select class="form-control" name="tipe_menu">
                                <option value="1" {{($row->category=='1')?'selected':''}}>Parent</option>
                                <option value="2" {{($row->category=='2')?'selected':''}}>Child</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Parent Menu</label>
                            <select class="form-control" name="parent_menu">
                                <option value="">-- choose one of them --</option>
                                @foreach ($parent as $item)
                                <option value="{{ $item->module_id }}"  {{($item->module_id==$row->parent_id)?'selected':''}}>{{ $item->module_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Link <span class="kt-font-danger">*</span></label>
                            <input type="text" name="link" value="{{ $row->link }}" class="form-control" placeholder="Your Link Menu" required="" minlength="5" maxlength="50">
                        </div>
                        <div class="form-group">
                            <label>Icon</label>
                            <input type="text" name="icon" value="{{ $row->icon }}" class="form-control" placeholder="Your Icon Menu">
                        </div>
                        <div class="form-group">
                            <label>Order <span class="kt-font-danger">*</span></label>
                            <input type="number" name="order" value="{{ $row->order }}" class="form-control" placeholder="Your Order Menu" required="">
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="button" class="btn btn-success btn-submit-ajax" data-href="{{ url('administrator/master-module') }}"><i class="fa fa-arrow-alt-circle-up"></i> Update</button>
                            <button type="reset" class="btn btn-secondary"><i class="fa fa-history"></i> Reset</button>
                        </div>
                    </div>
                </form>
                <!--end::Form-->			

            </div>
        </div>
    </div>

</div>
<!--end:: Widgets/Outbound Bandwidth-->	
    
@endsection