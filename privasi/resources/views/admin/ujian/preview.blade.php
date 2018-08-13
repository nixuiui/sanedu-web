@extends('layouts.admin')

@section('title')
Preview - {{ $attempt->ujian->judul }}
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
                        <td>{{ $attempt->user->nama }}</td>
                    </tr>
                    <tr>
                        <th>Ujian</th>
                        <td>{{ $attempt->ujian->jenisUjian->nama }}</td>
                    </tr>
                    <tr>
                        <th>Soal</th>
                        <td>{{ $attempt->ujian->judul }}</td>
                    </tr>
                    @if($attempt->ujian->id_mata_pelajaran != null)
                    <tr>
                        <th>Mate Pelajaran</th>
                        <td>{{ $attempt->ujian->mataPelajaran->nama }}</td>
                    </tr>
                    @endif
                    <tr>
                        <th>Tingkat Sekolah</th>
                        <td>{{ $attempt->ujian->tingkatSekolah->nama }}</td>
                    </tr>
                    @if($attempt->ujian->id_tingkat_kelas != null)
                    <tr>
                        <th>Mate Pelajaran</th>
                        <td>{{ $attempt->ujian->tingkatKelas->nama }}</td>
                    </tr>
                    @endif
                    <tr>
                        <th>Durasi</th>
                        <td>{{ $attempt->ujian->durasi }} menit</td>
                    </tr>
                    <tr>
                        <th>Jumlah Soal</th>
                        <td>{{ $attempt->ujian->jumlah_soal }} butir</td>
                    </tr>
                    <tr>
                        <th>Nilai</th>
                        <td class="text-success text-bold">{{ round(($attempt->jumlah_benar / $attempt->ujian->soal->count())*100, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Pembahasan</th>
                        <td><a href="{{ $attempt->ujian->link_pembahasan }}"><i class="mdi mdi-download mr-2"></i>{{ $attempt->ujian->link_pembahasan }} Download</a></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12">
                <div class="label label-md label-space label-icon label-default">
                    <i class="mdi mdi-check"></i>BENAR: <strong>{{ $attempt->jumlah_benar }}</strong>
                </div>
                <div class="label label-md label-space label-icon label-default">
                    <i class="mdi mdi-close"></i>SALAH: <strong>{{ $attempt->jumlah_salah }}</strong>
                </div>
                <div class="label label-md label-space label-icon label-default">
                    <i class="mdi mdi-minus"></i>TIDAK DIISI: <strong>{{ $attempt->jumlah_tidak_jawab }}</strong>
                </div>
            </div>
        </div>
        <div class="panel panel-default panel-table">
            <div class="panel-heading">
                JAWABAN ANDA
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
                        @foreach($soal as $i => $d)
                        <tr>
                            <td class="text-center">{{ $i+1 }}.</td>
                            <td class="text-center"><span class="label label-default"><i class="text-bold mdi {{ $d->jawaban == 'a' && $d->is_correct ? ' mdi-check text-success' : '' }}{{ $d->jawaban == 'a' && !$d->is_correct ? ' mdi-close text-danger' : '' }}{{ $d->jawaban != 'a' ? ' mdi-close text-transparent' : '' }}"></i></span></td>
                            <td class="text-center"><span class="label label-default"><i class="text-bold mdi {{ $d->jawaban == 'b' && $d->is_correct ? ' mdi-check text-success' : '' }}{{ $d->jawaban == 'b' && !$d->is_correct ? ' mdi-close text-danger' : '' }}{{ $d->jawaban != 'b' ? ' mdi-close text-transparent' : '' }}"></i></span></td>
                            <td class="text-center"><span class="label label-default"><i class="text-bold mdi {{ $d->jawaban == 'c' && $d->is_correct ? ' mdi-check text-success' : '' }}{{ $d->jawaban == 'c' && !$d->is_correct ? ' mdi-close text-danger' : '' }}{{ $d->jawaban != 'c' ? ' mdi-close text-transparent' : '' }}"></i></span></td>
                            <td class="text-center"><span class="label label-default"><i class="text-bold mdi {{ $d->jawaban == 'd' && $d->is_correct ? ' mdi-check text-success' : '' }}{{ $d->jawaban == 'd' && !$d->is_correct ? ' mdi-close text-danger' : '' }}{{ $d->jawaban != 'd' ? ' mdi-close text-transparent' : '' }}"></i></span></td>
                            <td class="text-center"><span class="label label-default"><i class="text-bold mdi {{ $d->jawaban == 'e' && $d->is_correct ? ' mdi-check text-success' : '' }}{{ $d->jawaban == 'e' && !$d->is_correct ? ' mdi-close text-danger' : '' }}{{ $d->jawaban != 'e' ? ' mdi-close text-transparent' : '' }}"></i></span></td>
                            <td class="text-center text-uppercase text-bold">{{ $d->kunci }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
