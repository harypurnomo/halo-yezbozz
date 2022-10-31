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
                <a href="{{ route('master-market.index') }}" class="btn kt-subheader__btn-primary">Back To List &nbsp;</a>
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
                <form class="kt-form" action="{{ route('master-market.update',['id'=>$recMarketByID->id]) }}" method="post" enctype="multipart/form-data">
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
                            <input type="text" name="slug" id="slug" class="form-control" placeholder="Slug" value="{{ $recMarketByID->slug }}" readonly="">
                            <small>Automatically</small>
                        </div>
                        <div class="form-group">
                            <label>Company Name <span class="kt-font-danger">*</span></label>
                            <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Your Company Name" value="{{ $recMarketByID->company_name }}" required="" minlength="5" maxlength="100">
                        </div>

                        <div class="form-group">
                            <label>Email <span class="kt-font-danger">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="Your Email" value="{{ $recMarketByID->email }}" required="" minlength="5" maxlength="100">
                        </div>

                        <div class="form-group">
                            <label>Phone Number <span class="kt-font-danger">*</span></label>
                            <input type="number" name="phone" class="form-control" placeholder="Your Phone Number" value="{{ $recMarketByID->phone }}" required="" minlength="8" maxlength="30">
                        </div>

                        <div class="form-group">
                            <label>Address <span class="kt-font-danger">*</span></label>
                            <textarea name="address" class="form-control" required="">{{ $recMarketByID->address }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Market Brief EN <span class="kt-font-danger">*</span></label>
                            <textarea name="market_brief_en" id="market_brief_en" class="form-control" maxlength="140" required="">{{ $recMarketByID->market_brief_en }}</textarea>
                            <span id="char-market_brief_en">140</span> Character(s) Remaining
                        </div>
                        <div class="form-group">
                            <label>Market Brief ID <span class="kt-font-danger">*</span></label>
                            <textarea name="market_brief_id" id="market_brief_id" class="form-control" maxlength="140" required="">{{ $recMarketByID->market_brief_id }}</textarea>
                            <span id="char-market_brief_id">140</span> Character(s) Remaining
                        </div>

                        <div class="form-group">
                            <label>Market Description EN</label>
                            <textarea name="market_desc_en" id="market_desc_en" class="form-control summernote">{{ $recMarketByID->market_desc_en }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Market Description ID</label>
                            <textarea name="market_desc_id" id="market_desc_id" class="form-control summernote">{{ $recMarketByID->market_desc_id }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Banner</label>
                            <div class="col-4">
                                <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar">
                                    @if($recMarketByID->banner=='')
                                    <div class="kt-avatar__holder" style="background-image: url({{ asset('admin/template/client/noimage.png') }});"></div>
                                    @else
                                    <div class="kt-avatar__holder" style="background-image: url({{ url('uploads/market/banner') }}/{{ $recMarketByID->banner }})"></div>
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
                            <label>Logo</label>
                            <div class="col-4">
                                <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar2">
                                    @if($recMarketByID->thumb=='')
                                    <div class="kt-avatar__holder" style="background-image: url({{ asset('admin/template/client/noimage.png') }});"></div>
                                    @else
                                    <div class="kt-avatar__holder" style="background-image: url({{ url('uploads/market/thumb') }}/{{ $recMarketByID->thumb }})"></div>
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
                            <label for="article_category_id">Market Category <span class="kt-font-danger">*</span></label>
                            <select class="form-control col-4" name="market_category_id" required="">
                                <option value="">-- choose one of them --</option>
                                @foreach ($recMarketCategory as $item)
                                    <option value="{{ $item->id }}" {{ ($recMarketByID->market_category_id==$item->id)?'selected':'' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>File Attachement</label><br>
                            @if($recMarketByID->file_attachement=='')
                            <a href="javascript:;">Not Available</a>
                            @else
                            <a href="{{ url('uploads/market/file_attachement') }}/{{ $recMarketByID->file_attachement }}" target="_blank">{{ $recMarketByID->file_attachement }}</a>
                            <a href="javascript:;" style="float: right;" class="delete-file-link" data-link="{{ route('master.market.delete',['id'=>$recMarketByID->id]) }}"><i class="fa fa-trash"></i> Remove file</a>
                            @endif
                            <input type="file" name="files" class="form-control file-uploads">
                        </div>

                        <div class="form-group">
                            <label for="is_active">Active <span class="kt-font-danger">*</span></label>
                            <select class="form-control col-4" name="is_active" required="">
                                <option value="">-- choose one of them --</option>
                                <option value="1" {{ ($recMarketByID->is_active==1)?'selected':'' }}>Yes</option>
                                <option value="0" {{ ($recMarketByID->is_active==0)?'selected':'' }}>No</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="is_active">Hot Market <span class="kt-font-danger">*</span></label>
                            <select class="form-control col-4" name="is_hot" required="">
                                <option value="">-- choose one of them --</option>
                                <option value="1" {{ ($recMarketByID->is_hot==1)?'selected':'' }}>Yes</option>
                                <option value="0" {{ ($recMarketByID->is_hot==0)?'selected':'' }}>No</option>
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
    $("#company_name").keyup(function(){
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
    $('#market_brief_en').keyup(function() {
      var textlen = maxLength - $(this).val().length;
      $('#char-market_brief_en').text(textlen);
    });
});

$(function(){
    var maxLength = 140;
    $('#market_brief_id').keyup(function() {
      var textlen = maxLength - $(this).val().length;
      $('#char-market_brief_id').text(textlen);
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

