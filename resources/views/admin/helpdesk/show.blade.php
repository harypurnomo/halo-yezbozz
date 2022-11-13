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
                <a href="{{ route('open-ticket.index') }}" class="btn kt-subheader__btn-primary">Back To List &nbsp;</a>
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
                    <h3 class="kt-portlet__head-title">Detail Ticket</h3>
                </div>
               {{--  <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <a href="{{ route('open-ticket-by-me.reply') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-reply"></i> Reply message
                            </a>
                        </div>	
                    </div>		
                </div> --}}
            </div>
            
            <div class="kt-portlet__body">

                @foreach ($recHelpdeskById as $element)
                <div class="alert alert-light alert-elevate fade show" role="alert">
                    <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">{{ strtoupper(substr($element->sender_name,0,1)) }}</span>&nbsp;&nbsp;&nbsp;
                    <div class="alert-text">
                        <a id="btnGroupDrop1" class="btn btn-brand btn-elevate btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="float: right;margin: 0px 10px;color: white;">
                        Status Ticket
                        </a>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="{{ route('status.open.ticket',['id'=>base64_encode($element->id),'is_active'=>1]) }}">Open</a>
                            <a class="dropdown-item" href="{{ route('status.open.ticket',['id'=>base64_encode($element->id),'is_active'=>0]) }}">Close</a>
                        </div>

                        <a href="{{ route('open-ticket.reply',['id'=>base64_encode($element->id)]) }}" class="btn btn-brand btn-elevate btn-icon-sm" style="float: right;">
                            <i class="la la-reply"></i> Reply message
                        </a>
                        
                        
                        <b>{{ ucwords($element->sender_name) }}</b><br>
                        <em>Category : {{ ucwords($element->category_name) }} | Priority : {{ ucwords($element->priority_name) }}</em><br>
                        <i>{{ date_format(date_create($element->created_at),"d M Y H:i:s") }}</i>

                        <hr style="border-top-color: #cecece;">
                        <br>
                        <p>
                            <h4>{{ $element->message }}</h4>
                            <br><br>
                            @if (!empty($element->file_attachement))
                                File Attachement : <a href="{{ url('/uploads/helpdesk/file_attachement') }}/{{ $element->file_attachement }}" target="_blank">download</a>
                            @endif                      
                        </p>
                    </div>
                </div>
                @endforeach

                @foreach ($recHelpdeskByUUID as $element)
                <div class="alert alert-light alert-elevate fade show" role="alert">
                    <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">{{ strtoupper(substr($element->sender_name,0,1)) }}</span>&nbsp;&nbsp;&nbsp;
                    <div class="alert-text">
                        <b>{{ ucwords($element->sender_name) }}</b><br>
                        <em>Category : {{ ucwords($element->category_name) }} | Priority : {{ ucwords($element->priority_name) }}</em><br>
                        <i>{{ date_format(date_create($element->created_at),"d M Y H:i:s") }}</i>

                        <hr style="border-top-color: #cecece;">
                        <br>
                        <p>
                            <h4>{{ $element->message }}</h4>
                            <br><br>
                            @if (!empty($element->file_attachement))
                                File Attachement : <a href="{{ url('/uploads/helpdesk/file_attachement') }}/{{ $element->file_attachement }}" target="_blank">download</a>
                            @endif                      
                        </p>
                    </div>
                </div>
                @endforeach
                
                
            </div>
        </div>
    </div>

</div>
    
@endsection