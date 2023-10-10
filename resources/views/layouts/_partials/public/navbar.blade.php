<header id="header" class="header-dark">
    <div class="layer-stretch">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-xl-12 pr-2">
                    <ul class="text-right text-white m-0 py-2 topheader-text">
                        <li class="list-inline-item pr-3"><a href="tel:">Phone : </a></li>
                        <li class="list-inline-item"><a href="mailto:">Email : </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="header2">
        <div class="layer-stretch hdr">
            <div class="tbl animated fadeInDown">
                <div class="tbl-row">
                    <div class="tbl-cell hdr-logo">
                        <a href="{{route('pub.home')}}"><img src="" alt=""></a>
                    </div>
                    <div class="tbl-cell hdr-menu">
                        <!-- Start Menu Section -->
                        <ul class="menu">
                            <li>
                                <a class="mdl-button mdl-js-button mdl-js-ripple-effect"
                                    data-upgraded=",MaterialButton,MaterialRipple" href="{{route('pub.home')}}">
                                    Home
                                    <span class="mdl-button__ripple-container">
                                        <span class="mdl-ripple is-animating"
                                            style="width: 220.297px;height: 220.297px;transform: translate(-50%, -50%) translate(53px, 30px);">
                                        </span>
                                    </span>
                                </a>
                            </li>
                            
                            <!-- @guest
                            <li>
                                <a class="mdl-button mdl-js-button mdl-js-ripple-effect loginbtn"
                                    data-upgraded="MaterialButton,MaterialRipple" href="{{route('pub.login.signup')}}">
                                    Log In
                                    <span class="mdl-button__ripple-container">
                                        <span class="mdl-ripple is-animating"
                                            style="width: 220.297px;height: 220.297px;transform: translate(-50%, -50%)translate(53px, 30px);">
                                        </span>
                                    </span>
                                </a>
                            </li>
                            @endguest
                            @auth
                            <li>
                                <a href="{{route('pub.shop.profile')}}">
                                    My Profile 
                                    <span class="mdl-button__ripple-container">
                                        <span class="mdl-ripple is-animating"
                                            style="width: 220.297px;height: 220.297px;transform: translate(-50%, -50%)translate(53px, 30px);">
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a class="mdl-button mdl-js-button mdl-js-ripple-effect loginbtn"
                                    data-upgraded="MaterialButton,MaterialRipple" href="{{route('logout')}}">
                                    Log Out
                                    <span class="mdl-button__ripple-container">
                                        <span class="mdl-ripple is-animating"
                                            style="width: 220.297px;height: 220.297px;transform: translate(-50%, -50%)translate(53px, 30px);">
                                        </span>
                                    </span>
                                </a>
                            </li>
                            @endauth
                             -->
                            <li class="mobile-menu-close"><i class="fa fa-times"></i></li>
                        </ul>
                        <!-- End Menu Section -->

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>