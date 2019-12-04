<!DOCTYPE html>
<html class="loading"  @if (session()->get('locale') == "ar")  lang="ar" @else  lang="en" @endif  >

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Thaty Foundation for Educational Tools">
    <meta name="keywords" content="Robot, e-training, STEM">
    <meta name="author" content="Developed by Eng. Wael Serag | waelserag1@gmail.com">
    <title>Besteam
    </title>
    <link rel="apple-touch-icon" href="{{ asset('backend/app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend/app-assets/images/ico/favicon.ico') }}">
    <!--Start styles-->
    <link rel="stylesheet" href="{{ asset('frontend/css/core.css')}}">
    @if (session()->get('locale') == "ar")
        <link rel="stylesheet" href="{{ asset('frontend/scss/style.css')}}">
    @else
        <link rel="stylesheet" href="{{ asset('frontend/css/style.css')}}">
    @endif
    <link rel="stylesheet" href="{{ asset('frontend/css/new-style.css')}}">
    <!-- END Custom CSS-->
    @yield('styles')
    @stack('styles')
</head>

<body>

<!--Site preloader-->
<div class='loader-container'>
    <div class='loader'>
        <div class='loader--dot'></div>
        <div class='loader--dot'></div>
        <div class='loader--dot'></div>
        <div class='loader--dot'></div>
        <div class='loader--dot'></div>
        <div class='loader--dot'></div>
        <div class='loader--text'></div>
    </div>
</div>

@include('includes.header')


@yield('content')

@include('includes.footer')
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="{{ asset('frontend/js/core.js')}}"></script>
<script src="{{ asset('frontend/js/plugin.js')}}"></script>

<!-- END PAGE LEVEL JS-->
@yield('scripts')
@stack('scripts')


</body>

</html>
