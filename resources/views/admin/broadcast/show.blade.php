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

        <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">
                <a href="{{ route('master-broadcast.index') }}" class="btn kt-subheader__btn-primary">Back To List &nbsp;</a>
            </div>
        </div>
    </div>
</div>
<!-- end:: Content Head -->	

{{-- {{ dd($recHelpdeskById) }} --}}

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

                @foreach ($recBroadcastByUUID as $element)
                <div class="alert alert-light alert-elevate fade show" role="alert">
                    <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">{{ strtoupper(substr($element->subject,0,1)) }}</span>&nbsp;&nbsp;&nbsp;
                    <div class="alert-text">
                        <b>{{ $element->subject }}</b><br>
                        <i>{{ date_format(date_create($element->created_at),"d M Y H:i:s") }}</i>

                        <hr style="border-top-color: #cecece;">
                        <br>
                        <p>
                            <div>{!! $element->message !!}</div>
                            <br><br>
                            @if (!empty($element->file_attachement))
                                File Attachement : <a href="{{ url('/uploads/broadcast/file_attachement') }}/{{ $element->file_attachement }}" target="_blank">download</a>
                            @endif                      
                        </p>
                    </div>
                </div>
                @endforeach

                <div class="alert alert-light alert-elevate fade show" role="alert">
                    <div class="alert-icon"><i class="flaticon-information kt-font-brand"></i></div>
                    <div class="alert-text"><b>Summary Report</b></div>
                    <ul>
                        <li>Total Email was Successfully : {{ $recBroadcastRecipientsCountIsSent }} </li>
                        <li>Total Email Pending : {{ $recBroadcastRecipientsCountIsPending }}</li>
                        <li>Email Conversion Rate : {{ $recBroadcastRecipientLinksIsClicked }} Clicked</li>
                    </ul>
                </div>

                <hr>
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable simple-datatable">
                    <thead>
                        <tr>
                            <th width="100">#No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Send Mail Status</th>
                            <th>Click Status</th>
                        </tr>
                    </thead>                   
                    <tbody>
                        @foreach ($recBroadcastRecipientsByUUID as $index => $row)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->email }}</td>
                            <td>
                                {!! ($row->is_status=='1')?'<span style="background:#BDC848;padding: 5px;border-radius:10px;">Sent</span>':'<span style="background:#E1B04F;padding: 5px;border-radius:10px;">Pending</span>' !!}
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary btn-track" data-id="{{ $row->id }}" data-email="{{ $row->email }}">Click Status</button>
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

<div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Email Link Tracker</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <table class="table" id="table-user-click">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Link</th>
                        <th>Click Status</th>
                        <th>Click Date</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>  

@endsection

@section('js')
<script language="javascript" type="text/javascript">
$(function(){
    $(document).on('click','.btn-track',function(){
        var id = $(this).data('id');
        var email = $(this).data('email');
        $.ajax({
            type: "get",
            url: "{{ url('administrator/master-broadcast-track') }}/"+id+"/"+email,
            dataType: "json",
            success: function (res) {
                $('#table-user-click tbody').html(res.body)
                $('#exampleModal').modal('show');
            },
            error: function(e) {
                alert('Maaf terjadi kesalahan pada server !');
            }
        });
    });
});
</script>
@endsection