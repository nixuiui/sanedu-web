@extends('layouts.admin')

@section('title')
Simulasi - {{ $simulasi->judul }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 hidden-xs visible-md visible-lg">
        @if($peserta->mode_simulasi == "offline")
        <a href="{{ route('member.simulasi.kartuujian', $simulasi->id) }}" class="btn btn-space btn-default"><i class="icon icon-left mdi mdi-print mr-3"></i>Cetak Kartu Ujian</a>
        @endif
        <a href="{{ $simulasi->link_soal }}" class="btn btn-space btn-default" {{ $simulasi->link_soal == null ? "disabled" : ""}}><i class="icon icon-left mdi mdi-download mr-3"></i>Download Soal</a>
        <a href="{{ $simulasi->link_pembahasan }}" class="btn btn-space btn-default" {{ $simulasi->link_pembahasan == null ? "disabled" : ""}}><i class="icon icon-left mdi mdi-download mr-3"></i>Download Pembahasan</a>
        <button class="btn btn-space btn-default"><i class="icon icon-left mdi mdi-notifications mr-3"></i>Pengumuman</button>
    </div>
    <div class="col-md-12 visible-xs visible-sm">
        <div class="btn-group btn-space">
            <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Pilih Aksi <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
            <ul role="menu" class="dropdown-menu">
                @if($peserta->mode_simulasi == "offline")
                <li><a href="{{ route('member.simulasi.kartuujian', $simulasi->id) }}">Cetak Kartu Ujian</a></li>
                @endif
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
            <div class="panel-section text-center">
                <div class="text-20 text-bold item">{{ $simulasi->judul }}</div>
            </div>
            <div class="panel-section text-center p-5">
                <div class="text-bold text-20">NO PESERTA {{ $peserta->no_peserta }}</div>
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
                        <div class="text-muted">JENIS TO</div>
                        <div>{{ $peserta->mapel->nama }}</div>
                    </div>
                </div>
            </div>
            <div class="panel-section">
                <div class="row">
                    <div class="col-md-3 col-xs-6 mb-3">
                        <div class="text-muted">WAKTU PELAKSANAAN</div>
                        <div>{{ hariTanggal($simulasi->tanggal_pelaksanaan) }}</div>
                    </div>
                    <div class="col-md-3 col-xs-6 mb-3">
                        <div class="text-muted">TEMPAT</div>
                        <div>{{ $simulasi->tempat_pelaksanaan }}</div>
                    </div>
                    <div class="col-md-3 col-xs-6 mb-3">
                        <div class="text-muted">WAKTU PENGUMUMAN</div>
                        <div>{{ $simulasi->tanggal_pengumuman != null ? hariTanggal($simulasi->tanggal_pengumuman) : "-" }}</div>
                    </div>
                </div>
            </div>
            <div class="panel-section">
                <div class="row">
                    <div class="col-md-3 col-xs-6 mb-3">
                        <div class="text-muted">SIMULASI</div>
                        <div>{{ $peserta->mode_simulasi }}</div>
                    </div>
                    @if($peserta->mode_simulasi == "offline")
                    <div class="col-md-3 col-xs-6 mb-3">
                        <div class="text-muted">RUANG</div>
                        <div>{{ $peserta->ruang->nama }}</div>
                    </div>
                    <div class="col-md-6 col-xs-6 mb-3">
                        <div class="text-muted">ALAMAT TEMPAT</div>
                        <div>{{ $peserta->ruang->alamat }}</div>
                    </div>
                    @else
                    <div class="col-md-3 col-xs-6 mb-3">
                        <div class="text-muted">SOAL</div>
                        <div>Belum Tersedia</div>
                    </div>
                        @if($peserta->id_jadwal_online != null)
                        <div class="col-md-3 col-xs-6 mb-3">
                            <div class="text-muted">WAKTU TO ONLINE</div>
                            <div>{{ hariTanggal($peserta->jadwalOnline->tanggal)}}</div>
                        </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        @if($peserta->mode_simulasi == "offline")
        <div class="panel panel-default panel-table">
            <div class="panel-heading">
                Agenda
            </div>
            <div class="panel-body table-responsive">
                <table class="table table-striped">
                    <thead>
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
        @else
        <div class="panel panel-default panel-table">
            <div class="panel-heading">
                Jadwal Try Out Online
            </div>
            <form class="panel-body table-responsive" action="{{ route('member.simulasi.aturjadwal', $simulasi->id) }}" method="post">
                @csrf
                <table class="table table-striped">
                    <thead>
                        <tr>
                            @if($peserta->id_jadwal_online == null)
                            <th width="60px"></th>
                            @endif
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($simulasi->jadwalOnline->count() > 0)
                        @foreach($simulasi->jadwalOnline as $jadwal)
                        <tr>
                            @if($peserta->id_jadwal_online == null)
                            <td width="60px"> <input type="radio" name="jadwal" value="{{ $jadwal->id }}" {{ $jadwal->is_full ? "disabled" : "" }}> </td>
                            @endif
                            <td class={{ $jadwal->is_full ? "text-muted" : "" }} {{ $peserta->id_jadwal_online == $jadwal->id ? "text-bold" : "" }}>{{ hariTanggal($jadwal->tanggal) }} {{ $peserta->id_jadwal_online == $jadwal->id ? " - Jadwal Anda" : "" }}</td>
                        </tr>
                        @endforeach
                            @if($peserta->id_jadwal_online == null)
                            <tr>
                                <td colspan="2"><button type="submit" class="btn btn-md btn-primary">Tetapkan Jadwal Saya</button></td>
                            </tr>
                            @endif
                        @else
                        <tr>
                            <td colspan="4" class="data-is-empty">Belum ada jadwal yang dibuat</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </form>
        </div>
        @endif
    </div>
</div>
@endsection
