@extends('layouts.admin')

@section('title')
Ujian
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
    @include('member.ujian.tombolatas')
    </div>
</div>
<div class="row row-ujian">
    <div class="col-md-4 col-ujian mb-3">
        <div class="card">
            <div class="card-image">
                <span class="card-label-ujian bg-primary">Ujian Nasional</span>
                <img class="card-img-top" src="{{ asset('asset-member/img/un.jpg') }}" alt="Placeholder">
            </div>
            <div class="card-body vertical-align text-center">
                <div class="card-body-content">
                    <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1301, 'idJenisUjian' => 1401]) }}" class="btn btn-lg btn-default">SD</a>
                    <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1302, 'idJenisUjian' => 1401]) }}" class="btn btn-lg btn-default">SMP</a>
                    <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1303, 'idJenisUjian' => 1401]) }}" class="btn btn-lg btn-default">SMA</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-ujian mb-3">
        <div class="card">
            <div class="card-image">
                <span class="card-label-ujian bg-primary">Ujian Tengah Semester</span>
                <img class="card-img-top" src="{{ asset('asset-member/img/uts.jpg') }}" alt="Placeholder">
            </div>
            <div class="card-body vertical-align text-center">
                <div class="card-body-content">
                    <div class="row">
                        <div class="col-xs-4 text-center">
                            <div class="mb-1 text-bold">
                                SD
                            </div>
                            <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1301, 'idJenisUjian' => 1402, 'idKelas' => 1601]) }}" class="btn btn-default">1</a>
                            <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1301, 'idJenisUjian' => 1402, 'idKelas' => 1602]) }}" class="btn btn-default">2</a><br>
                            <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1301, 'idJenisUjian' => 1402, 'idKelas' => 1603]) }}" class="btn btn-default">3</a>
                            <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1301, 'idJenisUjian' => 1402, 'idKelas' => 1604]) }}" class="btn btn-default">4</a><br>
                            <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1301, 'idJenisUjian' => 1402, 'idKelas' => 1605]) }}" class="btn btn-default">5</a>
                            <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1301, 'idJenisUjian' => 1402, 'idKelas' => 1606]) }}" class="btn btn-default">6</a>
                        </div>
                        <div class="col-xs-4 text-center">
                            <div class="mb-1 text-bold">
                                SMP
                            </div>
                            <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1302, 'idJenisUjian' => 1402, 'idKelas' => 1607]) }}" class="btn btn-default">7</a><br>
                            <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1302, 'idJenisUjian' => 1402, 'idKelas' => 1608]) }}" class="btn btn-default">8</a><br>
                            <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1302, 'idJenisUjian' => 1402, 'idKelas' => 1609]) }}" class="btn btn-default">9</a>
                        </div>
                        <div class="col-xs-4 text-center">
                            <div class="mb-1 text-bold">
                                SMA
                            </div>
                            <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1303, 'idJenisUjian' => 1402, 'idKelas' => 1610]) }}" class="btn btn-default">10</a><br>
                            <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1303, 'idJenisUjian' => 1402, 'idKelas' => 1611]) }}" class="btn btn-default">11</a><br>
                            <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1303, 'idJenisUjian' => 1402, 'idKelas' => 1612]) }}" class="btn btn-default">12</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-ujian mb-3">
        <div class="card">
            <div class="card-image">
                <span class="card-label-ujian bg-primary">Ujian Semester</span>
                <img class="card-img-top" src="{{ asset('asset-member/img/us.jpg') }}" alt="Placeholder">
            </div>
            <div class="card-body vertical-align text-center">
                <div class="card-body-content">
                    <div class="row">
                        <div class="col-xs-4 text-center">
                            <div class="mb-1 text-bold">
                                SD
                            </div>
                            <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1301, 'idJenisUjian' => 1403, 'idKelas' => 1601]) }}" class="btn btn-default">1</a>
                            <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1301, 'idJenisUjian' => 1403, 'idKelas' => 1602]) }}" class="btn btn-default">2</a><br>
                            <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1301, 'idJenisUjian' => 1403, 'idKelas' => 1603]) }}" class="btn btn-default">3</a>
                            <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1301, 'idJenisUjian' => 1403, 'idKelas' => 1604]) }}" class="btn btn-default">4</a><br>
                            <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1301, 'idJenisUjian' => 1403, 'idKelas' => 1605]) }}" class="btn btn-default">5</a>
                            <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1301, 'idJenisUjian' => 1403, 'idKelas' => 1606]) }}" class="btn btn-default">6</a>
                        </div>
                        <div class="col-xs-4 text-center">
                            <div class="mb-1 text-bold">
                                SMP
                            </div>
                            <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1302, 'idJenisUjian' => 1403, 'idKelas' => 1607]) }}" class="btn btn-default">7</a><br>
                            <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1302, 'idJenisUjian' => 1403, 'idKelas' => 1608]) }}" class="btn btn-default">8</a><br>
                            <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1302, 'idJenisUjian' => 1403, 'idKelas' => 1609]) }}" class="btn btn-default">9</a>
                        </div>
                        <div class="col-xs-4 text-center">
                            <div class="mb-1 text-bold">
                                SMA
                            </div>
                            <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1303, 'idJenisUjian' => 1403, 'idKelas' => 1610]) }}" class="btn btn-default">10</a><br>
                            <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1303, 'idJenisUjian' => 1403, 'idKelas' => 1611]) }}" class="btn btn-default">11</a><br>
                            <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1303, 'idJenisUjian' => 1403, 'idKelas' => 1612]) }}" class="btn btn-default">12</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-ujian mb-3">
        <div class="card">
            <div class="card-image">
                <span class="card-label-ujian bg-primary">SBMPTN</span>
                <img class="card-img-top" src="{{ asset('asset-member/img/sbmptn.jpg') }}" alt="Placeholder">
            </div>
            <div class="card-body vertical-align text-center">
                <div class="card-body-content">
                    <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1303, 'idJenisUjian' => 1404]) }}" class="btn btn-lg btn-default">PILIH UJIAN</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-ujian mb-3">
        <div class="card">
            <div class="card-image">
                <span class="card-label-ujian bg-primary">STAN</span>
                <img class="card-img-top" src="{{ asset('asset-member/img/stan.jpg') }}" alt="Placeholder">
            </div>
            <div class="card-body vertical-align text-center">
                <div class="card-body-content">
                    <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1303, 'idJenisUjian' => 1405]) }}" class="btn btn-lg btn-default">PILIH UJIAN</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-ujian mb-3">
        <div class="card">
            <div class="card-image">
                <span class="card-label-ujian bg-primary">POLTEKES</span>
                <img class="card-img-top" src="{{ asset('asset-member/img/poltekes.jpg') }}" alt="Placeholder">
            </div>
            <div class="card-body vertical-align text-center">
                <div class="card-body-content">
                    <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1303, 'idJenisUjian' => 1406]) }}" class="btn btn-lg btn-default">PILIH UJIAN</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-ujian mb-3">
        <div class="card">
            <div class="card-image">
                <span class="card-label-ujian bg-primary">POLINELA</span>
                <img class="card-img-top" src="{{ asset('asset-member/img/polinela.jpg') }}" alt="Placeholder">
            </div>
            <div class="card-body vertical-align text-center">
                <div class="card-body-content">
                    <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1303, 'idJenisUjian' => 1407]) }}" class="btn btn-lg btn-default">PILIH UJIAN</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-ujian mb-3">
        <div class="card">
            <div class="card-image">
                <span class="card-label-ujian bg-primary">STIS</span>
                <img class="card-img-top" src="{{ asset('asset-member/img/stis.jpg') }}" alt="Placeholder">
            </div>
            <div class="card-body vertical-align text-center">
                <div class="card-body-content">
                    <a href="{{ route('member.ujian.soal.list', ['idSekolah' => 1303, 'idJenisUjian' => 1408]) }}" class="btn btn-lg btn-default">PILIH UJIAN</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-ujian mb-3">
        <div class="card">
            <div class="card-image">
                <span class="card-label-ujian bg-primary">KEDINASAN</span>
                <img class="card-img-top" src="{{ asset('asset-member/img/kedinasan.jpg') }}" alt="Placeholder">
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
