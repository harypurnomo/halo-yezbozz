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
                <a href="{{ route('master-tenant.index') }}" class="btn kt-subheader__btn-primary">Back To List &nbsp;</a>
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
                            <a class="nav-link" id="tab-general" data-toggle="tab" href="#general-info" role="tab" aria-controls="One" aria-selected="true">General</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-optional" data-toggle="tab" href="#optional-info" role="tab" aria-controls="Two" aria-selected="false">Optional</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active p-3" id="general-info" role="tabpanel" aria-labelledby="tab-general">
                            <form class="kt-form" action="{{ route('master-tenant.update',['id'=>$recTenantsByID->id]) }}" method="post" enctype="multipart/form-data">
                                {{method_field('PUT')}}
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} <span class="kt-font-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" placeholder="{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }}" value="{{ $recTenantsByID->name }}" required="" minlength="5" maxlength="100">
                                </div>
        
                                <div class="form-group">
                                    <label for="is_active">Category of {{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }} <span class="kt-font-danger">*</span></label>
                                    <select class="form-control col-4" name="tenant_type_id" required="">
                                        <option value="">-- choose one of them --</option>
                                        @foreach ($recTenantsType as $element)
                                                <option value="{{ $element->id }}" {{ ($recTenantsByID->tenant_type_id==$element->id)?'selected':'' }}>{{ $element->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
        
                                <div class="form-group">
                                    <label>Logo/Picture {{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }}</label>
                                    <div class="col-4">
                                        <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar">
                                            @if($recTenantsByID->picture=='')
                                            <div class="kt-avatar__holder" style="background-image: url({{ asset('admin/template/client/noimage.png') }});"></div>
                                            @else
                                            <div class="kt-avatar__holder" style="background-image: url({{ url('uploads/tenants') }}/{{ $recTenantsByID->picture }})"></div>
                                            @endif
                                            <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change">
                                                <i class="fa fa-pen"></i>
                                                <input type="file" name="picture">
                                            </label>
                                            <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Remove">
                                                <i class="fa fa-times"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <small>The best size 300x150</small>
                                </div>
        
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea name="address" class="form-control" rows="5">{{ $recTenantsByID->address }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Google Maps</label>
                                    <input type="text" name="google_maps" class="form-control" placeholder="Your Link Maps" value="{{ $recTenantsByID->google_maps }}">
                                </div>

                                <div class="form-group">
                                    <label>Coordinate</label>
                                    <input type="text" name="coordinate" class="form-control" placeholder="Your Coordinate" value="{{ $recTenantsByID->coordinate }}">
                                </div>

                                <div class="form-group">
                                    <label for="type">Type of {{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }}<span class="kt-font-danger">*</span></label>
                                    <select class="form-control col-4" name="type" required="">
                                        <option value="">-- choose one of them --</option>
                                        <option value="Langganan Online" {{ ($recTenantsByID->type=="Langganan Online")?'selected':'' }}>Langganan Online</option>
                                        <option value="Langganan Offline" {{ ($recTenantsByID->type=="Langganan Offline")?'selected':'' }}>Langganan Offline</option>
                                        <option value="Langganan Online & Offline" {{ ($recTenantsByID->type=="Langganan Online & Offline")?'selected':'' }}>Langganan Online & Offline</option>
                                        <option value="Prospect" {{ ($recTenantsByID->type=="Prospect")?'selected':'' }}>Prospect</option>
                                    </select>
                                </div>
        
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Your Email" value="{{ $recTenantsByID->email }}" minlength="5" maxlength="100">
                                </div>
        
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Your Phone Number" value="{{ $recTenantsByID->phone }}" minlength="8" maxlength="30">
                                    <small>Must be at least 8 number long </small>
                                </div>
        
                                <div class="form-group">
                                    <label>Whatsapp</label>
                                    <input type="text" name="whatsapp" class="form-control" placeholder="Your Whatsapp" value="{{ $recTenantsByID->whatsapp }}" minlength="8" maxlength="30">
                                    <small>Must be at least 8 number long </small>
                                </div>
        
                                <div class="form-group">
                                    <label for="is_active">Active <span class="kt-font-danger">*</span></label>
                                    <select class="form-control col-4" name="is_active" required="">
                                        <option value="">-- choose one of them --</option>
                                        <option value="1" {{ ($recTenantsByID->is_active==1)?'selected':'' }}>Yes</option>
                                        <option value="0" {{ ($recTenantsByID->is_active==0)?'selected':'' }}>No</option>
                                    </select>
                                </div>
                        </div>
                        <div class="tab-pane fade p-3" id="optional-info" role="tabpanel" aria-labelledby="tab-optional">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label>Instagram Link</label>
                                        <input type="text" name="instagram" class="form-control" placeholder="Your Instagram Link" value="{{ $recTenantsByID->instagram }}" maxlength="250">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Facebook Link</label>
                                        <input type="text" name="facebook" class="form-control" placeholder="Your Facebook Link" value="{{ $recTenantsByID->facebook }}" maxlength="250">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label>Youtube Link</label>
                                        <input type="text" name="youtube" class="form-control" placeholder="Your Youtube Link" value="{{ $recTenantsByID->youtube }}" maxlength="250">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Website Link</label>
                                        <input type="text" name="website_url" class="form-control" placeholder="Your Website Link" value="{{ $recTenantsByID->website_url }}" maxlength="250">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label>Description</label>
                                        <textarea name="description" id="article_desc_en" class="form-control summernote">{{ $recTenantsByID->description }}</textarea>
                                    </div>
                                </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success"><i class="fa fa-arrow-alt-circle-up"></i> Update</button>&nbsp;
                            <button type="reset" class="btn btn-secondary"><i class="fa fa-history"></i> Reset</button>
                        </div>
                    </form>
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        {{-- <button type="submit" class="btn btn-success"><i class="fa fa-arrow-alt-circle-up"></i> Update</button>&nbsp;
                        <button type="reset" class="btn btn-secondary"><i class="fa fa-history"></i> Reset</button> --}}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    @if(Session::has('tab'))
    $('#tab-optional').trigger('click');
    @endif
</script>
@endsection

