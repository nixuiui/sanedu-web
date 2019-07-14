@extends('layouts.adminfull')

@section('title')
Beranda
@endsection

@section('style')
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
@endsection

@section('script')
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.main-gallery').slick({
        autoplay: true,
        autoplayspeed: 5000
    });
});
</script>
@endsection

@section('content')
<div class="main-gallery" style="margin-bottom: 25px;">
    <div class="gallery-cell">
        <img width="100%" alt="First slide [800x400]" src="{{ asset('asset-member/img/banner3.jpg') }}">
    </div>
    <div class="gallery-cell">
        <img width="100%" alt="First slide [800x400]" src="{{ asset('asset-member/img/banner1.jpg') }}">
    </div>
    <div class="gallery-cell">
        <img width="100%" alt="First slide [800x400]" src="{{ asset('asset-member/img/banner2.jpg') }}">
    </div>
</div>
<div class="row menu-utama">
    <div class="col-md-3 col-sm-6 col-xs-6">
        <a href="{{ route('member.ujian.soal') }}" class="menu-item new-fitur">
            <img class="menu-icon" src="{{ asset('asset-member/img/menu_ujian.png') }}" alt="">
            <div class="menu-title">Contoh Soal</div>
        </a>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-6">
        <a href="{{ route('member.informasi') }}" class="menu-item new-fitur">
            <img class="menu-icon" src="{{ asset('asset-member/img/menu_informasi.png') }}" alt="">
            <div class="menu-title">Informasi</div>
        </a>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-6">
        <a href="#" class="menu-item maintenance-fitur">
            <img class="menu-icon" src="{{ asset('asset-member/img/menu_informasi.png') }}" alt="">
            <div class="menu-title">Passing Grade</div>
        </a>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-6">
        <a href="{{ route('member.simulasi') }}" class="menu-item new-fitur">
            <img class="menu-icon" src="{{ asset('asset-member/img/menu_simulasi.png') }}" alt="">
            <div class="menu-title">Simulasi</div>
        </a>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-6 hide">
        <span href="#" class="menu-item soon-fitur">
            <img class="menu-icon" src="{{ asset('asset-member/img/menu_games.png') }}" alt="">
            <div class="menu-title">Games</div>
        </span>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-6 hide">
        <span href="#" class="menu-item soon-fitur">
            <img class="menu-icon" src="{{ asset('asset-member/img/menu_privat.png') }}" alt="">
            <div class="menu-title">Privat</div>
        </span>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-6">
        <a href="{{ route('member.grupchat') }}" class="menu-item new-fitur">
            <img class="menu-icon" src="{{ asset('asset-member/img/menu_grupchat.png') }}" alt="">
            <div class="menu-title">Konsultasi</div>
        </a>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-6 hide">
        <span href="#" class="menu-item soon-fitur">
            <img class="menu-icon" src="{{ asset('asset-member/img/menu_poin.png') }}" alt="">
            <div class="menu-title">Point</div>
        </span>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-6 hide">
        <span href="#" class="menu-item soon-fitur">
            <img class="menu-icon" src="{{ asset('asset-member/img/menu_sanmodul.png') }}" alt="">
            <div class="menu-title">SANMODUL</div>
        </span>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-6 hide">
        <span href="#" class="menu-item soon-fitur">
            <img class="menu-icon" src="{{ asset('asset-member/img/menu_sanlator.png') }}" alt="">
            <div class="menu-title">SANLATOR</div>
        </span>
    </div>
</div>
@endsection
