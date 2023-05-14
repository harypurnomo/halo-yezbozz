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
                <a href="{{ route('master-vendor-product-price.index') }}" class="btn kt-subheader__btn-primary">Back To List &nbsp;</a>
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
                <form class="kt-form" action="{{ route('master-vendor-product-price.store') }}" method="post" enctype="multipart/form-data">
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
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active p-3" id="general" role="tabpanel" aria-labelledby="tab-general">
                                <div class="form-group">
                                    <label for="product_id">Products <span class="kt-font-danger">*</span></label>
                                    <select class="form-control col-4 kt-select2-general" name="product_id" required="">
                                        <option value="">-- choose one of them --</option>
                                        @foreach ($recProducts as $item)
                                        <option value="{{ $item->id }}">{{ $item->product_title_id }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="vendor_id">Vendors <span class="kt-font-danger">*</span></label>
                                    <select class="form-control col-4 kt-select2-general" name="vendor_id" required="">
                                        <option value="">-- choose one of them --</option>
                                        @foreach ($recVendor as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Note <span class="kt-font-danger">*</span></label>
                                    <input type="text" name="note" id="name" class="form-control" placeholder="{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} Note" value="{{ old('note') }}" required="" minlength="3" maxlength="100">
                                    <span id="char-name">100</span> Character(s) Remaining
                                </div>
                                <div class="form-group">
                                    <label>External Link</label>
                                    <input type="text" name="external_link" class="form-control" placeholder="Your External Link" value="{{ old('external_link') }}">
                                </div>
                                                            
                                <div class="form-group">
                                    <label>Qty <span class="kt-font-danger">*</span></label>
                                    <input type="number" name="qty" class="form-control" required placeholder="Your {{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} Qty" value="{{ old('qty') }}">
                                    <small>Default bernilai 1 | Jika produk yang dijual vendor dalam paket 1 CTN = 12 pcs, isi field ini dengan 12, dst.</small>
                                </div>
                            
                                <div class="form-group">
                                    <label>Price <span class="kt-font-danger">*</span></label>
                                    <input type="text" name="price" class="form-control input-numeral" required placeholder="Your {{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} Price" value="{{ old('price') }}">
                                </div>
                            
                                <div class="form-group">
                                    <label>Tax (in percent %)</label>
                                    <input type="text" name="tax" class="form-control tax" placeholder="Your {{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} Tax" value="{{ old('tax') }}">
                                </div>

                                <div class="form-group">
                                    <label for="recommended">Recommended <span class="kt-font-danger">*</span></label>
                                    <select class="form-control col-4" name="recommended" required="">
                                        <option value="">-- choose one of them --</option>
                                        @for($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>    
                                        @endfor
                                    </select>
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
        var maxLength = 100;
        $('#name').keyup(function() {
        var textlen = maxLength - $(this).val().length;
        $('#char-name').text(textlen);
        });
    });
    </script>

@endsection

