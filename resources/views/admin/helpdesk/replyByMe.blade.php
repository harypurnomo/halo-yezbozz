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
                <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Reply message</span>
            </div>
        </div>

        <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">
                <a href="{{ route('open-ticket-by-me.show',['id'=>base64_encode($recHelpdeskById->id)]) }}" class="btn kt-subheader__btn-primary">Back&nbsp;</a>
            </div>
        </div>
    </div>
</div>
<!-- end:: Content Head -->  

{{-- {{ dd($recHelpdeskById) }}                --}}

<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon-more"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">Form Reply</h3>
                </div>
            </div>

            {{-- {{ dd($recHelpdeskById) }} --}}
            
            <div class="kt-portlet__body">

                <!--begin::Form-->
                <form class="kt-form" action="{{ route('open-ticket-by-me.update',['id'=>$recHelpdeskById->id]) }}" method="post" enctype="multipart/form-data">
                    {{method_field('PUT')}}
                    {{ csrf_field() }}
                    <input type="hidden" name="helpdesk_category_id" value="{{ $recHelpdeskById->helpdesk_category_id }}">
                    <input type="hidden" name="helpdesk_priority_id" value="{{ $recHelpdeskById->helpdesk_priority_id }}">
                    <input type="hidden" name="sender_user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="sender_name" value="{{ Auth::user()->name }}">
                    <input type="hidden" name="sender_email" value="{{ Auth::user()->email }}">
                    
                    <input type="hidden" name="receiver_user_id" value="{{ $recHelpdeskById->receiver_user_id }}">
                    <input type="hidden" name="receiver_name" value="{{ $recHelpdeskById->receiver_name }}">
                    <input type="hidden" name="receiver_email" value="{{ $recHelpdeskById->receiver_email }}">
                    <input type="hidden" name="uuid" value="{{ $recHelpdeskById->uuid }}">
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
                            <label>Message <span class="kt-font-danger">*</span></label>
                            <textarea name="message" id="message" class="form-control" maxlength="250" required="">{{ old('message') }}</textarea>
                            <span id="char-message">250</span> Character(s) Remaining
                        </div>

                        <div class="form-group">
                            <label>File Attachement</label>
                            <input type="file" name="files" class="form-control">
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
<script language="javascript" type="text/javascript">
$(function(){
    var maxLength = 250;
    $('#message').keyup(function() {
      var textlen = maxLength - $(this).val().length;
      $('#char-message').text(textlen);
    });
});
</script>
@endsection

