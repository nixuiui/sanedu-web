@extends('layouts.admin')

@section('title')
Passing Grade
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
    <div class="col-md-3">
        <form class="panel panel-default" action="" method="get">
            <div class="panel-body">
                <div class="form-group">
                    <label>Jurusan*</label>
                    <select class="form-control input-sm" name="jurusan">
                        <option value="">Semua Jurusan</option>
                        <option value="saintek" {{ isset($_GET['jurusan']) && $_GET['jurusan'] == "saintek" ? "selected" : ""}}>Saintek</option>
                        <option value="soshum" {{ isset($_GET['jurusan']) && $_GET['jurusan'] == "soshum" ? "selected" : ""}}>Soshum</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Nama Universitas*</label>
                    <select class="form-control input-sm" name="universitas">
                        <option value="">Pilih Universitas</option>
                        @foreach($universitas as $data)
                        <option value="{{ $data->id }}" {{ isset($_GET['universitas']) && $_GET['universitas'] == $data->id ? "selected" : ""}}>{{ $data->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-md btn-primary btn-block">Lihat Passing Grade</button>
            </div>
        </form>
    </div>
    @if(isset($jurusan))
    <div class="col-md-9">
        <div class="panel panel-default panel-table">
            <div class="panel-heading">
            </div>
            <div class="panel-body table-responsive noSwipe">
                <table id="datatables" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Jurusan</th>
                            <th class="text-center">Kuota</th>
                            <th class="text-center">Peminat</th>
                            <th class="text-center">Pass Grade</th>
                            <th class="text-center">Akreditasi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Jurusan</th>
                            <th class="text-center">Kuota</th>
                            <th class="text-center">Peminat</th>
                            <th class="text-center">Pass Grade</th>
                            <th class="text-center">Akreditasi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($jurusan as $no => $w)
                        <tr>
                            <td>{{ $no+1 }}</td>
                            <td>{{ $w->jurusan }}</td>
                            <td class="text-center">{{ $w->kuota }}</td>
                            <td class="text-center">{{ $w->peminat }}</td>
                            <td class="text-center">{{ $w->passing_grade }}</td>
                            <td class="text-center">{{ $w->akreditasi }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
