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
    <link rel="shortcut icon" href="{{ asset('asset-landing/img/main/favico.ico')}}"/>
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

    <!-- Header scripts -->
    <script src="{{ asset('asset-landing/js/vendor/modernizr-2.8.3.min.js')}}"></script>
    <script src="{{ asset('asset-landing/js/queryloader2.min.js')}}"></script>

    @yield('style')
</head>
<body>
    @yield('content')
</body>
</html>
