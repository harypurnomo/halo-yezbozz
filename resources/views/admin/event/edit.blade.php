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
                <a href="{{ route('master-event.index') }}" class="btn kt-subheader__btn-primary">Back To List &nbsp;</a>
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
                <form class="kt-form" action="{{ route('master-event.update',['id'=>$recEventByID->id]) }}" method="post" enctype="multipart/form-data">
                    {{method_field('PUT')}}
                    {{ csrf_field() }}
                    <input type="hidden" name="updated_by" value="{{ Auth::user()->id }}">
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
                            <label>Slug <span class="kt-font-danger">*</span></label>
                            <input type="text" name="slug" id="slug" class="form-control" placeholder="Slug" value="{{ $recEventByID->slug }}" readonly="">
                            <small>Automatically</small>
                        </div>
                        <div class="form-group">
                            <label>Event Title EN <span class="kt-font-danger">*</span></label>
                            <input type="text" name="event_title_en" id="event_title_en" class="form-control" placeholder="Your Event Title" value="{{ $recEventByID->event_title_en }}" required="" minlength="5" maxlength="80">
                        </div>
                        <div class="form-group">
                            <label>Event Title ID <span class="kt-font-danger">*</span></label>
                            <input type="text" name="event_title_id" class="form-control" placeholder="Your Event Title" value="{{ $recEventByID->event_title_id }}" required="" minlength="5" maxlength="80">
                        </div>

                        <div class="form-group">
                            <label>Event Brief EN <span class="kt-font-danger">*</span></label>
                            <textarea name="event_brief_en" id="event_brief_en" class="form-control" maxlength="140" required="">{{ $recEventByID->event_brief_en }}</textarea>
                            <span id="char-event_brief_en">140</span> Character(s) Remaining
                        </div>
                        <div class="form-group">
                            <label>Event Brief ID <span class="kt-font-danger">*</span></label>
                            <textarea name="event_brief_id" id="event_brief_id" class="form-control" maxlength="140" required="">{{ $recEventByID->event_brief_id }}</textarea>
                            <span id="char-event_brief_id">140</span> Character(s) Remaining
                        </div>

                        <div class="form-group">
                            <label>Event Description EN</label>
                            <textarea name="event_desc_en" id="event_desc_en" class="form-control summernote">{{ $recEventByID->event_desc_en }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Event Description ID</label>
                            <textarea name="event_desc_id" id="event_desc_id" class="form-control summernote">{{ $recEventByID->event_desc_id }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Banner</label>
                            <div class="col-4">
                                <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar">
                                    @if($recEventByID->banner=='')
                                    <div class="kt-avatar__holder" style="background-image: url({{ asset('admin/template/client/noimage.png') }});"></div>
                                    @else
                                    <div class="kt-avatar__holder" style="background-image: url({{ url('uploads/event/banner') }}/{{ $recEventByID->banner }})"></div>
                                    @endif
                                    <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change">
                                        <i class="fa fa-pen"></i>
                                        <input type="file" name="banner">
                                    </label>
                                    <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Remove">
                                        <i class="fa fa-times"></i>
                                    </span>
                                </div>
                            </div>
                            <small>The best size 641 x 401</small>
                        </div>
                        <div class="form-group">
                            <label>Thumbnail</label>
                            <div class="col-4">
                                <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar2">
                                    @if($recEventByID->thumb=='')
                                    <div class="kt-avatar__holder" style="background-image: url({{ asset('admin/template/client/noimage.png') }});"></div>
                                    @else
                                    <div class="kt-avatar__holder" style="background-image: url({{ url('uploads/event/thumb') }}/{{ $recEventByID->thumb }})"></div>
                                    @endif
                                    <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change">
                                        <i class="fa fa-pen"></i>
                                        <input type="file" name="thumb">
                                    </label>
                                    <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Remove">
                                        <i class="fa fa-times"></i>
                                    </span>
                                </div>
                            </div>
                            <small>The best size 415 x 275</small>
                        </div>

                        <div class="form-group">
                            <label for="event_category_id">Event Category <span class="kt-font-danger">*</span></label>
                            <select class="form-control col-4" name="event_category_id" required="">
                                <option value="">-- choose one of them --</option>
                                @foreach ($recEventsCategory as $item)
                                    <option value="{{ $item->id }}" {{ ($recEventByID->event_category_id==$item->id)?'selected':'' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>File Attachement</label><br>
                            @if($recEventByID->file_attachement=='')
                            <a href="javascript:;">Not Available</a>
                            @else
                            <a href="{{ url('uploads/event/file_attachement') }}/{{ $recEventByID->file_attachement }}" target="_blank">{{ $recEventByID->file_attachement }}</a>
                             <a href="javascript:;" style="float: right;" class="delete-file-link" data-link="{{ route('master.event.delete',['id'=>$recEventByID->id]) }}"><i class="fa fa-trash"></i> Remove file</a>
                            @endif
                            <input type="file" name="files" class="form-control file-uploads">
                        </div>

                        <div class="form-group">
                            <label for="is_active">Active <span class="kt-font-danger">*</span></label>
                            <select class="form-control col-4" name="is_active" required="">
                                <option value="">-- choose one of them --</option>
                                <option value="1" {{ ($recEventByID->is_active==1)?'selected':'' }}>Yes</option>
                                <option value="0" {{ ($recEventByID->is_active==0)?'selected':'' }}>No</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="is_active">Hot Event <span class="kt-font-danger">*</span></label>
                            <select class="form-control col-4" name="is_hot" required="">
                                <option value="">-- choose one of them --</option>
                                <option value="1" {{ ($recEventByID->is_hot==1)?'selected':'' }}>Yes</option>
                                <option value="0" {{ ($recEventByID->is_hot==0)?'selected':'' }}>No</option>
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
<script language="javascript" type="text/javascript">
$(function(){
    $("#event_title_en").keyup(function(){
        var Text = $(this).val();
        Text = Text.toLowerCase();
        Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
        $("#slug").val(Text);        
    });
});
</script>

<script language="javascript" type="text/javascript">
$(function(){
    var maxLength = 140;
    $('#event_brief_en').keyup(function() {
      var textlen = maxLength - $(this).val().length;
      $('#char-event_brief_en').text(textlen);
    });
});

$(function(){
    var maxLength = 140;
    $('#event_brief_id').keyup(function() {
      var textlen = maxLength - $(this).val().length;
      $('#char-event_brief_id').text(textlen);
    });
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    
    // enable fileuploader plugin
    $('input.file-uploads').fileuploader({
        limit: 1,
        fileMaxSize: 5,
        extensions: ["jpg", "jpeg", "pdf", "png"],
        disallowedExtensions: ["text/plain", "audio/*", "php", "php3", "php4", "php5"]
    });
    
});
</script>

<script type="text/javascript">
    $(document).on('click','.delete-file-link',function(){
        if(confirm('Are you sure ?')) {
            var link = $(this).attr('data-link');
            window.location.assign(link);
        }
    });
</script>
@endsection

