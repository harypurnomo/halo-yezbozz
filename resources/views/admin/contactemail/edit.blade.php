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
                <a href="{{ route('master-contact-email.index') }}" class="btn kt-subheader__btn-primary">Back To List &nbsp;</a>
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
                <form class="kt-form" action="{{ route('master-contact-email.update',['id'=>$recRecipientsAnnouncementByID->id]) }}" method="post" enctype="multipart/form-data">
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
                            <label for="groups_announcement_id">Group Name <span class="kt-font-danger">*</span></label>
                            <select class="form-control col-4" name="groups_announcement_id" required="">
                                <option value="">-- choose one of them --</option>
                                @foreach ($recGroupsAnnouncement as $item)
                                    <option value="{{ $item->id }}"  {{ ($item->id==$recRecipientsAnnouncementByID->groups_announcement_id)?'selected':'' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Recipient Name <span class="kt-font-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ $recRecipientsAnnouncementByID->name }}" placeholder="Your Recipient Name" required="">
                        </div>
                        <div class="form-group">
                            <label>Email <span class="kt-font-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="{{ $recRecipientsAnnouncementByID->email }}" placeholder="Your Recipient Email" required="">
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

@endsection

