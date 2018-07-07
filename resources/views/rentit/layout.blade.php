<!Doctype HTML>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title' , 'JLMA')</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('rentit/ico/apple-touch-icon-144-precomposed.png') }}">
    <link rel="shortcut icon" href="{{ asset('rentit/ico/favicon.ico') }}">


    <link media="screen" rel="stylesheet" type="text/css" href="{{asset('css/jquery.shuttle.css')}}">
    <link media="screen" rel="stylesheet" type="text/css" href="{{asset('css/jquery.range.css')}}">

    <!-- CSS Global -->
    <link href="{{ asset('rentit/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('rentit/plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('rentit/plugins/fontawesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('rentit/plugins/prettyphoto/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('rentit/plugins/owl-carousel2/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('rentit/plugins/owl-carousel2/assets/owl.theme.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('rentit/plugins/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('rentit/plugins/swiper/css/swiper.min.css') }}" rel="stylesheet">
    <link href="{{ asset('rentit/plugins/datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="{{ asset('rentit/css/theme.css') }}" rel="stylesheet">
    <link href="{{ asset('rentit/css/theme-blue-1.css') }}" rel="stylesheet">

    <!-- Head Libs -->
    <script src="{{ asset('rentit/plugins/modernizr.custom.js')  }}"></script>

    <!--[if lt IE 9]>
    <script src="{{ asset('rentit/plugins/iesupport/html5shiv.js') }}"></script>
    <script src="{{ asset('rentit/plugins/iesupport/respond.min.js') }}"></script>
    <![endif]-->
</head>
<body id="home" class="wide">
<!-- PRELOADER -->

 <div id="preloader">
    <div id="preloader-status">
        <div class="spinner">
            <div class="rect1"></div>
            <div class="rect2"></div>
            <div class="rect3"></div>
            <div class="rect4"></div>
            <div class="rect5"></div>
        </div>
        <div id="preloader-title">Chargement...</div>
    </div>
</div>
<!-- /PRELOADER -->

<!-- WRAPPER-->
<div id="wrapper">

    <!-- HEADER -->
    <header class="header fixed">
        <div class="header-wrapper">

            <div class="container">
                <div class="logo"><a href="#"><img alt="logo-jlma" src="{{ asset('rentit/img/logo-jlma.png') }}"></a> </div>

                <a href="#" class="menu-toggle btn ripple-effect btn-theme-transparent"><i class="fa fa-bars"></i></a>


                <!-- Navigation -->
                <nav class="navigation closed clearfix">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <!-- navigation menu -->
                            <a href="#" class="menu-toggle-close btn"><i class="fa fa-times"></i></a>
                            <ul class="nav sf-menu">
                                @php
                                    $prefix =(isset($home) && $home==true) ? '' :  route('home')
                                @endphp

                                    <li ><a href="{{$prefix}}#find-best">Accueil</a></li>
                                    <li ><a href="{{$prefix}}#who-we-are">A propos</a></li>
                                    <li ><a href="{{ route('showCars') }}">Véhicules</a></li>
                                <li ><a href="#"><span class="badge" style="padding:5px;font-size: 15px;background-color:#5687bf">Mon assurance</span></a></li>

                                    <!-- TODO : Remplacer par espace membres au cas ou un utilisateur est connecté-->
                                    @if( Session::has('client-account-data') )
                                        <li ><a href="{{ route('members') }}">Espace locataires</a></li>
                                        <li ><a href="{{ route('adminDashboard') }}">Admin</a></li>
                                        <li ><a href="{{ route('logout') }}"><span style="color:red">Deconnecter</span></a></li>
                                    @else
                                    <li ><a href="{{ route('members') }}">Login</a></li>
                                    @endif
                                <!-- -->

                                <li>
                                    <ul class="social-icons">
                                        <li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#" class="instagram"><i class="fa fa-instagram"></i></a></li>
                                    </ul>
                                </li>
                            </ul>
                            <!-- /navigation menu -->
                        </div>
                    </div>
                    <!-- Add Scroll Bar -->
                    <div class="swiper-scrollbar"></div>
                </nav>
                <!-- /Navigation -->

            </div>


        </div>
    </header>
    <!-- /HEADER-->

    <div class="content-area">

        @yield('contents' , 'Contenu')

    </div>

    <footer class="footer">
        <div class="footer-meta">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <p class="btn-row text-center">
                            <a href="#" class="btn btn-theme ripple-effect btn-icon-left facebook wow fadeInDown" data-wow-offset="20" data-wow-delay="100ms"><i class="fa fa-facebook"></i>FACEBOOK</a>
                            <a href="#" class="btn btn-theme btn-icon-left ripple-effect twitter wow fadeInDown" data-wow-offset="20" data-wow-delay="200ms"><i class="fa fa-twitter"></i>TWITTER</a>
                            <a href="#" class="btn btn-theme btn-icon-left ripple-effect pinterest wow fadeInDown" data-wow-offset="20" data-wow-delay="300ms"><i class="fa fa-pinterest"></i>PINTEREST</a>
                            <a href="#" class="btn btn-theme btn-icon-left ripple-effect google wow fadeInDown" data-wow-offset="20" data-wow-delay="400ms"><i class="fa fa-google"></i>GOOGLE</a>
                        </p>
                        <div align="center">
                        <img class="img img-responsive" alt="logo-dinov" style="width:150px" src="{{ asset('img/logo-dinov.png') }}">
                        </div>
                        <div class="copyright">&copy; 2018 DINOV - Digital Innovation</div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</div>
<!-- /WRAPPER -->

<!-- JS Global -->
<script src="{{ asset('rentit/plugins/jquery/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('rentit/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('rentit/plugins/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('rentit/plugins/superfish/js/superfish.min.js')  }}"></script>
<script src="{{ asset('rentit/plugins/prettyphoto/js/jquery.prettyPhoto.js')  }}"></script>
<script src="{{ asset('rentit/plugins/owl-carousel2/owl.carousel.min.js')  }}"></script>
<script src="{{ asset('rentit/plugins/jquery.sticky.min.js')  }}"></script>
<script src="{{ asset('rentit/plugins/jquery.easing.min.js')  }}"></script>
<script src="{{ asset('rentit/plugins/jquery.smoothscroll.min.js') }}"></script>
<!--<script src="assets/plugins/smooth-scrollbar.min.js"></script>-->
<!--<script src="assets/plugins/wow/wow.min.js"></script>-->
<script>
    // WOW - animated content
    //new WOW().init();
</script>
<script src="{{ asset('rentit/plugins/swiper/js/swiper.jquery.min.js') }}"></script>
<script src="{{ asset('rentit/plugins/datetimepicker/js/moment-with-locales.min.js')  }}"></script>
<script src="{{ asset('rentit/plugins/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>

<!-- JS Page Level -->
<script type="text/javascript">
    jQuery(window).load(function () { jQuery('body').scrollspy({offset: 100, target: '.navigation'}); });
    jQuery(window).load(function () { jQuery('body').scrollspy('refresh'); });
    jQuery(window).resize(function () { jQuery('body').scrollspy('refresh'); });
    jQuery(window).load(function() {
        if (location.hash != '') {
            var hash = '#' + window.location.hash.substr(1);
            if (hash.length) {
                jQuery('html,body').delay(0).animate({
                    scrollTop: jQuery(hash).offset().top - 44 + 'px'
                }, {
                    duration: 1200,
                    easing: "easeInOutExpo"
                });
            }
        }
    });
</script>
<script src="{{ asset('rentit/js/theme-ajax-mail.js')  }}"></script>
<script src="{{ asset('rentit/js/theme.js') }}"></script>
<script src="{{asset('js/jquery.shuttle.js')}}"></script>
<script src="{{asset('js/jquery.range-min.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>

@yield('ExtraJS')

</body>
</html>