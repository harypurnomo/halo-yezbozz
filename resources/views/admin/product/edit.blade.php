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
                <a href="{{ route('master-product.index') }}" class="btn kt-subheader__btn-primary">Back To List &nbsp;</a>
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
                <form class="kt-form" action="{{ route('master-product.update',['id'=>$recProductsByID->id]) }}" method="post" enctype="multipart/form-data">
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
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tab-general" data-toggle="tab" href="#general" role="tab" aria-controls="One" aria-selected="true">General</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-optional" data-toggle="tab" href="#optional" role="tab" aria-controls="Two" aria-selected="false">Optional</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-seo" data-toggle="tab" href="#seo" role="tab" aria-controls="Three" aria-selected="false">SEO</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-vendor" data-toggle="tab" href="#vendor" role="tab" aria-controls="Four" aria-selected="false">Vendor</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active p-3" id="general" role="tabpanel" aria-labelledby="tab-general">
                                <div class="form-group">
                                    <label>Slug <span class="kt-font-danger">*</span></label>
                                    <input type="text" name="slug" id="slug" class="form-control" placeholder="Slug" value="{{ $recProductsByID->slug }}" readonly="">
                                    <small>Automatically</small>
                                </div>
                        
                                <div class="form-group">
                                    <label>{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} Title ID <span class="kt-font-danger">*</span></label>
                                    <input type="text" name="product_title_id" id="product_title_id" class="form-control" placeholder="Your {{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} Title" value="{{ $recProductsByID->product_title_id }}" required="" minlength="3" maxlength="80">
                                    <span id="char-product_title_id">100</span> Character(s) Remaining
                                </div>

                                <div class="form-group">
                                    <label>{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} Brief ID</label>
                                    <textarea name="product_brief_id" id="product_brief_id" class="form-control" maxlength="140">{{ $recProductsByID->product_brief_id }}</textarea>
                                    <span id="char-product_brief_id">140</span> Character(s) Remaining
                                </div>

                                <div class="form-group">
                                    <label>{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} Description ID</label>
                                    <textarea name="product_desc_id" id="product_desc_id" class="form-control summernote">{{ $recProductsByID->product_desc_id }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Banner</label>
                                    <div class="col-4">
                                        <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar">
                                            @if($recProductsByID->banner=='')
                                            <div class="kt-avatar__holder" style="background-image: url({{ asset('admin/template/client/noimage.png') }});"></div>
                                            @else
                                            <div class="kt-avatar__holder" style="background-image: url({{ url('uploads/product/banner') }}/{{ $recProductsByID->banner }})"></div>
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
                                            @if($recProductsByID->thumb=='')
                                            <div class="kt-avatar__holder" style="background-image: url({{ asset('admin/template/client/noimage.png') }});"></div>
                                            @else
                                            <div class="kt-avatar__holder" style="background-image: url({{ url('uploads/product/thumb') }}/{{ $recProductsByID->thumb }})"></div>
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
                                    <label for="product_category_id">Product Category <span class="kt-font-danger">*</span></label>
                                    <select class="form-control" name="product_category_id" required="">
                                        <option value="">-- choose one of them --</option>
                                        @foreach ($recProductsCategory as $item)
                                            <option value="{{ $item->id }}" {{ ($recProductsByID->product_category_id==$item->id)?'selected':'' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
        
                                <div class="form-group">
                                    <label for="is_active">Active <span class="kt-font-danger">*</span></label>
                                    <select class="form-control col-4" name="is_active" required="">
                                        <option value="">-- choose one of them --</option>
                                        <option value="1" {{ ($recProductsByID->is_active==1)?'selected':'' }}>Yes</option>
                                        <option value="0" {{ ($recProductsByID->is_active==0)?'selected':'' }}>No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="tab-pane fade p-3" id="optional" role="tabpanel" aria-labelledby="tab-optional">
                                <h4>Dual language</h4>
                                <div class="form-group">
                                    <label>{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} Title EN</label>
                                    <input type="text" name="product_title_en" id="product_title_en" class="form-control" placeholder="Your {{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} Title" value="{{ $recProductsByID->product_title_en }}" minlength="3" maxlength="100">
                                    <span id="char-product_title_en">100</span> Character(s) Remaining
                                </div>

                                <div class="form-group">
                                    <label>{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} Brief EN</label>
                                    <textarea name="product_brief_en" id="product_brief_en" class="form-control" maxlength="140">{{ $recProductsByID->product_brief_en }}</textarea>
                                    <span id="char-product_brief_en">140</span> Character(s) Remaining
                                </div>

                                <div class="form-group">
                                    <label>{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} Description EN</label>
                                    <textarea name="product_desc_en" id="product_desc_en" class="form-control summernote">{{ $recProductsByID->product_desc_en }}</textarea>
                                </div>
                                <h4>Add Ons</h4>
                                <div class="form-group">
                                    <label>{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} External Link</label>
                                    <input type="text" name="external_link" class="form-control" placeholder="{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} External Link" value="{{ $recProductsByID->external_link }}">
                                </div>

                                <div class="form-group">
                                    <label>File Attachement</label><br>
                                    @if($recProductsByID->file_attachement=='')
                                    <a href="javascript:;">Not Available</a>
                                    @else
                                    <a href="{{ url('uploads/product/file_attachement') }}/{{ $recProductsByID->file_attachement }}" target="_blank">{{ $recProductsByID->file_attachement }}</a>
                                     <a href="javascript:;" style="float: right;" class="delete-file-link" data-link="{{ route('master.product.delete',['id'=>$recProductsByID->id]) }}"><i class="fa fa-trash"></i> Remove file</a>
                                    @endif
                                    <input type="file" name="files" class="form-control file-uploads">
                                </div>
                                
                                <div class="form-group">
                                    <label for="is_active">Hot <span class="kt-font-danger">*</span></label>
                                    <select class="form-control col-4" name="is_hot" required="">
                                        <option value="">-- choose one of them --</option>
                                        <option value="1" {{ ($recProductsByID->is_hot==1)?'selected':'' }}>Yes</option>
                                        <option value="0" {{ ($recProductsByID->is_hot==0)?'selected':'' }}>No</option>
                                    </select>
                                </div>
                            </div>
                        
                            <div class="tab-pane fade p-3" id="seo" role="tabpanel" aria-labelledby="tab-seo">
                                <div class="form-group">
                                    <label>SEO Title</label>
                                    <input type="text" name="seo_title" id="seo_title" class="form-control" placeholder="SEO Title" value="{{ $recProductsByID->seo_title }}" maxlength="250">
                                </div>

                                <div class="form-group">
                                    <label>SEO Keyword</label>
                                    <input type="text" name="seo_keyword" id="seo_keyword" class="form-control" placeholder="SEO Keyword" value="{{ $recProductsByID->seo_keyword }}" maxlength="250">
                                </div>

                                <div class="form-group">
                                    <label>SEO Description</label>
                                    <textarea name="seo_description" id="seo_description" class="form-control" maxlength="250">{{ $recProductsByID->seo_description }}</textarea>
                                </div>
                            </div>

                            <div class="tab-pane fade p-3" id="vendor" role="tabpanel" aria-labelledby="tab-optional">
                                <a href="{{ route('master-vendor-product-price.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                    <i class="la la-plus"></i> Create new contact
                                </a>
                                <br><br>
                                <table class="table table-striped- table-bordered table-hover table-checkable simple-datatable">
                                    <thead>
                                        <tr>
                                            <th>Note</th>
                                            <th>External Link</th>
                                            <th>Price Include Tax</th>
                                            <th>Recommended</th>
                                            <th>Vendor Name</th>
                                            <th>Last Updated</th>
                                        </tr>
                                    </thead>                   
                                    <tbody>
                                        @foreach ($recVendorProductsPriceByProductID as $index => $row)
                                        <tr>
                                            <td><a href="{{ route('master-vendor-product-price.edit',['id'=>$row->id]) }}">{{ strtoupper($row->note) }}</a></td>
                                            <td>{{ $row->external_link }}</td>
                                            <td>{{ number_format($row->final_price,0,',','.') }}</td>
                                            <td>{{ $row->recommended }}</td>
                                            <td>{{ $row->vendor_name }}</td>
                                            <td>{{ date_format(date_create($row->updated_at),"d M Y H:i:s") }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>                    
                                </table>
                            </div>

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
    $("#product_title_id").keyup(function(){
        var Text = $(this).val();
        Text = Text.toLowerCase();
        Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
        $("#slug").val(Text);        
    });
});
</script>

<script language="javascript" type="text/javascript">
$(function(){
    var maxLength = 100;
    $('#product_title_id').keyup(function() {
      var textlen = maxLength - $(this).val().length;
      $('#char-product_title_id').text(textlen);
    });
});

$(function(){
    var maxLength = 100;
    $('#product_title_en').keyup(function() {
      var textlen = maxLength - $(this).val().length;
      $('#char-product_title_en').text(textlen);
    });
});

$(function(){
    var maxLength = 140;
    $('#product_brief_en').keyup(function() {
      var textlen = maxLength - $(this).val().length;
      $('#char-product_brief_en').text(textlen);
    });
});

$(function(){
    var maxLength = 140;
    $('#product_brief_id').keyup(function() {
      var textlen = maxLength - $(this).val().length;
      $('#char-product_brief_id').text(textlen);
    });
});
</script>

<script type="text/javascript" src="https://nosir.github.io/cleave.js/dist/cleave.min.js"></script>

<script type="text/javascript">
    $(function(){
        // numeral
        var cleaveNumeral = new Cleave('.input-numeral', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand',
            numeralIntegerScale: 15,
            numeralDecimalMark: ',',
            delimiter: '.'
        });
    });
</script>

<script type="text/javascript">
    $(function(){
        // numeral
        var cleaveNumeralTax = new Cleave('.tax', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand',
            numeralIntegerScale: 2,
            numeralDecimalMark: ',',
            delimiter: '.'
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

