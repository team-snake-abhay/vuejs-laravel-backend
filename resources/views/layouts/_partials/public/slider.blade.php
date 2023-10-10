<div id="slider" class="slider-dark">
    <div class="flexslider slider-wrapper">
        <ul class="slides">
          @foreach($sliders as $item)
            <li class="flex-active-slide"
                style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 1; display: block; z-index: 2;">
                <div class="slider-backgroung-image"
                    style="background-image: url('storage/images/sliders/{{$item->image}}');">
                    <div class="layer-stretch">
                        <div class="layer-stretch">
                            <div class="slider-info">
                                <h1>{{$item->title}}</h1>
                                <!--p class="animated fadeInDown">We have created 80+ Pages, 300+ Components or Shortcodes, Popup for this template and more in future. #twitterhash, @facebooktag</p>
                      <div class="slider-button">
                          <a class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect button button-primary button-pill">Explore More</a>
                      </div-->
                            </div>
                        </div>
                    </div>
                </div>
            </li>
          @endforeach
        </ul>
        <ul class="flex-direction-nav">
            <li class="flex-nav-prev">
                <a class="flex-prev flex-disabled" href="#" tabindex="-1">Previous</a>
            </li>
            <li class="flex-nav-next">
                <a class="flex-next flex-disabled" href="#" tabindex="-1">Next</a>
            </li>
        </ul>
    </div>
</div>