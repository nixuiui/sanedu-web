<!DOCTYPE html>
<html class="no-js" lang="en-US">
<head>
    @include('partials.include.google')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SITE TITLE -->
    <title>@yield('title') - SANEDU</title>

    <!-- =========================
    Meta Information
    ============================== -->
    <meta name="description" content="SANEDU - Generasi cerdas bersama SANEDU">
    <meta name="keywords" content="SAN, EDU, SANEDU, GENERASI CERDAS, Belajar, Kursus, UNBK, UN, Tes">
    <meta name="author" content="Arie Kurniawan">

    <!-- =========================
    favicon and app touch icon
    ============================== -->
    <link rel="shortcut icon" href="{{ asset('asset-landing/img/main/favicon.png')}}"/>
    <link rel="apple-touch-icon" href="{{ asset('asset-landing/img/main/sanedu-touch.png')}}"/>


    <!-- =========================
    Bootstrap and animation
    ============================== -->
    <link rel="stylesheet" href="{{ asset('asset-landing/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('asset-landing/css/animate.min.css')}}">

    <!-- =========================
    Fonts, typography and icons
    ============================== -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('asset-landing/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{ asset('asset-landing/css/typography.css')}}">

    <!-- =========================
    Carousel, lightbox and circle generator
    ============================== -->
    <link rel="stylesheet" href="{{ asset('asset-landing/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{ asset('asset-landing/css/owl.theme.css')}}">
    <link rel="stylesheet" href="{{ asset('asset-landing/css/nivo-lightbox.css')}}">
    <link rel="stylesheet" href="{{ asset('asset-landing/css/nivo-lightbox-default.css')}}">
    <link rel="stylesheet" href="{{ asset('asset-landing/css/jquery.circliful.css')}}">

    <!-- ***** Custom Stylesheet ***** -->
    <link rel="stylesheet" href="{{ asset('asset-landing/css/main.css')}}">

    <!-- ***** Responsive fixes ***** -->
    <link rel="stylesheet" href="{{ asset('asset-landing/css/responsive.css')}}">

    <link rel="stylesheet" href="{{ asset('asset-landing/css/mycss.css')}}">

    @yield('style')
</head>
<body>
    <!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <div class="panel-top">
        <ul>
            <li class="logo">
                <a href="{{ route('guest.home') }}">
                    <img src="{{ asset('asset-landing/img/main/logo-header.png')}}">
                    <span class="label">San Edu</span>
                </a>
            </li>
            <li class="logo right">
                <a href="https://api.whatsapp.com/send?phone=6282175992746" target="_blank">
                    <img src="{{ asset('asset-landing/img/main/wa.png')}}">
                    <span class="label">0821-7599-2746</span>
                </a>
            </li>
            <li class="logo right">
                <a href="{{ route('guest.home') }}">
                    <img src="{{ asset('asset-landing/img/main/web.png')}}">
                    <span class="label">www.sanedu.id</span>
                </a>
            </li>
            <li class="logo right">
                <a href="http://line.me/ti/p/~san_edu" target="_blank">
                    <img src="{{ asset('asset-landing/img/main/line.png')}}">
                    <span class="label">@san_edu</span>
                </a>
            </li>
            <li class="logo right">
                <a href="https://instagram.com/saneedu" target="_blank">
                    <img src="{{ asset('asset-landing/img/main/ig.png')}}">
                    <span class="label">@saneedu</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="mobilenav">
        <div class="mobnav">
            <ul>
                <li>
                    <span class="nav-label"><a href="{{ route('guest.home') }}" style="color: #fff;" target="_top">Home</a></span>
                </li>
                <li>
                    <span class="nav-label"><a href="{{ route('guest.tentang') }}" style="color: #fff;" target="_top">Tentang SAN</a></span>
                </li>
                <li>
                    <span class="nav-label"><a href="{{ route('guest.hubungi') }}" style="color: #fff;" target="_top">Kontak</a></span>
                </li>
                @if(Auth::check())
                <li>
                    @if(Auth::user()->id_role == 1001)
                    <span class="nav-label"><a href="{{ route('superadmin') }}" style="color: #fff;" target="_top">Dashboard</a></span>
                    @elseif(Auth::user()->id_role == 1002)
                    <span class="nav-label"><a href="{{ route('admin') }}" style="color: #fff;" target="_top">Dashboard</a></span>
                    @elseif(Auth::user()->id_role == 1003)
                    <span class="nav-label"><a href="{{ route('admintiket') }}" style="color: #fff;" target="_top">Dashboard</a></span>
                    @elseif(Auth::user()->id_role == 1004)
                    <span class="nav-label"><a href="{{ route('member') }}" style="color: #fff;" target="_top">Dashboard</a></span>
                    @elseif(Auth::user()->id_role == 1006)
                    <span class="nav-label"><a href="{{ route('admin.ujian') }}" style="color: #fff;" target="_top">Dashboard</a></span>
                    @elseif(Auth::user()->id_role == 1007)
                    <span class="nav-label"><a href="{{ route('adminsimulasi') }}" style="color: #fff;" target="_top">Dashboard</a></span>
                    @elseif(Auth::user()->id_role == 1008)
                    <span class="nav-label"><a href="{{ route('pengawas') }}" style="color: #fff;" target="_top">Dashboard</a></span>
                    @endif
                </li>
                <li>
                    <span class="nav-label"><a href="{{ route('auth.logout') }}" style="color: #fff;" target="_top">Logout</a></span>
                </li>
                @else
                <li>
                    <span class="nav-label"><a href="{{ route('auth.login') }}" style="color: #fff;" target="_top">Login</a></span>
                </li>
                @endif
            </ul>
        </div>
    </div>
    <a href="javascript:void(0)" class="menu-trigger" target="_top">
        <div class="hamburger">
            <div class="menui top-menu"></div>
            <div class="menui mid-menu"></div>
            <div class="menui bottom-menu"></div>
        </div>
    </a>


    @yield('content')

    <!-- =========================
    JavaScripts
    ============================== -->
    <script src="{{ asset('asset-landing/js/vendor/jquery-1.11.1.js')}}"></script>
    <script src="{{ asset('asset-landing/js/vendor/jquery-migrate-1.2.1.min.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAt_YQXXxAQyeysSeo2OX95yyw9YaJGpV8"></script>
    <script src="{{ asset('asset-landing/js/twitterFetcher_min.js')}}"></script>
    <script src="{{ asset('asset-landing/js/vendor/bootstrap.js')}}"></script>
    <script src="{{ asset('asset-landing/js/wow.min.js')}}"></script>
    <script src="{{ asset('asset-landing/js/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{ asset('asset-landing/js/jquery.easing.min.js')}}"></script>
    <script src="{{ asset('asset-landing/js/appear.js')}}"></script>
    <script src="{{ asset('asset-landing/js/jquery.circliful.min.js')}}"></script>
    <script src="{{ asset('asset-landing/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('asset-landing/js/nivo-lightbox.min.js')}}"></script>
    <script src="{{ asset('asset-landing/js/isotope.pkgd.min.js')}}"></script>
    <script src="{{ asset('asset-landing/js/main.js')}}"></script>
</body>
</html>
