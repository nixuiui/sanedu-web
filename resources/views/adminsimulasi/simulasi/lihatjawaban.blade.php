@extends('layouts.admin')

@section('title')
Preview - {{ $peserta->simulasi->judul }}
@endsection

@section('content')
<a href="{{ URL::previous() }}" class="btn btn-default btn-space btn-icon"><i class="mdi mdi-arrow-back"></i>Kembali</a>
<div class="row">
    <div class="col-md-5">
        <div class="panel panel-default">
            <div class="panel-heading">
                Informasi Ujian dan Pengerjaan
            </div>
            <div class="panel-body">
                <table class="table table-condensed table-hover table-bordered table-striped">
                    <tr>
                        <th>Nama Peserta</th>
                        <td>{{ $peserta->profil->nama }}</td>
                    </tr>
                    <tr>
                        <th>Ujian</th>
                        <td>{{ $peserta->simulasi->jenisUjian->nama }}</td>
                    </tr>
                    <tr>
                        <th>Mate Pelajaran</th>
                        <td>{{ $peserta->mapel->nama }}</td>
                    </tr>
                    <tr>
                        <th>Tingkat Sekolah</th>
                        <td>{{ $peserta->simulasi->tingkatSekolah->nama }}</td>
                    </tr>
                    <tr>
                        <th>Nilai</th>
                        <td class="text-success text-bold">{{ $peserta->jumlah_benar }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12">
                <div class="label label-md label-space label-icon label-default">
                    <i class="mdi mdi-check"></i>BENAR: <strong>{{ $peserta->jumlah_benar }}</strong>
                </div>
                <div class="label label-md label-space label-icon label-default">
                    <i class="mdi mdi-close"></i>SALAH: <strong>{{ $peserta->jumlah_salah }}</strong>
                </div>
                <div class="label label-md label-space label-icon label-default">
                    <i class="mdi mdi-minus"></i>TIDAK DIISI: <strong>{{ $peserta->jumlah_tidak_jawab }}</strong>
                </div>
            </div>
        </div>
        <div class="panel panel-default panel-table">
            <div class="panel-heading">
                Jawaban
            </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">A</th>
                            <th class="text-center">B</th>
                            <th class="text-center">C</th>
                            <th class="text-center">D</th>
                            <th class="text-center">E</th>
                            <th class="text-center">Kunci</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($koreksi as $i => $d)
                        <tr>
                            <td class="text-center">{{ $i+1 }}.</td>
                            <td class="text-center"><span class="label label-default"><i class="text-bold mdi {{ strtolower($d->jawaban) == 'a' && $d->is_correct ? ' mdi-check text-success' : '' }}{{ strtolower($d->jawaban) == 'a' && !$d->is_correct ? ' mdi-close text-danger' : '' }}{{ strtolower($d->jawaban) != 'a' ? ' mdi-close text-transparent' : '' }}"></i></span></td>
                            <td class="text-center"><span class="label label-default"><i class="text-bold mdi {{ strtolower($d->jawaban) == 'b' && $d->is_correct ? ' mdi-check text-success' : '' }}{{ strtolower($d->jawaban) == 'b' && !$d->is_correct ? ' mdi-close text-danger' : '' }}{{ strtolower($d->jawaban) != 'b' ? ' mdi-close text-transparent' : '' }}"></i></span></td>
                            <td class="text-center"><span class="label label-default"><i class="text-bold mdi {{ strtolower($d->jawaban) == 'c' && $d->is_correct ? ' mdi-check text-success' : '' }}{{ strtolower($d->jawaban) == 'c' && !$d->is_correct ? ' mdi-close text-danger' : '' }}{{ strtolower($d->jawaban) != 'c' ? ' mdi-close text-transparent' : '' }}"></i></span></td>
                            <td class="text-center"><span class="label label-default"><i class="text-bold mdi {{ strtolower($d->jawaban) == 'd' && $d->is_correct ? ' mdi-check text-success' : '' }}{{ strtolower($d->jawaban) == 'd' && !$d->is_correct ? ' mdi-close text-danger' : '' }}{{ strtolower($d->jawaban) != 'd' ? ' mdi-close text-transparent' : '' }}"></i></span></td>
                            <td class="text-center"><span class="label label-default"><i class="text-bold mdi {{ strtolower($d->jawaban) == 'e' && $d->is_correct ? ' mdi-check text-success' : '' }}{{ strtolower($d->jawaban) == 'e' && !$d->is_correct ? ' mdi-close text-danger' : '' }}{{ strtolower($d->jawaban) != 'e' ? ' mdi-close text-transparent' : '' }}"></i></span></td>
                            <td class="text-center text-uppercase text-bold">{{ $d->kunci_jawaban }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
