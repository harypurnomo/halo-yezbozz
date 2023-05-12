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
                <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Create a new</span>
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
                    <h3 class="kt-portlet__head-title">Form Create</h3>
                </div>
            </div>
            
            <div class="kt-portlet__body">

                <!--begin::Form-->
                <form class="kt-form" action="{{ route('master-product.store') }}" method="post" enctype="multipart/form-data">
                	{{ csrf_field() }}
                    <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
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
                                <a class="nav-link" id="tab-vendor" data-toggle="tab" href="#vendor" role="tab" aria-controls="Three" aria-selected="false">Vendor Relationship</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-seo" data-toggle="tab" href="#seo" role="tab" aria-controls="four" aria-selected="false">SEO</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active p-3" id="general" role="tabpanel" aria-labelledby="tab-general">
                                <div class="form-group">
                                    <label>Slug <span class="kt-font-danger">*</span></label>
                                    <input type="text" name="slug" id="slug" class="form-control" placeholder="Slug" value="{{ old('slug') }}" readonly="">
                                    <small>Automatically</small>
                                </div>

                                <div class="form-group">
                                    <label>{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} Title ID <span class="kt-font-danger">*</span></label>
                                    <input type="text" name="product_title_id" id="product_title_id" class="form-control" placeholder="Your {{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} Title" value="{{ old('product_title_id') }}" required="" minlength="3" maxlength="100">
                                    <span id="char-product_title_id">100</span> Character(s) Remaining
                                </div>

                                <div class="form-group">
                                    <label>{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} Brief ID</label>
                                    <textarea name="product_brief_id" id="product_brief_id" class="form-control" maxlength="140">{{ old('product_brief_id') }}</textarea>
                                    <span id="char-product_brief_id">140</span> Character(s) Remaining
                                </div>

                                <div class="form-group">
                                    <label>{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} Description ID</label>
                                    <textarea name="product_desc_id" id="product_desc_id" class="form-control summernote">{{ old('product_desc_id') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} External Link</label>
                                    <input type="text" name="external_link" class="form-control" placeholder="{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} External Link" value="{{ old('product_title_en') }}">
                                </div>

                                <div class="form-group">
                                    <label>Banner</label>
                                    <div class="col-4">
                                        <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar">
                                            <div class="kt-avatar__holder" style="background-image: url({{ asset('admin/template/client/noimage.png') }});"></div>
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
                                            <div class="kt-avatar__holder" style="background-image: url({{ asset('admin/template/client/noimage.png') }});"></div>
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
                                    <label>File Attachement</label>
                                    <input type="file" name="files" class="form-control file-uploads">
                                </div>

                                <div class="form-group">
                                    <label for="product_category_id">Product Category <span class="kt-font-danger">*</span></label>
                                    <select class="form-control" name="product_category_id" required="">
                                        <option value="">-- choose one of them --</option>
                                        @foreach ($recProductsCategory as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
        
                                <div class="form-group">
                                    <label for="is_active">Active <span class="kt-font-danger">*</span></label>
                                    <select class="form-control col-4" name="is_active" required="">
                                        <option value="">-- choose one of them --</option>
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="tab-pane fade p-3" id="optional" role="tabpanel" aria-labelledby="tab-optional">
                                <h4>Dual language</h4>
                                <div class="form-group">
                                    <label>{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} Title EN</label>
                                    <input type="text" name="product_title_en" id="product_title_en" class="form-control" placeholder="Your {{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} Title" value="{{ old('product_title_en') }}" minlength="3" maxlength="100">
                                    <span id="char-product_title_en">100</span> Character(s) Remaining
                                </div>

                                <div class="form-group">
                                    <label>{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} Brief EN</label>
                                    <textarea name="product_brief_en" id="product_brief_en" class="form-control" maxlength="140">{{ old('product_brief_en') }}</textarea>
                                    <span id="char-product_brief_en">140</span> Character(s) Remaining
                                </div>

                                <div class="form-group">
                                    <label>{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} Description EN</label>
                                    <textarea name="product_desc_en" id="product_desc_en" class="form-control summernote">{{ old('product_desc_en') }}</textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label for="is_active">Hot <span class="kt-font-danger">*</span></label>
                                    <select class="form-control col-4" name="is_hot" required="">
                                        <option value="">-- choose one of them --</option>
                                        <option value="1">Yes</option>
                                        <option value="0" selected>No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="tab-pane fade p-3" id="vendor" role="tabpanel" aria-labelledby="tab-optional">
                                <h4>Vendor Relationship</h4>
                                <div class="form-group">
                                    <label for="vendor_id">First Vendor</label>
                                    <select class="form-control col-4" name="vendor_id">
                                        <option value="">-- choose one of them --</option>
                                        @foreach ($recVendors as $key=>$value)
                                        <option value="{{ $value->id }}" selected>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Note</label>
                                    <input type="text" name="vendor_note" class="form-control" placeholder="{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} Note" value="{{ old('product_title_en') }}">
                                </div>

                                <div class="form-group">
                                    <label>External Link</label>
                                    <input type="text" name="vendor_external_link" class="form-control" placeholder="{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} External Link" value="{{ old('product_title_en') }}">
                                </div>

                                <div class="form-group">
                                    <label>Qty <span class="kt-font-danger">*</span></label>
                                    <input type="number" name="vendor_qty" class="form-control" required placeholder="Your {{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} Qty" value="{{ old('price') }}">
                                    <small>Default bernilai 1 | Jika produk yang dijual vendor dalam paket 1 CTN = 12 pcs, isi field ini dengan 12, dst.</small>
                                </div>

                                <div class="form-group">
                                    <label>Price <span class="kt-font-danger">*</span></label>
                                    <input type="text" name="vendor_price" class="form-control input-numeral" required placeholder="Your {{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} Price" value="{{ old('price') }}">
                                </div>

                                <div class="form-group">
                                    <label>Tax (in percent %)</label>
                                    <input type="text" name="vendor_tax" class="form-control tax" placeholder="Your {{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} Tax" value="{{ old('tax') }}">
                                </div>
                            </div>

                            <div class="tab-pane fade p-3" id="seo" role="tabpanel" aria-labelledby="tab-seo">
                                <div class="form-group">
                                    <label>SEO Title</label>
                                    <input type="text" name="seo_title" id="seo_title" class="form-control" placeholder="SEO Title" value="{{ old('seo_title') }}" maxlength="250">
                                </div>

                                <div class="form-group">
                                    <label>SEO Keyword</label>
                                    <input type="text" name="seo_keyword" id="seo_keyword" class="form-control" placeholder="SEO Keyword" value="{{ old('seo_keyword') }}" maxlength="250">
                                </div>

                                <div class="form-group">
                                    <label>SEO Description</label>
                                    <textarea name="seo_description" id="seo_description" class="form-control" maxlength="250">{{ old('seo_description') }}</textarea>
                                </div>
                            </div>
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

@endsection

