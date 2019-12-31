<footer>
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-6 mb-md-0 mb-5 ">
        <img class="footer_logo " src="{{ asset('frontend/home/assets/imgs/logo_footer.png')}}" style="width: 140px;margin-top: -40px !important;" alt="footer-logo">
      </div>

      <div class="col-md-4 col-sm-6 mb-md-0 mb-5">
          <div class="footer_social ">
            <a href="{{GetSetting('facebook')}}" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="{{GetSetting('twitter')}}" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="{{GetSetting('inst')}}" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="{{GetSetting('youtube')}}" target="_blank"><i class="fab fa-youtube"></i></a>
          </div>
      </div>

      <div class="col-md-4 col-sm-6 mb-md-0 mb-5">
        <a href="mailto:{{GetSetting('email')}}"><i class="fa fa-envelope"></i>  &nbsp; {{GetSetting('email')}}</a>
        <a href="https://api.whatsapp.com/send?phone=966{{ltrim(GetSetting('whatsapp'), '0')}}"><i class="fab fa-whatsapp"></i> &nbsp; {{GetSetting('whatsapp')}}</a>
      </div>
    </div>

    <div class="text-center text-secondary m-t-2">
      All copyrights reserved to 10Feedy
    </div>
  </div>
</footer>
