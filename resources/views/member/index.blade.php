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
<div class="panel panel-default panel-saldo visible-xs visible-sm">
    <div class="heading border-bottom" style="border-bottom: 1px solid #DDD;">
        <span class="label-saldo">Saldoku</span>
        <span class="amount-saldo">{{ formatUang(Auth::user()->saldo) }}</span>
    </div>
    <div class="panel-body p-0">
        <div class="row">
            <div class="col-xs-4 text-center pt-3 pb-3 ph-5">
                <a href="{{ route('member.saldo') }}" style="color: #000; display: block">
                    <img src="{{ asset('image/icon_topup.svg') }}" style="width:30px; margin-bottom: 10px;">
                    <div>Topup</div>
                </a>
            </div>
            <div class="col-xs-4 text-center pt-3 pb-3 ph-5">
                <a href="{{ route('member.saldo') }}" style="color: #000; display: block">
                    <img src="{{ asset('image/icon_history.svg') }}" style="width:30px; margin-bottom: 10px;">
                    <div>History</div>
                </a>
            </div>
            <div class="col-xs-4 text-center pt-3 pb-3 ph-5">
                <img src="{{ asset('image/icon_topup.svg') }}" style="width:30px; margin-bottom: 10px; opacity: 0.2">
                <div>Transfer</div>
            </div>
        </div>
    </div>
</div>
<div class="row menu-utama">
    <div class="col-md-3 col-sm-6 col-xs-6">
        <a href="{{ route('member.ujian.soal') }}" class="menu-item">
            <img class="menu-icon" src="{{ asset('asset-member/img/menu_ujian.png') }}" alt="">
            <div class="menu-title">Contoh Soal</div>
        </a>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-6">
        <a href="{{ route('member.informasi') }}" class="menu-item">
            <img class="menu-icon" src="{{ asset('asset-member/img/menu_informasi.png') }}" alt="">
            <div class="menu-title">Informasi</div>
        </a>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-6">
        <a href="{{ route('member.passgrade') }}" class="menu-item">
            <img class="menu-icon" src="{{ asset('asset-member/img/menu_informasi.png') }}" alt="">
            <div class="menu-title">Passing Grade</div>
        </a>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-6">
        <a href="{{ route('member.simulasi') }}" class="menu-item">
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
    {{-- <div class="col-md-3 col-sm-6 col-xs-6">
        <a href="{{ route('member.grupchat') }}" class="menu-item">
            <img class="menu-icon" src="{{ asset('asset-member/img/menu_grupchat.png') }}" alt="">
            <div class="menu-title">Konsultasi</div>
        </a>
    </div> --}}
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
