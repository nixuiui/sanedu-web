@extends('layouts.admin')

@section('title')
Simulasi - {{ $simulasi->judul }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 hidden-xs visible-md visible-lg">
        <a href="{{ url()->previous() }}" class="btn btn-space btn-default"><i class="icon icon-left mdi mdi-arrow-left mr-3"></i>Kembali</a>
        <a href="{{ route('pengawas.simulasi.kelola.koreksi', $simulasi->id) }}" class="btn btn-space btn-default   "><i class="icon icon-left mdi mdi-assignment-check mr-3"></i>Koreksi</a>
        <a href="{{ route('pengawas.simulasi.kelola.lihat.hasil.sementara', $simulasi->id) }}" class="btn btn-space btn-default   "><i class="icon icon-left mdi mdi-eye mr-3"></i>Lihat Hasil Sementara</a>
    </div>
    <div class="col-md-12 visible-xs visible-sm">
        <div class="btn-group btn-space">
            <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Pilih Aksi <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
            <ul role="menu" class="dropdown-menu">
                <li><a href="{{ route('member.simulasi.kartuujian', $simulasi->id) }}">Cetak Kartu Ujian</a></li>
                <li><a href="{{ $simulasi->link_soal != null ? $simulasi->link_soal : '#' }}">Download Soal</a></li>
                <li><a href="{{ $simulasi->link_pembahasan != null ? $simulasi->link_pembahasan : '#' }}">Download Pembahasan</a></li>
                <li><a href="#">Pengumuman</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-preattempt">
            <div class="heading">
                SIMULASI
            </div>
            <div class="panel-section">
                <div class="text-20 text-bold item">{{ $simulasi->judul }}</div>
            </div>
            <div class="panel-section">
                <div class="row">
                    <div class="col-md-3 col-xs-6 mb-3">
                        <div class="text-muted">PENYELENGGARA</div>
                        <div>{{ $simulasi->instansi }}</div>
                    </div>
                    <div class="col-md-3 col-xs-6 mb-3">
                        <div class="text-muted">SEKOLAH</div>
                        <div>{{ $simulasi->tingkatSekolah->nama }}</div>
                    </div>
                    <div class="col-md-3 col-xs-6 mb-3">
                        <div class="text-muted">WAKTU PELAKSANAAN</div>
                        <div>{{ hariTanggal($simulasi->tanggal_pelaksanaan) }}</div>
                    </div>
                    <div class="col-md-3 col-xs-6 mb-3">
                        <div class="text-muted">TEMPAT</div>
                        <div>{{ $simulasi->tempat_pelaksanaan }}</div>
                    </div>
                </div>
            </div>
            <div class="panel-section">
                <div class="row">
                    <div class="col-md-3 col-xs-6 mb-3">
                        <div class="text-muted">JENIS TO</div>
                        <div>{{ $pengawas->ruang->ruangMapel->nama }}</div>
                    </div>
                    <div class="col-md-3 col-xs-6 mb-3">
                        <div class="text-muted">RUANG</div>
                        <div>{{ $pengawas->ruang->nama }}</div>
                    </div>
                    <div class="col-md-3 col-xs-6 mb-3">
                        <div class="text-muted">ALAMAT</div>
                        <div>{{ $pengawas->ruang->alamat }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default panel-table">
            <div class="panel-body table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th colspan="3" class="text-center">AGENDA</th>
                        </tr>
                        <tr>
                            <th width="180px">Waktu</th>
                            <th>Tempat</th>
                            <th>Agenda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($simulasi->agenda->count() > 0)
                        @foreach($simulasi->agenda as $agenda)
                        <tr>
                            <td>{{ jamMenit($agenda->waktu_mulai) }} - {{ jamMenit($agenda->waktu_selesai) }}</td>
                            <td>{{ $agenda->tempat }}</td>
                            <td>
                                <strong>{{ $agenda->nama_agenda }}</strong> <br>
                                {{ $agenda->deskripsi }}
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="4" class="data-is-empty">Belum ada agenda yang dibuat</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default panel-table">
            <div class="panel-body table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th colspan="5" class="text-center">PESERTA</th>
                        </tr>
                        <tr>
                            <th>No Peserta</th>
                            <th>Nama</th>
                            <th>Sekolah</th>
                            <th>No Hp</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($pengawas->ruang->peserta->count() > 0)
                            @foreach($pengawas->ruang->peserta as $peserta)
                                <tr>
                                    <td>{{ $peserta->pivot->no_peserta }}</td>
                                    <td>{{ $peserta->nama }}</td>
                                    <td>{{ $peserta->asal_sekolah }}</td>
                                    <td>{{ $peserta->no_hp }}</td>
                                    <td>{{ $peserta->email }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="data-is-empty">Tidak Ada Peserta</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
