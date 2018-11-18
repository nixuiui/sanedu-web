@extends('layouts.admin')

@section('title')
Contoh Soal
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        @include('member.ujian.tombolatas')
        @if($filter->count() > 0)
        @if(isset($_GET['idSekolah']) && $_GET['idSekolah'] == 1303 && isset($_GET['idJenisUjian']) && ($_GET['idJenisUjian'] == 1401 || $_GET['idJenisUjian'] == 1402 || $_GET['idJenisUjian'] == 1403))
        <div class="btn-group btn-hspace btn-space">
            <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle" aria-expanded="false">
                {{ isset($_GET['jurusan']) && $_GET['jurusan'] != null ? $_GET['jurusan'] : "Pilih Jurusan SMA" }} <span class="icon-dropdown mdi mdi-chevron-down"></span>
            </button>
            <ul role="menu" class="dropdown-menu">
                <li><a href="{{ route('member.ujian.soal.list', [
                    'idSekolah' => isset($_GET['idSekolah']) && $_GET['idSekolah'] != null ? $_GET['idSekolah'] : "",
                    'idJenisUjian' => isset($_GET['idJenisUjian']) && $_GET['idJenisUjian'] != null ? $_GET['idJenisUjian'] : "",
                    'idKelas' => isset($_GET['idKelas']) && $_GET['idKelas'] != null ? $_GET['idKelas'] : ""
                    ]) }}">Semua Jurusan SMA</a>
                </li>
                <li><a href="{{ route('member.ujian.soal.list', [
                    'idSekolah' => isset($_GET['idSekolah']) && $_GET['idSekolah'] != null ? $_GET['idSekolah'] : "",
                    'idJenisUjian' => isset($_GET['idJenisUjian']) && $_GET['idJenisUjian'] != null ? $_GET['idJenisUjian'] : "",
                    'idKelas' => isset($_GET['idKelas']) && $_GET['idKelas'] != null ? $_GET['idKelas'] : "",
                    'jurusan' => 'IPA'
                    ]) }}">IPA</a>
                </li>
                <li><a href="{{ route('member.ujian.soal.list', [
                    'idSekolah' => isset($_GET['idSekolah']) && $_GET['idSekolah'] != null ? $_GET['idSekolah'] : "",
                    'idJenisUjian' => isset($_GET['idJenisUjian']) && $_GET['idJenisUjian'] != null ? $_GET['idJenisUjian'] : "",
                    'idKelas' => isset($_GET['idKelas']) && $_GET['idKelas'] != null ? $_GET['idKelas'] : "",
                    'jurusan' => 'IPS'
                    ]) }}">IPS</a>
                </li>
            </ul>
        </div>
        @endif
        @if(count($mapel) > 0)
        <div class="btn-group btn-hspace btn-space">
            <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle" aria-expanded="false">
                {{ $mapelSelect == null ? "Pilih Mata Pelajaran" : $mapelSelect->nama }} <span class="icon-dropdown mdi mdi-chevron-down"></span>
            </button>
            <ul role="menu" class="dropdown-menu">
                <li><a href="{{ route('member.ujian.soal.list', [
                    'idSekolah' => isset($_GET['idSekolah']) && $_GET['idSekolah'] != null ? $_GET['idSekolah'] : "",
                    'idJenisUjian' => isset($_GET['idJenisUjian']) && $_GET['idJenisUjian'] != null ? $_GET['idJenisUjian'] : "",
                    'idKelas' => isset($_GET['idKelas']) && $_GET['idKelas'] != null ? $_GET['idKelas'] : ""
                    ]) }}">Semua Mata Pelajaran</a>
                </li>
                @foreach($mapel as $pelajaran)
                <li><a href="{{ route('member.ujian.soal.list', [
                    'idSekolah' => isset($_GET['idSekolah']) && $_GET['idSekolah'] != null ? $_GET['idSekolah'] : "",
                    'idJenisUjian' => isset($_GET['idJenisUjian']) && $_GET['idJenisUjian'] != null ? $_GET['idJenisUjian'] : "",
                    'idKelas' => isset($_GET['idKelas']) && $_GET['idKelas'] != null ? $_GET['idKelas'] : "",
                    'idMataPelajaran' => $pelajaran->id
                    ]) }}">{{ $pelajaran->nama }}</a>
                </li>
                @endforeach
            </ul>
        </div>
        @endif
        <div role="alert" class="alert alert-primary alert-icon alert-icon-border alert-dismissible">
            <div class="icon"><span class="mdi mdi-info-outline"></span></div>
            <div class="message">
                <strong>Filter</strong>
                @foreach($filter as $key => $fil)
                {{ $key > 0 ? ", " : ""}}
                {{ $fil->kategori->nama }} :
                {{ $fil->nama }}
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
<div class="row">
    @if($ujian->count() <= 0)
    <div class="col-lg-3 col-md-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="data-is-empty">
                    <i class="mdi mdi-close-circle"></i>
                    Ujian Belum Ada
                </div>
            </div>
        </div>
    </div>
    @else
    @foreach($ujian as $data)
    <div class="col-lg-3 col-md-4 col-ujian mb-3">
        <div class="card">
            <div class="card-image">
                {{-- <span class="card-label-ujian bg-primary">{{ $data->mataPelajaran->nama . ": " . $data->tingkatSekolah->nama }} {{ $data->id_tingkat_kelas == null ? "" : "Kelas " . $data->tingkatKelas->nama }}</span> --}}
                @if($data->mataPelajaran->image == null)
                <img class="card-img-top" src="http://localhost/sanedu/public/asset-beagle/img/empty.png" alt="Placeholder">
                @else
                <img class="" src="{{ asset('image/' . $data->mataPelajaran->image) }}" alt="Placeholder">
                @endif
                <div class="card-label-ujian-bottom bg-primary">
                    <div class="row">
                        <div class="col-md-6 text-ellipsis">
                            {{ $data->mataPelajaran->nama }} <br>
                        </div>
                        <div class="col-md-6 text-ellipsis text-right">
                            SOAL: {{ $data->jumlah_soal }}
                        </div>
                        <div class="col-md-12">
                            {{ $data->tingkatSekolah->nama . ": " . $data->judul }}
                        </div>
                    </div>
                </div>
            </div>
            @if($data->diBeliOleh->where('id', Auth::id())->first() == null)
            <div class="card-body row vertical-align">
                <div class="col-xs-8 ujian-info">
                    <div class="text-success text-bold">
                        {{ $data->harga == 0 ? "GRATIS" : "Harga: " . formatUang($data->harga) }}
                    </div>
                </div>
                <div class="col-xs-4">
                    <a href="{{ route('member.ujian.soal.preattempt', $data->id) }}" class="btn btn-sm btn-success pull-right">Beli Soal</a>
                </div>
            </div>
            @else
            <div class="card-body row vertical-align">
                <div class="col-xs-8 ujian-info">
                    <div class="text-info">
                        Nilai Anda: <strong>{{ $data->attempt->count() > 0 ? round(($data->attempt->last()->jumlah_benar / $data->soal->count())*100, 2) : "-" }}</strong> <br>
                        <a href="#" class="text-link"><i class="mdi mdi-download mr-2"></i>Download Pembahasan</a>
                    </div>
                </div>
                <div class="col-xs-4">
                    <a href="{{ route('member.ujian.soal.preattempt', $data->id) }}" class="btn btn-sm btn-primary pull-right">Buka</a>
                </div>
            </div>
            @endif
        </div>
    </div>
    @endforeach
    @endif
</div>
@endsection
