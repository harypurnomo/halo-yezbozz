<!DOCTYPE html>
<html lang="en" >
<head>

    <!-- Meta Tags
    ============================================= -->
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SEO Meta Tags
    ============================================= -->
    <meta name="description" content="{{ Library::seo()[0]->meta_description_en }}" />
    <meta name="keywords" content="{{ Library::seo()[0]->meta_keyword_en }}" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ Library::seo()[0]->meta_title_en }}" />
    <meta property="og:description" content="{{ Library::seo()[0]->meta_description_en }}"/>
    <meta property="og:url" content="{{ env('APP_URL') }}" />
    <meta property="og:site_name" content="{{ Library::seo()[0]->site_name_en }}" />

    <!-- begin::Fonts
    ============================================= -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">        

    <!-- begin::Page Vendors Styles(used by this page)
    ============================================= -->
    <link href="{{ url('admin/template/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('admin/template/plugins/fileuploader/font/font-fileuploader.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('admin/template/plugins/fileuploader/jquery.fileuploader.min.css') }}" rel="stylesheet" type="text/css" />
        
    <!-- begin::Global Theme Styles(used by all pages)
    ============================================= -->
    <link href="{{ url('admin/template/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('admin/template/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

    <!-- begin::Layout Skins(used by all pages)
    ============================================= -->
    <link href="{{ url('admin/template/css/skins/header/base/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('admin/template/css/skins/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('admin/template/css/skins/brand/dark.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('admin/template/css/skins/aside/dark.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('admin/template/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" /> 

    <!-- favicon
    ============================================= -->
    <link rel="shortcut icon" href="{{ url('uploads/favicon') }}/{{ Library::companyProfile()[0]->favicon }}" type="image/x-icon">
    <link rel="icon" href="{{ url('uploads/favicon') }}/{{ Library::companyProfile()[0]->favicon }}" type="image/x-icon">

    <!-- Aditional CSS
    ============================================= -->
    <link href="{{ url('admin/template/css/jquery.password-indicator.css') }}?{{ date('YmdHis') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('admin/template/css/custom.css') }}?{{ date('YmdHis') }}" rel="stylesheet" type="text/css" />

    <!-- CSRF Token
    ============================================= -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Document Title
    ============================================= -->
    <title>{{ Library::companyProfile()[0]->company_name }} | CONTROL PANEL</title>

    @yield('css')

</head>
<!-- end::Head -->

<!-- begin::Body -->
<body  class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading"  >

<!-- begin:: Page -->

    @include('admin.layouts.aside_menu')
    
    @include('admin.layouts.header_topbar')

    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
                                                
        @yield('content')

    </div>      

    @include('admin.layouts.footer')

<!-- begin::Scrolltop -->
<div id="kt_scrolltop" class="kt-scrolltop">
    <i class="fa fa-arrow-up"></i>
</div>
<!-- end::Scrolltop -->

{{-- Base URL INIT --}}
<input type="hidden" id="base-url" value="{{ url('') }}" />
<div id="loading"></div>

<!-- begin::Demo Panel -->
    
<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {
    "colors": {
        "state": {
            "brand": "#5d78ff",
            "dark": "#282a3c",
            "light": "#ffffff",
            "primary": "#5867dd",
            "success": "#34bfa3",
            "info": "#36a3f7",
            "warning": "#ffb822",
            "danger": "#fd3995"
        },
        "base": {
            "label": [
                "#c5cbe3",
                "#a1a8c3",
                "#3d4465",
                "#3e4466"
            ],
            "shape": [
                "#f0f3ff",
                "#d9dffa",
                "#afb4d4",
                "#646c9a"
            ]
        }
    }
};
</script>
<!-- end::Global Config -->

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="{{ url('admin/template/plugins/global/plugins.bundle.js') }}" type="text/javascript"></script>
<script src="{{ url('admin/template/js/scripts.bundle.js') }}" type="text/javascript"></script>
<!--end::Global Theme Bundle -->

<!--begin::Page Scripts(used by this page) -->
<script src="{{ url('admin/template/js/pages/dashboard.js') }}" type="text/javascript"></script>
<script src="{{ url('admin/template/js/pages/custom/user/profile.js') }}?{{ date('YmdHis') }}" type="text/javascript"></script>
<script src="{{ url('admin/template/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script src="{{ url('admin/template/js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<script src="{{ url('admin/template/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js') }}" type="text/javascript"></script>
<script src="{{ url('admin/template/js/pages/crud/forms/widgets/jquery.password-indicator.js') }}" type="text/javascript"></script>
<script src="{{ url('admin/template/plugins/fileuploader/jquery.fileuploader.min.js') }}" type="text/javascript"></script>
<script src="{{ url('admin/template/js/custom.js') }}?{{ date('YmdHis') }}" type="text/javascript"></script>

@if(Session::has('success-update'))
    <script type="text/javascript">
        Swal.fire({
          position: "top-end",
          type: "success",
          text: "{{ Session::get('success-update') }}",
          showConfirmButton: false,
          timer: 2000
        });
    </script>
@elseif(Session::has('error'))
    <script type="text/javascript">
        Swal.fire({
          position: "top-end",
          type: "error",
          title: 'Oops...',
          text: "{!! Session::get('error') !!}",
          showConfirmButton: false,
          timer: 10000
        });
    </script>    
@endif
@yield('js')
<!--end::Page Scripts -->

</body>
<!-- end::Body -->

</html>