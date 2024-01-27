@extends('admin.layouts.template')

@section('content')
<!-- begin:: Content Head -->
<div class="kt-subheader  kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main"> 
            <h3 class="kt-subheader__title"></h3>

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
        
            <div class="kt-portlet__body">

                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable simple-datatable">
                    <thead>
                        <tr>
                            <th width="100">#No</th>
                            <th>Customers</th>
                            <th>Address</th>
                            <th>Google Maps</th>
                            <th>Additional</th>
                        </tr>
                    </thead>                   
                    <tbody>
                        @foreach ($recTenants as $index => $row)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>
                                {{ $row->name }}
                                <br><em>Tipe : {{ $row->type }}</em>
                            </td>
                            <td>
                                {{ $row->address }}
                            </td>
                            <td>
                                <a href="{{ $row->google_maps }}" target="_blank">{!! $row->google_maps !!}</a>
                                <br><br>Coordinate : {{ $row->coordinate }}
                            </td>
                            <td>
                                Email : {{ $row->email }} <br>
                                Phone : {{ $row->phone }} <br>
                                Whatsapp : {{ $row->whatsapp }} <br>
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