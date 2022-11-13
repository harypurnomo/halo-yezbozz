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
                            <a href="{{ route('open-ticket.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i> Create a new
                            </a>
                        </div>	
                    </div>		
                </div>
            </div>
            
            <div class="kt-portlet__body">

                <div class="alert alert-light alert-elevate fade show" role="alert">
                    <div class="alert-icon"><i class="flaticon-information kt-font-brand"></i></div>
                    <div class="alert-text"><b>Click message to show data.</b></div>
                </div>

                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable simple-datatable">
                    <thead>
                        <tr>
                            <th width="100">#No</th>
                            <th>Message</th>
                            <th>Category</th>
                            <th>Priority</th>
                            <th>Last Updated</th>
                            <th>Status</th>
                        </tr>
                    </thead>                   
                    <tbody>
                        @foreach ($recHelpdeskIsParent as $index => $row)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td><a href="{{ route('open-ticket.show',['id'=>base64_encode($row->id)]) }}">
                                @if ($row->is_read_admin==0)
                                <b>{{ $row->message }}</b>
                                @else
                                {{ $row->message }}
                                @endif
                                </a>
                            </td>
                            <td>{{ $row->category_name }}</td>
                            <td>{{ $row->priority_name }}</td>
                            <td>{{ date_format(date_create($row->updated_at),"d M Y H:i:s") }}</td>
                            <td>
                                {!! ($row->is_active=='1')?'<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill">Open</span>':'<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill bg-dark">Close</span>' !!}
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