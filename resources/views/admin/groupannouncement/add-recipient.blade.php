@extends('admin.layouts.template')

@section('content')
<!-- begin:: Content Head -->
<div class="kt-subheader  kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main"> 
            <h3 class="kt-subheader__title">Manage Recipients</h3>

            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Create a new</span>
            </div>
        </div>

        <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">
                <a href="{{ route('master-group-announcement.index') }}" class="btn kt-subheader__btn-primary">Back To List &nbsp;</a>
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
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <a href="#" class="btn btn-success btn-import btn-elevate">
                                <i class="la la-file-excel-o"></i> Import Excel File
                            </a>
                        </div>	
                    </div>		
                </div>
            </div>
            
            <div class="kt-portlet__body">

                <!--begin::Form-->
                <form class="kt-form" action="{{ route('manage-recipients.recipients.post') }}" method="post" enctype="multipart/form-data">
                	{{ csrf_field() }}
                    <input type="hidden" name="groups_announcement_id" value="{{ $groups_announcement_id }}">
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
                            <label>Recipient Name <span class="kt-font-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Your Recipient Name" required="">
                        </div>
                        
                        <div class="form-group">
                            <label>Email <span class="kt-font-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Your Recipient Email" required="">
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

                <hr>
                <!--begin: Datatable -->
                <h2>User Active</h2>
                <table class="table table-striped- table-bordered table-hover table-checkable simple-datatable">
                    <thead>
                        <tr>
                            <th width="100">#No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Last Updated</th>
                            <th></th>
                        </tr>
                    </thead>                   
                    <tbody>
                        @foreach ($recRecipientsAnnouncement as $index => $row)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ date_format(date_create($row->updated_at),"d M Y H:i:s") }}</td>
                            <td>
                                <a href="{{ route('manage-recipients.delete',['id'=>$row->id,'groups_announcement_id'=>$groups_announcement_id]) }}" class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill">
                                    <i class="flaticon2-trash"></i>&nbsp; Remove
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>                    
                </table>
                <!--end: Datatable -->

                <hr>
                <!--begin: Datatable -->
                <h2>User Unactive</h2>
                <table class="table table-striped- table-bordered table-hover table-checkable simple-datatable">
                    <thead>
                        <tr>
                            <th width="100">#No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Last Updated</th>
                            <th></th>
                        </tr>
                    </thead>                   
                    <tbody>
                        @foreach ($recRecipientsAnnouncementUnactive as $index => $row)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ date_format(date_create($row->updated_at),"d M Y H:i:s") }}</td>
                            <td>
                                <a href="{{ route('manage-recipients.delete',['id'=>$row->id,'groups_announcement_id'=>$groups_announcement_id]) }}" class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill">
                                    <i class="flaticon2-trash"></i>&nbsp; Remove
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>                    
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Data From Excel File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center" style="padding-bottom: 20px;">
                    <a href="{{ url('uploads/broadcast/template_upload.xls') }}" class="btn btn-success"><i class="la la-download"></i> Download Template Excel</a>
                </div>
                <div class="dropzone dz-clickable" id="myDrop">
                    <div class="dz-default dz-message" data-dz-message="">
                        <span>Drop files here to upload</span>
                    </div>
                </div>                           
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                {{-- <button type="button" class="btn btn-primary btn-import-process"><i class="fa fa-close"></i> Import File</button> --}}
            </div>
        </div>
    </div>
</div>

@endsection

@section('css')
{{-- <link rel="stylesheet" type="text/css" href="{{url('admin/template/plugins/dropzone/dropzone.min.css')}}" media="screen" /> --}}
@endsection

@section('js')
<script>
    $(function(){
        $('.btn-import').click(function (e) { 
            $('#exampleModal').modal('show');
        });

        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone("div#myDrop", {
            paramName: "file",
            url: "{{ route('upload.excel.announcement') }}",
            acceptedFiles: ".xls,.xlsx",
            addRemoveLinks : true,
            uploadMultiple: false,
            maxFiles: 1,
            dictResponseError: 'Error uploading file!',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            sending: function(file, xhr, formData) {
                formData.append("id", "{{ $groups_announcement_id }}");
            },
            init: function() {
                this.on("complete", function(file) {
                    console.log(file)
                    if(!file.accepted) {
                        this.removeFile(file);
                        alert('Invalid File Extension')
                        return false;
                    }
                });
            },
            success: function(file, response) {
                if(response.status=='1') 
                {
                    Swal.fire({
                        title: "Proses Import Berhasil",
                        html: "Proses Import Berhasil",
                        icon: "success",
                    }).then((result) => {;
                        window.location.reload()
                    })
                } 
                else
                {
                    alert(response.error)
                    this.removeFile(file);
                }
            }
        });

    })
</script>
@endsection

