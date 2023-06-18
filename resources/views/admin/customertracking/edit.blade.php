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
                <a href="{{ route('master-transaction.index') }}" class="btn kt-subheader__btn-primary">Back To List &nbsp;</a>
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
                <form class="kt-form" action="{{ route('master-transaction.update',['id'=>$recTransactionsByID->id]) }}" method="post" enctype="multipart/form-data">
                    {{method_field('PUT')}}
                    {{ csrf_field() }}
                    <input type="hidden" name="no_invoice" value="{{ $recTransactionsByID->no_invoice }}">
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
                            <label>Nama Pembeli <span class="kt-font-danger">*</span></label>
                            <input type="text" name="nama_pembeli" id="nama_pembeli" class="form-control" value="{{ $recTransactionsByID->nama_pembeli }}" required="" disabled>
                        </div>
                        <div class="form-group">
                            <label>Alamat Pengiriman <span class="kt-font-danger">*</span></label>
                            <textarea name="alamat_pengiriman" id="alamat_pengiriman" cols="30" rows="5" class="form-control" disabled>{{ $recTransactionsByID->alamat_pengiriman }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Locations With Coordinate <span class="kt-font-danger">*</span></label>
                            <input type="text" name="coordinate" id="coordinate" class="form-control" value="{{ $recTransactionsByID->coordinate }}" required="">
                        </div>

                        <div class="form-group">
                            <label for="is_complete">Complete ? <span class="kt-font-danger">*</span></label>
                            <select class="form-control col-4" name="is_complete" required="">
                                <option value="">-- choose one of them --</option>
                                <option value="1" {{ ($recTransactionsByID->is_complete==1)?'selected':'' }}>Yes</option>
                                <option value="0" {{ ($recTransactionsByID->is_complete==0)?'selected':'' }}>No</option>
                            </select>
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
<script type="text/javascript">
    $(document).on('click','.delete-file-link',function(){
        if(confirm('Are you sure ?')) {
            var link = $(this).attr('data-link');
            window.location.assign(link);
        }
    });
</script>
@endsection

