<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.include.google')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Sanedu</title>
    
    <!-- =========================
    favicon and app touch icon
    ============================== -->
    <link rel="shortcut icon" href="{{ asset('asset-landing/img/main/favicon.png')}}"/>
    <link rel="apple-touch-icon" href="{{ asset('asset-landing/img/main/sanedu-touch.png')}}"/>
    
    <link rel="stylesheet" type="text/css" href="{{ asset('asset-sanone/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset-sanone/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset-sanone/css/iofrm-style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset-sanone/css/iofrm-theme4.css') }}">
</head>
<body>
    <div class="form-body bg-header">
        <div class="website-logo">
            <a href="{{ route('guest.home') }}">
                <div class="logo">
                    <strong style="font-weight: 900">SANEDU</strong>
                    {{-- <img class="logo-size" src="{{ asset('asset-sanone/images/logo-light.svg') }}" alt=""> --}}
                </div>
            </a>
        </div>
        <div class="row">
            <div class="img-holder" style="background: transparent">
                <div class="bg"></div>
                <div class="info-holder">
                    <img src="{{ asset('asset-sanone/images/graphic3.svg') }}" alt="">
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>Selamat Datang di SANEDU.</h3>
                        <p>Bimbingan belajar pertama yang mengusung metode multiple intelegence system dan e-learning.</p>
                        <form action="{{ route('auth.login.post') }}" method="POST">
                            @csrf
                            <input class="form-control" type="text" name="username" placeholder="Email/Username" required>
                            <input class="form-control" type="password" name="password" placeholder="Password" required>
                            <div class="form-button">
                                <button id="submit" type="submit" class="ibtn">Masuk</button> <a href="{{ route('auth.password.forgot') }}">Lupa password?</a>
                            </div>
                        </form>
                        <div class="other-links">
                            <span>Belum punya akun?</span><a href="{{ route('auth.register') }}">Daftar Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('asset-sanone/js/jquery.min.js')}}"></script>
<script src="{{ asset('asset-sanone/js/popper.min.js')}}"></script>
<script src="{{ asset('asset-sanone/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('asset-sanone/js/main.js')}}"></script>
</html>
