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
                            <a href="{{ route('master-module.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
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
                <table class="table table-striped- table-bordered table-hover table-checkable">
                    <thead>
                        <tr>
                            <th>#No</th>
                            <th>Module Name</th>
                            <th>Parent Menu</th>
                            <th>Link Menu</th>
                            <th></th>
                        </tr>
                    </thead>                   
                    <tbody>
                        @foreach ($module as $index => $row)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td><a href="{{ url('administrator/master-module') }}/{{ $row->module_id }}/edit">{{ $row->module_name }}</a></td>
                            <td>{{ $row->parent }}</td>
                            <td>{{ $row->link }}</td>
                            <td>
                                <span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill delete-link" data-id="{{ $row->module_id }}" data-link="administrator/master-module">
                                    <i class="flaticon2-trash"></i> Remove
                                </span>
                            </td>
                        </tr>
                            @foreach ($row->child_module as $no => $d)
                            <tr>
                                <td class="pl-20">{{ $index }}. {{ ++$no }}</td>
                                <td class="pl-40"><a href="{{ url('administrator/master-module') }}/{{ $d->module_id }}/edit">{{ $d->module_name }}</a></td>
                                <td>{{ $d->parent }}</td>
                                <td>{{ $d->link }}</td>
                                <td>
                                    <span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill delete-link" data-id="{{ $d->module_id }}" data-link="administrator/master-module">
                                        <i class="flaticon2-trash"></i> Remove
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        @endforeach
                    </tbody>                    
                </table>
                <!--end: Datatable -->
            </div>
        </div>
    </div>

</div>
    
@endsection