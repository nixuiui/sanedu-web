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
    <div class="col-md-3 col-sm-6 col-xs-6 mb-4">
        <a href="{{ route('member.ujian.soal') }}" class="menu-item">
            <img class="menu-icon" src="{{ asset('image/landing/latihan_kotak.png') }}" alt="">
            <div class="menu-title">Latihan Soal</div>
        </a>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-6 mb-4">
        <a href="{{ route('member.passgrade') }}" class="menu-item">
            <img class="menu-icon" src="{{ asset('image/landing/pg_kotak.png') }}" alt="">
            <div class="menu-title">Passing Grade</div>
        </a>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-6 mb-4">
        <a href="{{ route('member.simulasi') }}" class="menu-item">
            <img class="menu-icon" src="{{ asset('image/landing/event_kotak.png') }}" alt="">
            <div class="menu-title">Event</div>
        </a>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-6 mb-4">
        <a href="#" class="menu-item">
            <img class="menu-icon" src="{{ asset('image/landing/rasional_kotak.png') }}" alt="">
            <div class="menu-title">Rasionalisasi</div>
        </a>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-6 mb-4">
        <a href="#" class="menu-item">
            <img class="menu-icon" src="{{ asset('image/landing/pendam_kotak.png') }}" alt="">
            <div class="menu-title">Pendampingan Belajar</div>
        </a>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-6 mb-4">
        <a href="#" class="menu-item">
            <img class="menu-icon" src="{{ asset('image/landing/pg_kotak.png') }}" alt="">
            <div class="menu-title">Jungle Book</div>
        </a>
    </div>
    {{-- <div class="col-md-3 col-sm-6 col-xs-6 mb-4">
        <a href="{{ route('member.grupchat') }}" class="menu-item">
            <img class="menu-icon" src="{{ asset('asset-member/img/menu_grupchat.png') }}" alt="">
            <div class="menu-title">Konsultasi</div>
        </a>
    </div> --}}
</div>
@endsection
