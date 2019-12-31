<!--Header-->
  <header  style="background: white">
    <style>.btn-danger{color: white !important;}.modal-content  {direction: ltr!important;} .modal-title{visibility: hidden}
    </style>

    <div class="our_topbar user_topbar" >
      <div class="container">
        <div class="row" >
          <!--Logo-->
          <div class="col">
            <a href="{{ surl('/') }}" class="our_logo">
                    <img src="{{ asset('frontend/home/assets/imgs/logo2.jpeg')}}" style="width: 140px" alt="logo">
            </a>
          </div>


          <!--navbar-->
          <nav class="navbar navbar-expand-lg">




          </nav>
          <!--right login-->

          <div class="col">
            <div class="d-flex justify-content-end">
              <div class="profile">

                @if (session()->get('locale') == "ar")
                  <a href="#" style="color: black;font-size: 25px;margin-left: 15px"> <i class="icon-layers"></i>
                  </a>                @else
                  <a href="#" style="color: black;font-size: 25px;margin-right: 15px"> <i class="icon-layers"></i>
                  </a>                @endif


                <div class="profile_menu">

                  <a href="https://be-steam.com" >
                    <img src="{{ asset('frontend/images/logo black.png')}}" style="width: 130px" alt="logo">
                  </a>

                  <a href="{{ url('/') }}">
                    <img src="{{ asset('frontend/home/assets/imgs/logo2.jpeg')}}" style="width: 130px" alt="logo">
                  </a>

                </div>
              </div>
              <div class="profile">
                <a href="#"><img src="{{ asset('frontend/images/scientist.png')}}" alt=""></a>

                <div class="profile_menu">

                  <a href="#">
                    <i class="fal fa-user">

                    </i>
                    {{ auth()->user()->username }}
                  </a>

                  <a href="{{ url('/logout') }}">
                    <i class="fal fa-sign-out"></i>
                    {{ trans('login.logout') }}
                  </a>

                </div>
              </div>


              @if (session()->get('locale') == "ar")
                <a href="{{ url("setlocale/en") }}" class="lang">E</a>
              @else
                <a href="{{ url("setlocale/ar") }}" class="lang">ع</a>
              @endif
              <button class="navbar_toggler d-sm-none d-inline-block">
                <i class="fal fa-bars"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!--Mobile menu-->

    <div class="our_mobile_menu">
      <button><i class="fa fa-times"></i></button>
    </div>
  </header>
