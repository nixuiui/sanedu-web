<head>
    @include('partials.include.google')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- =========================
    favicon and app touch icon
    ============================== -->
    <link rel="shortcut icon" href="{{ asset('asset-landing/img/main/favicon.png')}}"/>
    <link rel="apple-touch-icon" href="{{ asset('asset-landing/img/main/sanedu-touch.png')}}"/>
    <title>@yield('title') - Sanedu</title>
    {{ addStyle('asset-beagle/lib/perfect-scrollbar/css/perfect-scrollbar.min.css') }}
    {{ addStyle('asset-beagle/lib/material-design-icons/css/material-design-iconic-font.min.css') }}
    {{ addStyle('asset-beagle/lib/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}
    {{ addStyle('asset-beagle/lib/jqvmap/jqvmap.min.css') }}
    {{ addStyle('asset-beagle/lib/select2/css/select2.min.css') }}
    {{ addStyle('asset-beagle/lib/bootstrap-slider/css/bootstrap-slider.css') }}
    {{ addStyle('asset-beagle/lib/datatables/css/dataTables.bootstrap.min.css') }}
    {{ addStyle('asset-beagle/css/style.css') }}
    {{ addStyle('asset-beagle/css/custom.css') }}
    @yield('style')
    <script src="{{ asset('asset-beagle/lib/jquery/jquery.min.js') }}" type="text/javascript"></script>
</head>
<!-- END HEAD -->
