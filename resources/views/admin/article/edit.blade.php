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
                <a href="{{ route('master-article.index') }}" class="btn kt-subheader__btn-primary">Back To List &nbsp;</a>
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
                    <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="tab-general" data-toggle="tab" href="#general" role="tab" aria-controls="One" aria-selected="true">General</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-optional" data-toggle="tab" href="#optional" role="tab" aria-controls="Two" aria-selected="false">Optional</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-seo" data-toggle="tab" href="#seo" role="tab" aria-controls="Three" aria-selected="false">SEO</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active p-3" id="general" role="tabpanel" aria-labelledby="tab-general">
                            <!--begin::Form-->
                            <form class="kt-form" action="{{ route('master-article.update',['id'=>$recArticleByID->id]) }}" method="post" enctype="multipart/form-data">
                                {{method_field('PUT')}}
                                {{ csrf_field() }}
                                <input type="hidden" name="updated_by" value="{{ Auth::user()->id }}">

                                <div class="form-group">
                                    <label>Slug <span class="kt-font-danger">*</span></label>
                                    <input type="text" name="slug" id="slug" class="form-control" placeholder="Slug" value="{{ $recArticleByID->slug }}" readonly="">
                                    <small>Automatically</small>
                                </div>
                                <div class="form-group">
                                    <label>Article Title ID <span class="kt-font-danger">*</span></label>
                                    <input type="text" id="article_title_id" name="article_title_id" class="form-control" placeholder="Your Article Title" value="{{ $recArticleByID->article_title_id }}" required="" minlength="5" maxlength="100">
                                </div>
                                <div class="form-group">
                                    <label>Article Brief ID <span class="kt-font-danger">*</span></label>
                                    <textarea name="article_brief_id" id="article_brief_id" class="form-control" maxlength="140" required="">{{ $recArticleByID->article_brief_id }}</textarea>
                                    <span id="char-article_brief_id">140</span> Character(s) Remaining
                                </div>
                                <div class="form-group">
                                    <label>Article Description ID</label>
                                    <textarea name="article_desc_id" id="article_desc_id" class="form-control summernote">{{ $recArticleByID->article_desc_id }}</textarea>
                                </div>
        
                                <div class="form-group">
                                    <label>Banner</label>
                                    <div class="col-4">
                                        <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar">
                                            @if($recArticleByID->banner=='')
                                            <div class="kt-avatar__holder" style="background-image: url({{ asset('admin/template/client/noimage.png') }});"></div>
                                            @else
                                            <div class="kt-avatar__holder" style="background-image: url({{ url('uploads/article/banner') }}/{{ $recArticleByID->banner }})"></div>
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
                                            @if($recArticleByID->thumb=='')
                                            <div class="kt-avatar__holder" style="background-image: url({{ asset('admin/template/client/noimage.png') }});"></div>
                                            @else
                                            <div class="kt-avatar__holder" style="background-image: url({{ url('uploads/article/thumb') }}/{{ $recArticleByID->thumb }})"></div>
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
                                    <label for="article_category_id">Article Category <span class="kt-font-danger">*</span></label>
                                    <select class="form-control col-4" name="article_category_id" required="">
                                        <option value="">-- choose one of them --</option>
                                        @foreach ($recArticlesCategory as $item)
                                            <option value="{{ $item->id }}" {{ ($recArticleByID->article_category_id==$item->id)?'selected':'' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
        
                                {{-- delete-link" data-id="{{ $row->id }}" data-link="administrator/master-article" --}}
        
                                <div class="form-group">
                                    <label>File Attachement</label><br>
                                    @if($recArticleByID->file_attachement=='')
                                    <a href="javascript:;">Not Available</a>
                                    @else
                                    <a href="{{ url('uploads/article/file_attachement') }}/{{ $recArticleByID->file_attachement }}" target="_blank">{{ $recArticleByID->file_attachement }}</a> 
                                    <a href="javascript:;" style="float: right;" class="delete-file-link" data-link="{{ route('master.article.delete',['id'=>$recArticleByID->id]) }}"><i class="fa fa-trash"></i> Remove file</a>
                                    @endif
                                    <input type="file" name="files" class="form-control file-uploads">
                                </div>
        
                                <div class="form-group">
                                    <label for="is_active">Active <span class="kt-font-danger">*</span></label>
                                    <select class="form-control col-4" name="is_active" required="">
                                        <option value="">-- choose one of them --</option>
                                        <option value="1" {{ ($recArticleByID->is_active==1)?'selected':'' }}>Yes</option>
                                        <option value="0" {{ ($recArticleByID->is_active==0)?'selected':'' }}>No</option>
                                    </select>
                                </div>
        
                                <div class="form-group">
                                    <label for="is_active">Hot <span class="kt-font-danger">*</span></label>
                                    <select class="form-control col-4" name="is_hot" required="">
                                        <option value="">-- choose one of them --</option>
                                        <option value="1" {{ ($recArticleByID->is_hot==1)?'selected':'' }}>Yes</option>
                                        <option value="0" {{ ($recArticleByID->is_hot==0)?'selected':'' }}>No</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-arrow-alt-circle-up"></i> Update</button>&nbsp;
                                    <button type="reset" class="btn btn-secondary"><i class="fa fa-history"></i> Reset</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade p-3" id="optional" role="tabpanel" aria-labelledby="tab-optional">
                            <form class="kt-form" action="{{ route('update.article.optional') }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="updated_by" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="article_id" value="{{ $recArticleByID->id }}">
                                <div class="form-group">
                                    <label>Article Title EN</label>
                                    <input type="text" name="article_title_en" id="article_title_en" class="form-control" placeholder="Your Article Title" value="{{ $recArticleByID->article_title_en }}" maxlength="100">
                                </div>
                                <div class="form-group">
                                    <label>Article Brief EN</label>
                                    <textarea name="article_brief_en" id="article_brief_en" class="form-control" maxlength="140">{{ $recArticleByID->article_brief_en }}</textarea>
                                    <span id="char-article_brief_en">140</span> Character(s) Remaining
                                </div>
                                <div class="form-group">
                                    <label>Article Description EN</label>
                                    <textarea name="article_desc_en" id="article_desc_en" class="form-control summernote">{{ $recArticleByID->article_desc_en }}</textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-arrow-alt-circle-up"></i> Update</button>&nbsp;
                                    <button type="reset" class="btn btn-secondary"><i class="fa fa-history"></i> Reset</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade p-3" id="seo" role="tabpanel" aria-labelledby="tab-seo">
                            <form class="kt-form" action="{{ route('update.article.seo') }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="updated_by" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="article_id" value="{{ $recArticleByID->id }}">
                                <div class="form-group">
                                    <label>SEO Title</label>
                                    <input type="text" name="seo_title" id="seo_title" class="form-control" placeholder="SEO Title" value="{{ $recArticleByID->seo_title }}" maxlength="250">
                                </div>
                                <div class="form-group">
                                    <label>SEO Keyword</label>
                                    <input type="text" name="seo_keyword" id="seo_keyword" class="form-control" placeholder="SEO Keyword" value="{{ $recArticleByID->seo_keyword }}" maxlength="250">
                                </div>
                                <div class="form-group">
                                    <label>SEO Description</label>
                                    <textarea name="seo_description" id="seo_description" class="form-control" maxlength="250">{!! $recArticleByID->seo_description  !!}</textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-arrow-alt-circle-up"></i> Update</button>&nbsp;
                                    <button type="reset" class="btn btn-secondary"><i class="fa fa-history"></i> Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script language="javascript" type="text/javascript">
$(function(){
    $("#article_title_id").keyup(function(){
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
    $('#article_brief_en').keyup(function() {
      var textlen = maxLength - $(this).val().length;
      $('#char-article_brief_en').text(textlen);
    });
});

$(function(){
    var maxLength = 140;
    $('#article_brief_id').keyup(function() {
      var textlen = maxLength - $(this).val().length;
      $('#char-article_brief_id').text(textlen);
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

    @if(Session::has('article-tab'))
    $('#tab-optional').trigger('click');
    @endif
    @if(Session::has('seo-tab'))
    $('#tab-seo').trigger('click');
    @endif
    
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

