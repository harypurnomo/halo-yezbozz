@extends('admin.layouts.template')

@section('content')
<!-- begin:: Content Head -->
<div class="kt-subheader  kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            
            <h3 class="kt-subheader__title">{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }}</h3>

            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
        </div>
    </div>
</div>
<!-- end:: Content Head -->	

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<div class="row">

		<div class="col-xl-4">
	        <div class="alert alert-light alert-elevate fade show" role="alert">
	            @if(Auth::user()->mypic=='') 
                <img src="{{ asset('admin/template/client/noimage.png') }}" alt="{{ Auth::user()->name }}" class="align-self-end h-100px" width="43">
                @else
                <img src="{{ asset('uploads/mypic') }}/{{ Auth::user()->mypic }}" alt="{{ Auth::user()->name }}" class="align-self-end h-100px" width="43">
                @endif
	            <div class="alert-text pl-20">
	                WELCOME, <a class="kt-link kt-font-bold" href="{{ route('profile') }}">{{ Auth::user()->name }}</a>. 
	            </div>
	        </div>
	    </div>

	    <div class="col-xl-8">
	        <div class="alert alert-light alert-elevate fade show" role="alert">
	            <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
	            <div class="alert-text">
	                For more info please visit the <a class="kt-link kt-font-bold" href="javascript:;" target="_blank">Documentation</a>.
	            </div>
	        </div>
	    </div>

		@foreach ($recTenantsType as $item)
		<div class="col-xl-4">
	        <div class="alert alert-light alert-elevate fade show" role="alert">
	            <div class="alert-text pl-20">
	                <h5>Category : {{ $item->name }} <br>
					Total Customer : <a href="{{ route('dashboard.tenant.type',['tenant_type_id'=>$item->id]) }}"> {{ count(Library::TenantsTotalByType($item->id)) }} </a>
					</h5>
				</div>
	        </div>
	    </div>
		@endforeach
	    
	</div>

</div>

	
		
<div class="kt-space-20"></div>

    
@endsection