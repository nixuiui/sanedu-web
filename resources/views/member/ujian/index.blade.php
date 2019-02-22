@extends('layouts.admin')

@section('title')
Contoh Soal
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
    @include('member.ujian.tombolatas')
    </div>
</div>
<div class="row row-ujian">
    <div class="col-md-6 col-sm-12 col-lg-4 col-ujian mb-3">
        <div class="card">
            <div class="card-image">
                <span class="card-label-ujian bg-primary">Ujian Sekolah</span>
                <img class="card-img-top" src="{{ asset('image/ujian_tengah_semester.png') }}" alt="Placeholder">
            </div>
            <div class="card-body vertical-align text-center">
                <div class="card-body-content">
                    <div class="row">
                        <div class="col-xs-4 text-center">
                            <div class="mb-1 text-bold">
                                SD
                            </div>
                            <div class="col-button-x">
                                <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1301, 'idJenisUjian' => '1401,1402,1403', 'idKelas' => 1601]) }}" class="btn btn-default btn-kelas">1</a>
                                <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1301, 'idJenisUjian' => '1401,1402,1403', 'idKelas' => 1602]) }}" class="btn btn-default btn-kelas">2</a>
                                <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1301, 'idJenisUjian' => '1401,1402,1403', 'idKelas' => 1603]) }}" class="btn btn-default btn-kelas">3</a>
                            </div>
                            <div class="col-button-x">
                                <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1301, 'idJenisUjian' => '1401,1402,1403', 'idKelas' => 1604]) }}" class="btn btn-default btn-kelas">4</a>
                                <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1301, 'idJenisUjian' => '1401,1402,1403', 'idKelas' => 1605]) }}" class="btn btn-default btn-kelas">5</a>
                                <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1301, 'idJenisUjian' => '1401,1402,1403', 'idKelas' => 1606]) }}" class="btn btn-default btn-kelas">6</a>
                            </div>
                        </div>
                        <div class="col-xs-4 text-center">
                            <div class="mb-1 text-bold">
                                SMP
                            </div>
                            <div class="col-button">
                                <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1302, 'idJenisUjian' => '1401,1402,1403', 'idKelas' => 1607]) }}" class="btn btn-default btn-kelas">7</a>
                                <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1302, 'idJenisUjian' => '1401,1402,1403', 'idKelas' => 1608]) }}" class="btn btn-default btn-kelas">8</a>
                                <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1302, 'idJenisUjian' => '1401,1402,1403', 'idKelas' => 1609]) }}" class="btn btn-default btn-kelas">9</a>
                            </div>
                        </div>
                        <div class="col-xs-4 text-center">
                            <div class="mb-1 text-bold">
                                SMA
                            </div>
                            <div class="col-button">
                                <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1303, 'idJenisUjian' => '1401,1402,1403', 'idKelas' => 1610]) }}" class="btn btn-default btn-kelas">10</a>
                                <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1303, 'idJenisUjian' => '1401,1402,1403', 'idKelas' => 1611]) }}" class="btn btn-default btn-kelas">11</a>
                                <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1303, 'idJenisUjian' => '1401,1402,1403', 'idKelas' => 1612]) }}" class="btn btn-default btn-kelas">12</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-sm-12 col-lg-4 col-ujian mb-3">
        <div class="card">
            <div class="card-image">
                <span class="card-label-ujian bg-primary">SBMPTN</span>
                <img class="card-img-top" src="{{ asset('image/ujian_sbmptn.png') }}" alt="Placeholder">
            </div>
            <div class="card-body vertical-align text-center">
                <div class="card-body-content">
                    <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1303, 'idJenisUjian' => 1404]) }}" class="btn btn-lg btn-default">PILIH UJIAN</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12 col-lg-4 col-ujian mb-3">
        <div class="card">
            <div class="card-image">
                <span class="card-label-ujian bg-primary">STAN</span>
                <img class="card-img-top" src="{{ asset('image/ujian_stan.png') }}" alt="Placeholder">
            </div>
            <div class="card-body vertical-align text-center">
                <div class="card-body-content">
                    <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1303, 'idJenisUjian' => 1405]) }}" class="btn btn-lg btn-default">PILIH UJIAN</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12 col-lg-4 col-ujian mb-3">
        <div class="card">
            <div class="card-image">
                <span class="card-label-ujian bg-primary">POLTEKES</span>
                <img class="card-img-top" src="{{ asset('image/ujian_poltekes.png') }}" alt="Placeholder">
            </div>
            <div class="card-body vertical-align text-center">
                <div class="card-body-content">
                    <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1303, 'idJenisUjian' => 1406]) }}" class="btn btn-lg btn-default">PILIH UJIAN</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12 col-lg-4 col-ujian mb-3">
        <div class="card">
            <div class="card-image">
                <span class="card-label-ujian bg-primary">POLITEKNIK</span>
                <img class="card-img-top" src="{{ asset('image/ujian_politeknik.png') }}" alt="Placeholder">
            </div>
            <div class="card-body vertical-align text-center">
                <div class="card-body-content">
                    <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1303, 'idJenisUjian' => 1407]) }}" class="btn btn-lg btn-default">PILIH UJIAN</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12 col-lg-4 col-ujian mb-3">
        <div class="card">
            <div class="card-image">
                <span class="card-label-ujian bg-primary">STIS</span>
                <img class="card-img-top" src="{{ asset('image/ujian_stis.png') }}" alt="Placeholder">
            </div>
            <div class="card-body vertical-align text-center">
                <div class="card-body-content">
                    <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1303, 'idJenisUjian' => 1408]) }}" class="btn btn-lg btn-default">PILIH UJIAN</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12 col-lg-4 col-ujian mb-3">
        <div class="card">
            <div class="card-image">
                <span class="card-label-ujian bg-primary">KEDINASAN</span>
                <img class="card-img-top" src="{{ asset('image/ujian_kedinasan.png') }}" alt="Placeholder">
            </div>
            <div class="card-body vertical-align text-center">
                <div class="card-body-content">
                    <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1303, 'idJenisUjian' => 1409]) }}" class="btn btn-lg btn-default">PILIH UJIAN</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
