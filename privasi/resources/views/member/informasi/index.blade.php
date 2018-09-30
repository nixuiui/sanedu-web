@extends('layouts.admin')

@section('title')
Informasi
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
<div class="main-gallery" style="border-radius: 15px;">
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
<hr>
<ul class="nav nav-pills nav-justified mb-5 nav-informasi">
    <li role="presentation" class="{{ isset($_GET['kategori']) && $_GET['kategori'] == 1701 ? "active" : "" }}"><a href="{{ route('member.informasi', ['kategori' => '1701']) }}">Beasiswa</a></li>
    <li role="presentation" class="{{ isset($_GET['kategori']) && $_GET['kategori'] == 1702 ? "active" : "" }}"><a href="{{ route('member.informasi', ['kategori' => '1702']) }}">Universitas</a></li>
    <li role="presentation" class="{{ isset($_GET['kategori']) && $_GET['kategori'] == 1703 ? "active" : "" }}"><a href="{{ route('member.informasi', ['kategori' => '1703']) }}">Prospek Kerja</a></li>
    <li role="presentation" class="{{ route('member.passgrade') }}"><a href="{{ route('member.passgrade') }}">PG</a></li>
</ul>
<div class="row">
    @foreach($informasi as $info)
    <div class="col-md-6 col-lg-4">
        <div class="card mb-3 mb-5">
            <img class="card-img-top fix-height" src="{{ $info->foto_url }}" alt="Placeholder">
            <div class="card-header">{{ $info->judul }}</div>
            <div class="card-body">
                <a class="card-link" href="{{ route('member.informasi.view', $info->id) }}">Baca Selengkapnya</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
{{ $informasi->links() }}
@endsection
