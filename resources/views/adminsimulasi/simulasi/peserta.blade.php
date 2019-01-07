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
                            <th>Email</th>
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
                            <th>Email</th>
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
                            <td>{{ $data->profil->nama }}</td>
                            <td>{{ $data->profil->username }}</td>
                            <td>{{ $data->profil->email }}</td>
                            <td>{{ $data->profil->role->nama }}</td>
                            <td>{{ $data->profil->no_hp }}</td>
                            <td>{{ $data->profil->asal_sekolah }}</td>
                            <td>{{ $data->nilai_akhir == null ? "-" : $data->nilai_akhir }}</td>
                            <td>{{ $data->peringkat }}</td>
                            <td>
                                <strong><a href="{{ route('adminsimulasi.simulasi.kelola.peserta.edit', ['id' => $simulasi->id, 'idPeserta' => $data->id]) }}" class="btn btn-md btn-default" target="_blank"><i class="mdi mdi-edit mr-3"></i>Edit</a></strong>
                                <strong><a href="{{ route('adminsimulasi.simulasi.kelola.download.borang', ['id' => $simulasi->id, 'idPeserta' => $data->id]) }}" class="btn btn-md btn-default" target="_blank"><i class="mdi mdi-download mr-3"></i>Borang</a></strong>
                                @if($data->mode_simulasi == "offline")
                                <strong><a href="{{ route('adminsimulasi.simulasi.kelola.peserta.kartuujian', ['id' => $simulasi->id, 'idPeserta' => $data->id]) }}" class="btn btn-md btn-default" target="_blank"><i class="mdi mdi-print mr-3"></i>Kartu</a></strong>
                                @endif

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
