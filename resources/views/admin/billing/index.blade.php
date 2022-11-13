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
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <a href="{{ route('master-billing.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i> Create a new
                            </a>
                        </div>	
                    </div>		
                </div>
            </div>
            
            <div class="kt-portlet__body">

                <div class="alert alert-light alert-elevate fade show" role="alert">
                    <div class="alert-icon"><i class="flaticon-information kt-font-brand"></i></div>
                    <div class="alert-text"><b>Click the blue text to edit your data.</b></div>
                </div>

                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable simple-datatable">
                    <thead>
                        <tr>
                            <th width="100">#No</th>
                            <th>{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} Number</th>
                            <th>Customers</th>
                            <th>Start Date</th>
                            <th>Due Date</th>
                            <th>Total (rupiah)</th>
                            <th>Notes / Terms</th>
                            <th>{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} / Receipt</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>                   
                    <tbody>
                        @foreach ($recBillings as $index => $row)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td><a href="{{ route('master-billing.edit',['id'=>$row->id]) }}">{{ $row->billing_number }}</a></td>
                            <td>{{ $row->tenant_name }}</td>
                            <td>{{ date('d M Y',strtotime($row->start_date)) }}</td>
                            <td>{{ date('d M Y',strtotime($row->due_date)) }}</td>
                            <td>{{ number_format($row->total,'0',',','.') }}</td>
                            <td>{{ $row->desc }}</td>
                            <th><a href="{{ url('/') }}/uploads/billings/{{ $row->upload_invoice }}" target="_blank">{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }}</a> / <a href="{{ url('/') }}/uploads/billings/{{ $row->upload_receipt }}" target="_blank">Receipt</a></th>
                            <td>
                                <span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill">{{ $row->billing_status }}</span>
                            </td>
                            <td>
                                <span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill delete-link" data-id="{{ $row->id }}" data-link="administrator/master-billing">
                                    <i class="flaticon2-trash"></i> Remove
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>                    
                </table>
                <!--end: Datatable -->
            </div>
        </div>
    </div>

</div>
    
@endsection