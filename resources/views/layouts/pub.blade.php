<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Site Title -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Meta Description -->
  <meta name="Description" content="@yield('meta_description')" />
  <!-- Meta Tag -->
  <meta name="keywords" content="@yield('meta_tag')" />
  <title>@yield('title') -{{ config('app.name') }}</title>

  <!-- Meta Pixel Code -->
  <script>
  ! function(f, b, e, v, n, t, s) {
    if (f.fbq) return;
    n = f.fbq = function() {
      n.callMethod ?
        n.callMethod.apply(n, arguments) : n.queue.push(arguments)
    };
    if (!f._fbq) f._fbq = n;
    n.push = n;
    n.loaded = !0;
    n.version = '2.0';
    n.queue = [];
    t = b.createElement(e);
    t.async = !0;
    t.src = v;
    s = b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t, s)
  }(window, document, 'script',
    'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '308678466141621');
  fbq('track', 'PageView');
  </script>
  <noscript><img height="1" width="1" style="display:none"
      src="https://www.facebook.com/tr?id=308678466141621&ev=PageView&noscript=1" /></noscript>
  <!-- End Meta Pixel Code -->

  <!-- Favicon Icon -->
  <link rel="icon" type="image/x-icon" href="{{asset('pub_template/images/favicon.ico')}}" />
  <!-- Material Design Lite Stylesheet CSS -->
  <link rel="stylesheet" href="{{asset('pub_template/assets/plugin/material/material.min.css')}}" />
  <!-- Material Design Select Field Stylesheet CSS -->
  <link rel="stylesheet" href="{{asset('pub_template/assets/plugin/material/mdl-selectfield.min.css')}}" />
  <!-- Animteheading Stylesheet CSS -->
  <link rel="stylesheet" href="{{asset('pub_template/assets/plugin/animateheading/animateheading.min.css')}}" />
  <!-- Owl Carousel Stylesheet CSS -->
  <link rel="stylesheet" href="{{asset('pub_template/assets/plugin/owl_carousel/owl.carousel.min.css')}}" />
  <!-- Animate Stylesheet CSS -->
  <link rel="stylesheet" href="{{asset('pub_template/assets/plugin/animate/animate.min.css')}}" />
  <!-- Magnific Popup Stylesheet CSS -->
  <link rel="stylesheet" href="{{asset('pub_template/assets/plugin/magnific_popup/magnific-popup.min.css')}}" />
  <!-- Flex Slider Stylesheet CSS -->
  <link rel="stylesheet" href="{{asset('pub_template/assets/plugin/flexslider/flexslider.min.css')}}" />
  <!-- Custom Main Stylesheet CSS -->
  <link rel="stylesheet" href="{{asset('pub_template/dist/css/style-blue.css?v=1.0.4')}}" />
  <link rel="stylesheet" href="{{asset('pub_template/dist/css/custom.css?v=1.0.3')}}" />
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

  @yield('css')
</head>

<body>
  <div class="wrapper">
    <!-- Start Header Section -->
    @include('layouts._partials.public.navbar')
    <!-- End Header Section -->
    <!-- Start Slider Section -->
    @yield('slider')
    <!-- End Slider Section -->
    <!--button class="rfi-button desc">
        <img alt="rfi" src="images/uploads/contact.png" width="95" height="70" class="loading" data-ll-status="loading">
        <p>
        Contact
        </p>
      </button>
      <button class="loc-button desc viewport-height">
        <img alt="rfi" src="images/uploads/whatsapp.png" width="95" height="70" class="loading" data-ll-status="loading">
        <p>
         &nbsp;Message
        </p>
      </button-->
    @yield('content')
    <!-- End Testimonial Section -->
    <!-- Start Footer Section -->
    @include('layouts._partials.public.footer')
    <!-- End of Footer Section -->
  </div>
  <!-- **********Included Scripts*********** -->

  <!-- Jquery Library 2.1 JavaScript-->
  <script src="{{asset('pub_template/assets/plugin/jquery/jquery-2.1.4.min.js')}}"></script>
  <!-- Popper JavaScript-->
  <script src="{{asset('pub_template/assets/plugin/popper/popper.min.js')}}"></script>
  <!-- Bootstrap Core JavaScript-->
  <script src="{{asset('pub_template/assets/plugin/bootstrap/bootstrap.min.js')}}"></script>
  <!-- Modernizr Core JavaScript-->
  <script src="{{asset('pub_template/assets/plugin/modernizr/modernizr.js')}}"></script>
  <!-- Animaateheading JavaScript-->
  <script src="{{asset('pub_template/assets/plugin/animateheading/animateheading.js')}}"></script>
  <!-- Material Design Lite JavaScript-->
  <script src="{{asset('pub_template/assets/plugin/material/material.min.js')}}"></script>
  <!-- Material Select Field Script -->
  <script src="{{asset('pub_template/assets/plugin/material/mdl-selectfield.min.js')}}"></script>
  <!-- Flexslider Plugin JavaScript-->
  <script src="{{asset('pub_template/assets/plugin/flexslider/jquery.flexslider.min.js')}}"></script>
  <!-- Owl Carousel Plugin JavaScript-->
  <script src="{{asset('pub_template/assets/plugin/owl_carousel/owl.carousel.min.js')}}"></script>
  <!-- Scrolltofixed Plugin JavaScript-->
  <script src="{{asset('pub_template/assets/plugin/scrolltofixed/jquery-scrolltofixed.min.js')}}"></script>
  <!-- Magnific Popup Plugin JavaScript-->
  <script src="{{asset('pub_template/assets/plugin/magnific_popup/jquery.magnific-popup.min.js')}}"></script>
  <!-- WayPoint Plugin JavaScript-->
  <script src="{{asset('pub_template/assets/plugin/waypoints/jquery.waypoints.min.js')}}"></script>
  <!-- CounterUp Plugin JavaScript-->
  <script src="{{asset('pub_template/assets/plugin/counterup/jquery.counterup.js')}}"></script>
  <!-- masonry Plugin JavaScript-->
  <script src="{{asset('pub_template/assets/plugin/masonry_pkgd/masonry.pkgd.min.js')}}"></script>
  <!-- SmoothScroll Plugin JavaScript-->
  <script src="{{asset('pub_template/assets/plugin/smoothscroll/smoothscroll.min.js')}}"></script>
  <!--acme ticker-->
  <script src="{{asset('pub_template/assets/plugin/acmeticker/acmeticker.min.js')}}"></script>
  <!--Custom JavaScript-->
  <script src="{{asset('pub_template/dist/js/custom.js')}}"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


  <script>
  $(document).ready(function() {

    var url = window.location.href,
      urlRegExp = new RegExp(url.replace(/\/$/, '') +
      "$"); // create regexp to match current url pathname and remove trailing slash if present as it could collide with the link in navigation in case trailing slash wasn't present there
    // now grab every link from the navigation
    $('.menu a').each(function() {
      // and test its normalized href against the url pathname regexp
      if (urlRegExp.test(this.href.replace(/\/$/, ''))) {
        $(this).addClass('active');
      }
    });
    
  });
  </script>
  @yield('js')
  <script>
  const nav = document.querySelector("#header2");
  const NavTop = nav.offsetTop;

  function fixnavbar() {
    if (window.scrollY >= NavTop) {
      document.body.style.paddingTop = nav.offsetHeight + "px";
      document.body.classList.add("fixed-nav");
    } else {
      document.body.style.paddingTop = 0;
      document.body.classList.remove("fixed-nav");
    }
  }
  window.addEventListener("scroll", fixnavbar);
  </script>
</body>

</html>