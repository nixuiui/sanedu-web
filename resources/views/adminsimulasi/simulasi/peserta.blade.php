@extends('layouts.admin')

@section('title')
Peserta Simulasi - {{ $simulasi->judul }}
@endsection

@section('content')
<a href="{{ route('adminsimulasi.simulasi.kelola', ['id' => $simulasi->id]) }}" class="btn btn-default btn-space btn-icon"><i class="mdi mdi-arrow-back"></i>Kembali</a>
<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <a href="{{ route('adminsimulasi.simulasi.kelola.peserta', ['id' => $simulasi->id]) }}" class="btn btn-sm btn-default btn-space">SEMUA</a>
            <a href="{{ route('adminsimulasi.simulasi.kelola.peserta', ['id' => $simulasi->id, 'simulasi' => 'offline']) }}" class="btn btn-sm btn-default btn-space"><i class="mdi mdi-circle mr-2 text-danger"></i>OFFLINE</a>
            <a href="{{ route('adminsimulasi.simulasi.kelola.peserta', ['id' => $simulasi->id, 'simulasi' => 'online']) }}" class="btn btn-sm btn-default btn-space"><i class="mdi mdi-circle mr-2 text-success"></i>ONLINE</a>
            <div class="btn-group btn-space">
                <button type="button" data-toggle="dropdown" class="btn btn-sm btn-default dropdown-toggle">
                    <i class="icon icon-left mdi mdi-download mr-3"></i> Download
                    <span class="icon-dropdown mdi mdi-chevron-down"></span>
                </button>
                <ul role="menu" class="dropdown-menu">
                    <li><a href="{{ route('adminsimulasi.simulasi.kelola.download.peserta', ['id' => $simulasi->id]) }}">Peserta</a></li>
                    <li><a href="{{ route('adminsimulasi.simulasi.kelola.download.peserta', ['id' => $simulasi->id, 'id_mapel' => 1516]) }}">Peserta Saintek</a></li>
                    <li><a href="{{ route('adminsimulasi.simulasi.kelola.download.peserta', ['id' => $simulasi->id, 'id_mapel' => 1517]) }}">Peserta Soshum</a></li>
                    <li><a href="{{ route('adminsimulasi.simulasi.kelola.download.peserta', ['id' => $simulasi->id, 'mode_simulasi' => 'online']) }}">Peserta Online</a></li>
                    <li><a href="{{ route('adminsimulasi.simulasi.kelola.download.peserta', ['id' => $simulasi->id, 'mode_simulasi' => 'offline']) }}">Peserta Offline</a></li>
                    <li><a href="{{ route('adminsimulasi.simulasi.kelola.download.peserta', ['id' => $simulasi->id, 'mode_simulasi' => 'online', 'is_attempted' => 0]) }}">Peserta Online Belum Ujian</a></li>
                    <li><a href="{{ route('adminsimulasi.simulasi.kelola.download.peserta', ['id' => $simulasi->id, 'mode_simulasi' => 'offline', 'is_corrected' => 0]) }}">Peserta Offline Belum Ujian</a></li>
                </ul>
            </div>
        </div>
        <div class="panel panel-default panel-table">
            <div class="panel-heading">
                Data Member Yang Membeli {{ $simulasi->judul }}
            </div>
            <div class="panel-body table-responsive">
                <table id="datatables" class="table datatables table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th width="100px">No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>PIN</th>
                            <th>KAP</th>
                            <th>Role</th>
                            <th>No HP</th>
                            <th>Sekolah</th>
                            <th>NA</th>
                            <th>Peringkat</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>No</th>
                            <th>Nama Peserta</th>
                            <th>Username</th>
                            <th>PIN</th>
                            <th>KAP</th>
                            <th>Role</th>
                            <th>No HP</th>
                            <th>Sekolah</th>
                            <th>NA</th>
                            <th>Peringkat</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($peserta as $i => $data)
                        <tr>
                            <td>
                                <a href="{{ route('adminsimulasi.simulasi.kelola.peserta.switch', ['id' => $simulasi->id, 'idPeserta' => $data->id])}}" class="mdi mdi-circle {{ $data->mode_simulasi == 'online' ? "text-success" : "text-danger" }}" title="{{ $data->mode_simulasi }}"> {{ $data->mode_simulais }}</a>
                            </td>
                            <td>{{ $data->no_peserta }}</td>
                            <td>{{ $data->profil != null ? $data->profil->nama : "" }}</td>
                            <td>{{ $data->profil != null ? $data->profil->username : ""}}</td>
                            <?php
                                $tiket = null;
                                if($data->profil != null)
                                $tiket = $data->profil->tiket->where("id_simulasi", $data->id_simulasi)->first();
                            ?>
                            <td>{{ $tiket != null ? $tiket->pin : ""  }}</td>
                            <td>{{ $tiket != null ? $tiket->kap : ""  }}</td>
                            <td>{{ $data->profil != null ? $data->profil->role->nama : ""}}</td>
                            <td>{{ $data->profil != null ? $data->profil->no_hp : ""}}</td>
                            <td>{{ $data->profil != null ? ($data->profil->sekolah != null ? $data->profil->sekolah->nama : "") : "" }}</td>
                            <td>{{ $data->nilai_akhir == null ? "-" : $data->nilai_akhir }}</td>
                            <td>{{ $data->peringkat }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('adminsimulasi.simulasi.kelola.peserta.edit', ['id' => $simulasi->id, 'idPeserta' => $data->id]) }}" class="btn btn-default" title="Edit"><i class="mdi mdi-edit"></i></a>
                                    <a href="{{ route('adminsimulasi.simulasi.kelola.download.borang', ['id' => $simulasi->id, 'idPeserta' => $data->id]) }}" class="btn btn-default" title="Download Borang"><i class="mdi mdi-download"></i></a>
                                    @if($data->mode_simulasi == "offline")
                                    <a href="{{ route('adminsimulasi.simulasi.kelola.peserta.kartuujian', ['id' => $simulasi->id, 'idPeserta' => $data->id]) }}" class="btn btn-default" title="Cetak Kartu"><i class="mdi mdi-print"></i></a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
