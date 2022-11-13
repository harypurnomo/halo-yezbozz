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
                <a href="{{ route('master-billing.index') }}" class="btn kt-subheader__btn-primary">Back To List &nbsp;</a>
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
                    <h3 class="kt-portlet__head-title">Form Update</h3>
                </div>
            </div>
            
            <div class="kt-portlet__body">

                <!--begin::Form-->
                <form class="kt-form" action="{{ route('master-billing.update',['id'=>$recBillingsByID->id]) }}" method="post" enctype="multipart/form-data">
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
                            <label>{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} Number <span class="kt-font-danger">*</span></label>
                            <input type="text" name="billing_number" class="form-control" placeholder="{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} Number" value="{{ $recBillingsByID->billing_number }}" required="" minlength="3" maxlength="50">
                        </div>

                        <div class="form-group">
                            <label for="is_active">Customers <span class="kt-font-danger">*</span></label>
                            <select class="form-control col-4 kt-select2" name="tenant_id" id="kt_select2_1" data-select2-id="kt_select2_1" required="">
                                <option value="">-- choose one of them --</option>
                                @foreach ($recTenants as $element)
                                     <option value="{{ $element->id }}" {{ ($recBillingsByID->tenant_id==$element->id)?'selected':'' }}>{{ $element->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Invoice - Payment Due Date <span class="kt-font-danger">*</span></label>
                            <input type="text" name="invoice_range" class="form-control col-6" id="kt_daterangepicker_1" value="{{ date('m/d/Y',strtotime($recBillingsByID->start_date)) }} - {{ date('m/d/Y',strtotime($recBillingsByID->due_date)) }}" readonly="" required="">
                            <small>Format : month/date/year</small>
                        </div>

                        <div class="form-group">
                            <label>Total (format rupiah) <span class="kt-font-danger">*</span></label>
                            <input type="text" name="total" class="form-control input-numeral col-4" value="{{ str_replace(".",",",$recBillingsByID->total) }}" required="" placeholder="Total">
                        </div>

                        <div class="form-group">
                            <label>Notes / Terms</label>
                            <textarea name="desc" id="desc" class="form-control" minlength="5">{{ $recBillingsByID->desc }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="is_active">{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} Status<span class="kt-font-danger">*</span></label>
                            <select class="form-control col-4" name="billing_status_id" required="">
                                <option value="">-- choose one of them --</option>
                                @foreach ($recBillingStatus as $element)
                                     <option value="{{ $element->id }}" {{ ($recBillingsByID->billing_status_id==$element->id)?'selected':'' }}>{{ $element->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="is_active" class="row col-12">File {{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }}
                            </label>
                            @if (!empty($recBillingsByID->upload_invoice))
                            <a href="{{ url('/') }}/uploads/billings/{{ $recBillingsByID->upload_invoice }}" target="_blank">View File</a>
                            @endif
                            <input type="file" name="upload_invoice">
                        </div>

                        <div class="form-group">
                            <label for="is_active" class="row col-12">Receipt</label>
                            @if (!empty($recBillingsByID->upload_receipt))
                            <a href="{{ url('/') }}/uploads/billings/{{ $recBillingsByID->upload_receipt }}" target="_blank">View File</a>
                            @endif
                            <input type="file" name="upload_receipt">
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

            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="https://nosir.github.io/cleave.js/dist/cleave.min.js"></script>
<script type="text/javascript">
    $(function(){
        // numeral
        var cleaveNumeral = new Cleave('.input-numeral', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand',
            numeralIntegerScale: 15,
            numeralDecimalMark: ',',
            delimiter: '.'
        });
    });
</script>
<script type="text/javascript">
$(document).ready(function() {
    
    // enable fileuploader plugin
    $('input[name="upload_invoice"]').fileuploader({
        limit: 1,
        extensions: ['jpg', 'jpeg', 'png', 'pdf'],
        fileMaxSize: 10
    });

    // enable fileuploader plugin
    $('input[name="upload_receipt"]').fileuploader({
        limit: 1,
        extensions: ['jpg', 'jpeg', 'png', 'pdf'],
        fileMaxSize: 10
    });
    
});
</script>
@endsection

