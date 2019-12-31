<!DOCTYPE html>
<html   @if (session()->get('locale') == "ar")  lang="ar" @else  lang="en" @endif >

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Thaty Foundation for Educational Tools">
    <meta name="keywords" content="Robot, e-training, STEAM,10feedy,Feasibilty-Study">
    <meta name="author" content="Developed by Eng. Karim Helmy | karimhelmy185@gmail.com">
    <title>10Feedy Dashboard
    </title>
    <link rel="apple-touch-icon" href="{{ asset('backend/app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend/app-assets/images/ico/favicon.ico') }}">
    <!--Start styles-->

    <link rel="stylesheet" href="{{ asset('frontend/css/core.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/scss/style.css')}}">
    @if (session()->get('locale') == "ar")
        <link rel="stylesheet" href="{{ asset('frontend/css/new-style.css')}}">
    @else
        <link rel="stylesheet" href="{{ asset('frontend/css/new-style2.css')}}">
    @endif
    @if (session()->get('locale') == "ar")
        <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css-rtl/vendors.css') }}">


        <!-- END VENDOR CSS-->
        <!-- BEGIN MODERN CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css-rtl/app.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css-rtl/custom-rtl.css') }}">
        <!-- END MODERN CSS-->
        <!-- BEGIN Page Level CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css-rtl/core/menu/menu-types/vertical-menu-modern.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css-rtl/core/colors/palette-gradient.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css-rtl/jquery-jvectormap-2.0.3.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css-rtl/morris.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css-rtl/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css-rtl/style-rtl.css') }}">
    @else
    <!-- BEGIN VENDOR CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/vendors.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/vendors/css/ui/jquery-ui.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/css-rtl/plugins/ui/jqueryui.css')}}">
        <!-- END VENDOR CSS-->
        <!-- BEGIN MODERN CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/app.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/core/menu/menu-types/vertical-menu-modern.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/core/colors/palette-gradient.css') }}">
        <!-- END MODERN CSS-->
    @endif
<!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/vendors/js/gallery/photo-swipe/photoswipe.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/vendors/js/gallery/photo-swipe/default-skin/default-skin.css')}}">

    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/fonts/simple-line-icons/style.css') }}"> @if (session()->get('locale') == "ar")
        <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css-rtl/core/colors/palette-gradient.css') }}">
        <!-- END Page Level CSS-->
        <!-- BEGIN Custom CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css-rtl/pages/timeline.css') }}">

        <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/style-rtl.css')}}"> @else
    <!-- END Page Level CSS-->
        <!-- BEGIN Custom CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/pages/timeline.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/style.css')}}"> @endif
<!-- END Custom CSS-->
    @yield('styles')
    @stack('styles')

</head>

<body  >

<!--Site preloader-->


@include('super.includes.header')

<!-- =============================================== -->
<main>
    <div class="page_wrapper">
        @yield('breadcrumbs')
        @stack('breadcrumbs')
        <div class="p-t-2 p-b-2">
            <div class="container wow fadeInUp">
                @yield('breadcrumbs2')
                @stack('breadcrumbs2')
                <div class="row">

                    <!-- Left side column. contains the sidebar -->
                @include('super.includes.sidebar')
                <!-- =============================================== -->
                    <!-- Content Wrapper. Contains page content -->
                {{-- @include('super.includes.messages') --}}
                <!-- Content Header (Page header) -->
                @yield('content')
                <!-- /.content -->

                    <!-- /.content-wrapper -->
                </div>
            </div>
        </div>
    </div>
</main>
@include('super.includes.footer')

<script src="https://www.google.com/jsapi" type="text/javascript"></script>
<script src="{{ asset('backend/app-assets/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
@if (session()->get('locale') == "ar")


    <script src="{{ asset('backend/app-assets/vendors/js/tables/datatable/datatables-rtl.min.js')}}" type="text/javascript"></script>
@else
    <script src="{{ asset('backend/app-assets/vendors/js/tables/datatable/datatables.min.js')}}" type="text/javascript"></script>
@endif


<script src="{{ asset('backend/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('backend/app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('backend/app-assets/vendors/js/tables/jszip.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('backend/app-assets/vendors/js/tables/pdfmake.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('backend/app-assets/vendors/js/tables/vfs_fonts.js')}}" type="text/javascript"></script>
@if (session()->get('locale') == "ar")
    <script src="{{ asset('backend/app-assets/vendors/js/tables/buttons-rtl.html5.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('backend/app-assets/vendors/js/tables/buttons-rtl.colVis.min.js')}}" type="text/javascript"></script>
@else
    <script src="{{ asset('backend/app-assets/vendors/js/tables/buttons.html5.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('backend/app-assets/vendors/js/tables/buttons.colVis.min.js')}}" type="text/javascript"></script>
@endif
<script src="{{ asset('backend/app-assets/vendors/js/tables/buttons.print.min.js')}}" type="text/javascript"></script>

<!-- END PAGE VENDOR JS-->
<script src="{{ asset('backend/app-assets/vendors/js/charts/chart.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('backend/app-assets/vendors/js/charts/raphael-min.js')}}" type="text/javascript"></script>
<script src="{{ asset('backend/app-assets/vendors/js/charts/morris.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('backend/app-assets/vendors/js/charts/jquery-jvectormap-2.0.3.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('backend/app-assets/vendors/js/charts/jquery-jvectormap-world-mill.js')}}" type="text/javascript"></script>

<script src="{{ asset('backend/app-assets/vendors/js/charts/visitor-data.js')}}" type="text/javascript"></script>


<!-- END PAGE VENDOR JS-->
<script src="{{ asset('backend/app-assets/js/scripts/bootstrap-switch.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('backend/app-assets/js/scripts/bootstrap-checkbox.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('backend/app-assets/js/scripts/switchery.min.js')}}" type="text/javascript"></script>
<!-- BEGIN MODERN JS-->

<script src="{{ asset('backend/app-assets/vendors/js/extensions/sweetalert.min.js')}}" type="text/javascript"></script>

<script src="{{ asset('backend/app-assets/js/core/app-menu.js')}}" type="text/javascript"></script>
<script src="{{ asset('backend/app-assets/js/core/app.js')}}" type="text/javascript"></script>

<script src="{{ asset('backend/app-assets/js/scripts/jquery.repeater.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('backend/app-assets/js/scripts/customizer.js')}}" type="text/javascript"></script>
<script src="{{ asset('backend/app-assets/js/scripts/pie.js')}}" type="text/javascript"></script>
<script src="{{ asset('backend/app-assets/js/scripts/pie-exploded.js')}}" type="text/javascript"></script>
<script src="{{ asset('backend/app-assets/js/scripts/form-repeater.js')}}" type="text/javascript"></script>
<!-- BEGIN PAGE VENDOR JS-->

<script src="{{ asset('backend/app-assets/js/scripts/switch.js')}}" type="text/javascript"></script>
<!-- END PAGE VENDOR JS-->
<script src="{{ asset('backend/app-assets/js/scripts/extensions/sweet-alerts.js')}}" type="text/javascript"></script>
<!-- END MODERN JS-->
<script src="{{asset('backend/app-assets/js/core/libraries/jquery_ui/jquery-ui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/app-assets/js/scripts/ui/jquery-ui/navigations.js')}}" type="text/javascript"></script>
<!-- BEGIN PAGE LEVEL JS-->

<script src="{{ asset('backend/app-assets/vendors/js/gallery/photo-swipe/photoswipe.min.js')}}"
        type="text/javascript"></script>
<script src="{{ asset('backend/app-assets/vendors/js/gallery/photo-swipe/photoswipe-ui-default.min.js')}}"
        type="text/javascript"></script>
{{--
<script src="{{ asset('backend/app-assets/js/scripts/pages/dashboard-sales.js')}}" type="text/javascript"></script> --}}
<!-- BEGIN PAGE LEVEL JS-->
<script src="{{ asset('backend/app-assets/js/scripts/tables/datatables-extensions/datatable-button/datatable-html5.js')}}"
        type="text/javascript"></script>

<script src="{{ asset('backend/app-assets/js/scripts/gallery/photo-swipe/photoswipe-script.js')}}" type="text/javascript"></script>
<script src="{{ asset('backend/app-assets/js/scripts/dashboard-sales.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL JS-->

<script src="{{ asset('frontend/js/core.js')}}"></script>
<script src="{{ asset('frontend/js/plugin.js')}}"></script>
@yield('scripts')
@stack('scripts')


</body>

</html>
