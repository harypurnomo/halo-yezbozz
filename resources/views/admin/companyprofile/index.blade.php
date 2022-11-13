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
                <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">List Data</span>
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
                    <h3 class="kt-portlet__head-title">{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }}</h3>
                </div>
            </div>
            
            <div class="kt-portlet__body">

                @foreach ($recCompanyProfile as $element)
                <!--begin::Form-->
                <form class="kt-form" action="{{ route('master-company-profile.update',['id'=>$element->id]) }}" method="POST" enctype="multipart/form-data">
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
                            <label>Company Name <span class="kt-font-danger">*</span></label>
                            <input type="text" name="company_name" class="form-control" placeholder="Your Company Name" value="{{ $element->company_name }}" required="" minlength="5" maxlength="100">
                        </div>
                        <div class="form-group">
                            <label>Logo</label>
                            <div class="col-4">
                                <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar2">
                                    @if($element->logo=='')
                                    <div class="kt-avatar__holder" style="background-image: url({{ asset('admin/template/client/noimage.png') }});"></div>
                                    @else
                                    <div class="kt-avatar__holder" style="background-image: url({{ url('uploads/logo') }}/{{ $element->logo }})"></div>
                                    @endif
                                    <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change">
                                        <i class="fa fa-pen"></i>
                                        <input type="file" name="logo">
                                    </label>
                                    <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Remove">
                                        <i class="fa fa-times"></i>
                                    </span>
                                </div>
                            </div>
                            <small>The best size 125 x 125</small>
                        </div>
                        <div class="form-group">
                            <label>Favicon</label>
                            <div class="col-4">
                                <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar">
                                    @if($element->favicon=='')
                                    <div class="kt-avatar__holder" style="background-image: url({{ asset('admin/template/client/noimage.png') }});"></div>
                                    @else
                                    <div class="kt-avatar__holder" style="background-image: url({{ url('uploads/favicon') }}/{{ $element->favicon }})"></div>
                                    @endif
                                    <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change">
                                        <i class="fa fa-pen"></i>
                                        <input type="file" name="favicon">
                                    </label>
                                    <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Remove">
                                        <i class="fa fa-times"></i>
                                    </span>
                                </div>
                            </div>
                            <small>The best size 15 x 15</small>
                        </div>
                        <div class="form-group">
                            <label>Company Brief EN <span class="kt-font-danger">*</span></label>
                            <textarea name="company_brief_en" id="company_brief_en" class="form-control" maxlength="250" required="">{{ $element->company_brief_en }}</textarea>
                            <span id="char-company_brief_en">250</span> Character(s) Remaining
                        </div>
                        <div class="form-group">
                            <label>Company Brief ID <span class="kt-font-danger">*</span></label>
                            <textarea name="company_brief_id" id="company_brief_id" class="form-control" maxlength="250" required="">{{ $element->company_brief_id }}</textarea>
                            <span id="char-company_brief_id">250</span> Character(s) Remaining
                        </div>
                        <div class="form-group">
                            <label>Address <span class="kt-font-danger">*</span></label>
                            <textarea name="address" class="form-control" required="" rows="5">{!! $element->address !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Email <span class="kt-font-danger">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="Your Email" value="{{ $element->email }}" required="" minlength="5" maxlength="100">
                        </div>
                        <div class="form-group">
                            <label>Phone Number <span class="kt-font-danger">*</span></label>
                            <input type="text" name="phone_number" class="form-control" placeholder="Your Phone Number" value="{{ $element->phone_number }}" required="" minlength="8" maxlength="30">
                            <span>Format : +62 8XX XXXX XXXX</span>
                        </div>
                        <div class="form-group">
                            <label>Whatsapp Number</label>
                            <input type="text" name="whatsapp_number" class="form-control" placeholder="Your Whatsapp Number" value="{{ $element->whatsapp_number }}" minlength="8" maxlength="30">
                            <span>Format : 62XXXXXXXXXXX</span>
                        </div>
                        <div class="form-group">
                            <label>Fax </label>
                            <input type="text" name="fax" class="form-control" placeholder="Your Fax" value="{{ $element->fax }}" minlength="8" maxlength="30">
                        </div>
                        <div class="form-group">
                            <label>Instagram</label>
                            <input type="text" name="instagram" class="form-control" placeholder="Your Instagram" value="{{ $element->instagram }}" minlength="5" maxlength="100">
                            <span>Format URL : https://xxxx </span>
                        </div>
                        <div class="form-group">
                            <label>Youtube</label>
                            <input type="text" name="youtube" class="form-control" placeholder="Your Youtube" value="{{ $element->youtube }}" minlength="5" maxlength="100">
                            <span>Format URL : https://xxxx </span>
                        </div>
                        <div class="form-group">
                            <label>Facebook</label>
                            <input type="text" name="facebook" class="form-control" placeholder="Your Facebook" value="{{ $element->facebook }}" minlength="5" maxlength="100">
                            <span>Format URL : https://xxxx </span>
                        </div>
                        <div class="form-group">
                            <label>Twitter</label>
                            <input type="text" name="twitter" class="form-control" placeholder="Your Twitter" value="{{ $element->twitter }}" minlength="5" maxlength="100">
                            <span>Format URL : https://xxxx </span>
                        </div>
                        <div class="form-group">
                            <label>Linked In</label>
                            <input type="text" name="linkedin" class="form-control" placeholder="Your Linked In" value="{{ $element->linkedin }}" minlength="5" maxlength="100">
                            <span>Format URL : https://xxxx </span>
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
                @endforeach
                
            </div>
        </div>
    </div>

</div>
    
@endsection

@section('js')
<script language="javascript" type="text/javascript">
$(function(){
    var maxLength = 250;
    $('#company_brief_en').keyup(function() {
      var textlen = maxLength - $(this).val().length;
      $('#char-company_brief_en').text(textlen);
    });
});

$(function(){
    var maxLength = 250;
    $('#company_brief_id').keyup(function() {
      var textlen = maxLength - $(this).val().length;
      $('#char-company_brief_id').text(textlen);
    });
});
</script>
@endsection