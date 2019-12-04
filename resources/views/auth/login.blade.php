<!DOCTYPE html>
<html   @if (session()->get('locale') == "ar")  lang="ar" @else  lang="en" @endif >

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon" href="{{ asset('backend/app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend/app-assets/images/ico/favicon.ico')}}">

    <!--Start styles-->
    <link rel="stylesheet" href="{{ asset('frontend/css/core.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/scss/style.css')}}">

    <title>Be-Steam Login</title>
    <style>
        @media (min-width: 768px) {
            .login_form:before {
                content: '';
                position: absolute;
                right: -190px;
                margin-top: 60px;
                background: url({{ asset('frontend/images/robo.png') }}) 0% 0% no-repeat;
                width: 250px;
                height: 100%;
                z-index: 99999;
                background-size: contain;
            }
        }

        @media (min-width: 768px) {
            .login_form:after {
                content: '';
                position: absolute;
                left: -200px;
                top: 120px;
                background: url({{ asset('frontend/images/ro1.gif') }}) 0% 0% no-repeat;
                width: 250px;
                height: 100%;
                background-size: contain;
            }
        }
    </style>
</head>

<body style="background:linear-gradient(
        rgba(0, 0, 0, 0.7),
        rgba(0, 0, 0, 0.7)
        ),url({{ asset('frontend/images/learning.jpg')}}) no-repeat center center fixed; height:100%;  -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">


<!--Preloader-->

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



<main>
    <div class="page_wrapper" style="background:none;">
        <div class="container">
            <br />
            @if ($errors->count())
                <div class="alert alert-danger" style="width:100%;">
                    <ul>
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session()->has('success'))
                <div class="alert alert-success" style="width:100%;">{{ session()->get('success') }}</div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger" style="width:100%;">{{ session()->get('error') }}</div>
            @endif
            <br /><br /><br /><br />
            <div class="col-md-8 mx-auto">
                <div class="login_form wow fadeInUp">
                    <div class="row">

                        <div class="col-md-5 p-0">
                            <div class="login_img"></div>
                        </div>

                        <div class="col-md-7 p-0">
                            <form method="post" action="{{url('/sessionstore')}}" class="clearfix">
                                <h3>{{ trans('login.login') }}</h3>
                                {{ csrf_field() }}
                                <label for="">{{ trans('admin.username') }} :</label>
                                <input type="text" value="{{ old('username') }}" name="username" class="form-control">

                                <label for="">{{ trans('login.password') }} :</label>
                                <input type="password" value="{{ old('password') }}" name="password" class="form-control">
                                <p class="m-t-2">
                    <span class="checkbox_wrapper">
                      <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} id='checkBox'>
                      <label class="checkLabel" for="checkBox"></label>
                      <label for="checkBox">{{ trans('login.remember') }}</label>
                    </span>

                                </p>

                                <p class="m-t-2">
                                    <input type="submit" value="{{ trans('login.login') }}">
                                </p>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>



<!--Start scripts-->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

<script src="{{ asset('frontend/js/core.js')}}"></script>
<script src="{{ asset('frontend/js/plugin.js')}}"></script>
</body>

</html>
