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
                <a href="{{ route('master-vendor.index') }}" class="btn kt-subheader__btn-primary">Back To List &nbsp;</a>
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
                <form class="kt-form" action="{{ route('master-vendor.update',['id'=>$recVendorsByID->id]) }}" method="post" enctype="multipart/form-data">
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
                                <a class="nav-link" id="tab-history" data-toggle="tab" href="#history" role="tab" aria-controls="Three" aria-selected="false">Orders History</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-contact" data-toggle="tab" href="#contact" role="tab" aria-controls="Three" aria-selected="false">Contact Person</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active p-3" id="general" role="tabpanel" aria-labelledby="tab-general">
                                <div class="form-group">
                                    <label>Slug <span class="kt-font-danger">*</span></label>
                                    <input type="text" name="slug" id="slug" class="form-control" placeholder="Slug" value="{{ $recVendorsByID->slug }}" readonly="">
                                    <small>Automatically</small>
                                </div>
                                <div class="form-group">
                                    <label>Name <span class="kt-font-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} Name" value="{{ $recVendorsByID->name }}" required="" minlength="3" maxlength="100">
                                    <span id="char-name">100</span> Character(s) Remaining
                                </div>
                                <div class="form-group">
                                    <label>Email </label>
                                    <input type="email" name="email" class="form-control " placeholder="{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} Email" value="{{ $recVendorsByID->email }}">
                                </div>
                                <div class="form-group">
                                    <label>Phone Number </label>
                                    <input type="number" class="form-control" name="phone" value="{{ $recVendorsByID->phone }}" placeholder="{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} Phone Number" minlength="8" maxlength="30">
                                </div>
                                <div class="form-group">
                                    <label>{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} Address</label>
                                    <textarea name="address" class="form-control summernote">{!! $recVendorsByID->address !!}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="is_active">Vendor Category <span class="kt-font-danger">*</span></label>
                                    <select class="form-control col-4" name="is_category" required="">
                                        <option value="">-- choose one of them --</option>
                                        <option value="barang" {{ ($recVendorsByID->is_category=="barang")?'selected':'' }}>Barang</option>
                                        <option value="jasa" {{ ($recVendorsByID->is_category=="jasa")?'selected':'' }}>Jasa</option>
                                        <option value="barang jasa" {{ ($recVendorsByID->is_category=="barang jasa")?'selected':'' }}>Barang Jasa</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="is_active">Vendor Type of Location <span class="kt-font-danger">*</span></label>
                                    <select class="form-control col-4" name="is_location" required="">
                                        <option value="">-- choose one of them --</option>
                                        <option value="online store" {{ ($recVendorsByID->is_location=="online store")?'selected':'' }}>Online Store</option>
                                        <option value="offline store" {{ ($recVendorsByID->is_location=="offline store")?'selected':'' }}>Offline Store</option>
                                        <option value="online offline store" {{ ($recVendorsByID->is_location=="online offline store")?'selected':'' }}>Online & Offline Store</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Banner</label>
                                    <div class="col-4">
                                        <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar">
                                            @if($recVendorsByID->banner=='')
                                            <div class="kt-avatar__holder" style="background-image: url({{ asset('admin/template/client/noimage.png') }});"></div>
                                            @else
                                            <div class="kt-avatar__holder" style="background-image: url({{ url('uploads/vendor/banner') }}/{{ $recVendorsByID->banner }})"></div>
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
                                            @if($recVendorsByID->thumb=='')
                                            <div class="kt-avatar__holder" style="background-image: url({{ asset('admin/template/client/noimage.png') }});"></div>
                                            @else
                                            <div class="kt-avatar__holder" style="background-image: url({{ url('uploads/vendor/thumb') }}/{{ $recVendorsByID->thumb }})"></div>
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
                                    <label for="is_active">Active <span class="kt-font-danger">*</span></label>
                                    <select class="form-control col-4" name="is_active" required="">
                                        <option value="1" {{ ($recVendorsByID->is_active==1)?'selected':'' }}>Yes</option>
                                        <option value="0" {{ ($recVendorsByID->is_active==0)?'selected':'' }}>No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="tab-pane fade p-3" id="optional" role="tabpanel" aria-labelledby="tab-optional">
                                <div class="form-group">
                                    <label>External Link</label>
                                    <input type="text" name="external_link" class="form-control" placeholder="Your External Link" value="{{ $recVendorsByID->external_link }}">
                                </div>
                                <div class="form-group">
                                    <label>Locations With Coordinate </label>
                                    <input type="text" name="coordinate" class="form-control" placeholder="{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} Locations With Coordinate" value="{{ $recVendorsByID->coordinate }}">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control summernote">{!! $recVendorsByID->description !!}</textarea>
                                    <small>If you have notes for this vendor.</small>
                                </div>
                                <div class="form-group">
                                    <label>File Attachement</label><br>
                                    @if($recVendorsByID->file_attachement=='')
                                    <a href="javascript:;">Not Available</a>
                                    @else
                                    <a href="{{ url('uploads/vendor/file_attachement') }}/{{ $recVendorsByID->file_attachement }}" target="_blank">{{ $recVendorsByID->file_attachement }}</a>
                                    <a href="javascript:;" style="float: right;" class="delete-file-link" data-link="{{ route('master.vendor.delete',['id'=>$recVendorsByID->id]) }}"><i class="fa fa-trash"></i> Remove file</a>
                                    @endif
                                    <input type="file" name="files" class="form-control file-uploads">
                                </div>
                            </div>

                            <div class="tab-pane fade p-3" id="seo" role="tabpanel" aria-labelledby="tab-seo">
                                <div class="form-group">
                                    <label>SEO Title</label>
                                    <input type="text" name="seo_title" id="seo_title" class="form-control" placeholder="SEO Title" value="{{ $recVendorsByID->seo_title }}" maxlength="250">
                                </div>

                                <div class="form-group">
                                    <label>SEO Keyword</label>
                                    <input type="text" name="seo_keyword" id="seo_keyword" class="form-control" placeholder="SEO Keyword" value="{{ $recVendorsByID->seo_keyword }}" maxlength="250">
                                </div>

                                <div class="form-group">
                                    <label>SEO Description</label>
                                    <textarea name="seo_description" id="seo_description" class="form-control" maxlength="250">{{ $recVendorsByID->seo_description }}</textarea>
                                </div>
                            </div>

                            <div class="tab-pane fade p-3" id="history" role="tabpanel" aria-labelledby="tab-history">
                                <a href="{{ route('master-vendor-order.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                    <i class="la la-plus"></i> Upload your files
                                </a>
                                <br><br>
                                <!--begin: Datatable -->
                                <table class="table table-striped- table-bordered table-hover table-checkable simple-datatable">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Files</th>
                                            <th>Last Updated</th>
                                        </tr>
                                    </thead>                   
                                    <tbody>
                                        @foreach ($recVendorsOrderHistoryByVendorID as $index => $row)
                                        <tr>
                                            <td>{{ $row->name }}</td>
                                            <td><a href="{{ url('uploads/vendor/order') }}/{{ $row->file_attachement }}" target="_blank">{{ $row->file_attachement }}</a></td>
                                            <td>{{ date_format(date_create($row->updated_at),"d M Y H:i:s") }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>                    
                                </table>
                                <!--end: Datatable -->
                            </div>

                            <div class="tab-pane fade p-3" id="contact" role="tabpanel" aria-labelledby="tab-contact">
                                <a href="{{ route('master-vendor-contact.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                    <i class="la la-plus"></i> Create new contact
                                </a>
                                <br><br>
                                <table class="table table-striped- table-bordered table-hover table-checkable simple-datatable">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Avatar</th>
                                            <th>KTP</th>
                                            <th>Last Updated</th>
                                        </tr>
                                    </thead>                   
                                    <tbody>
                                        @foreach ($recVendorContactPersonByVendorID as $index => $row)
                                        <tr>
                                            <td>{{ strtoupper($row->name) }}</td>
                                            <td>{{ strtoupper($row->position) }}</td>
                                            <td>{{ $row->email }}</td>
                                            <td>{{ $row->phone }}</td>
                                            <td><a href="{{ url('uploads/vendor/contact/avatar') }}/{{ $row->avatar }}" target="_blank">{{ $row->avatar }}</a></td>
                                            <td><a href="{{ url('uploads/vendor/contact/ktp') }}/{{ $row->ktp }}" target="_blank">{{ $row->ktp }}</a></td>
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

    <script language="javascript" type="text/javascript">
    $(function(){
        $("#name").keyup(function(){
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
        $('#name').keyup(function() {
          var textlen = maxLength - $(this).val().length;
          $('#char-name').text(textlen);
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
    $(document).on('click','.delete-file-link',function(){
        if(confirm('Are you sure ?')) {
            var link = $(this).attr('data-link');
            window.location.assign(link);
        }
    });
    </script>

@endsection

