<!-- Column selectors table -->
<section id="image-grid" class="card">
          <div class="card-content">
            <div class="card-body  my-gallery" itemscope="" itemtype="http://schema.org/ImageGallery" data-pswp-uid="1">
              <div class="card-deck-wrapper">
                <div class="card-deck mt-1">
                    @foreach ($photos as $photo)
                        <figure class="card card-img-top border-grey border-lighten-2" itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject">
                            <a href="{{ asset('uploads/'.$photo) }}" itemprop="contentUrl"  data-size="480x360">
                                <img class="gallery-thumbnail card-img-top" src="{{ asset('uploads/'.$photo) }}" itemprop="thumbnail" alt="Image description" style="height:300px !important;" >
                            </a>
                        </figure>
                    @endforeach
                </div>
              </div>


            </div>
            <!-- Root element of PhotoSwipe. Must have class pswp. -->
            <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
              <!-- Background of PhotoSwipe.
             It's a separate element as animating opacity is faster than rgba(). -->
              <div class="pswp__bg"></div>
              <!-- Slides wrapper with overflow:hidden. -->
              <div class="pswp__scroll-wrap">
                <!-- Container that holds slides.
                PhotoSwipe keeps only 3 of them in the DOM to save memory.
                Don't modify these 3 pswp__item elements, data is added later on. -->
                <div class="pswp__container" style="transform: translate3d(0px, 0px, 0px);">
                  <div class="pswp__item" style="display: block; transform: translate3d(-2131px, 0px, 0px);"><div class="pswp__zoom-wrap" style="transform: translate3d(712px, 263px, 0px) scale(0.451694);"><img class="pswp__img" src="" style="opacity: 1; width: 1063px; height: 797px;"></div></div>
                  <div class="pswp__item" style="transform: translate3d(0px, 0px, 0px);"><div class="pswp__zoom-wrap" style="transform: translate3d(1228.84px, 139.047px, 0px) scale(0.340991);"><img class="pswp__img pswp__img--placeholder" src="" style="width: 1063px; height: 797px; display: none;"><img class="pswp__img" src="" style="display: block; width: 1063px; height: 797px;"></div></div>
                  <div class="pswp__item" style="display: block; transform: translate3d(2131px, 0px, 0px);"><div class="pswp__zoom-wrap" style="transform: translate3d(712px, 263px, 0px) scale(0.451694);"><img class="pswp__img" src="" style="opacity: 1; width: 1063px; height: 797px;"></div></div>
                </div>
                <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
                <div class="pswp__ui pswp__ui--fit pswp__ui--hidden">
                  <div class="pswp__top-bar">
                    <!--  Controls are self-explanatory. Order can be changed. -->
                    <div class="pswp__counter">1 / 4</div>
                    <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                    <button class="pswp__button pswp__button--share" title="Share"></button>
                    <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                    <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                    <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
                    <!-- element will get class pswp__preloader-active when preloader is running -->
                    <div class="pswp__preloader">
                      <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                          <div class="pswp__preloader__donut"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip"></div>
                  </div>
                  <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
                  </button>
                  <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
                  </button>
                  <div class="pswp__caption">
                    <div class="pswp__caption__center">
                      <h4 class="card-title">Card title 1</h4>
                      <p class="card-text">This is a longer card with supporting text below.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <br /><br />
            <img src="{{ asset('uploads/'.$index->logo) }}" style="max-height:300px; max-width:400px;" />
            <br /><br />
            {{ trans('admin.school') }} : {{ $index->school }}
            <br /><br />
            {{ $index->title }}
            <br /><br />
            {!! $index->description !!}



          </div>
          <!--/ PhotoSwipe -->
        </section>
<!--/ Column selectors table -->
