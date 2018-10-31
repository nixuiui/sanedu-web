@extends('layouts.admin')

@section('title')
Peserta Simulasi - {{ $simulasi->judul }}
@endsection

@section('content')
<a href="{{ route('adminsimulasi.simulasi.kelola', ['id' => $simulasi->id]) }}" class="btn btn-default btn-space btn-icon"><i class="mdi mdi-arrow-back"></i>Kembali</a>
<div class="row">
    <div class="col-md-12">
        <a href="{{ route('adminsimulasi.simulasi.kelola.push.nilai', ['id' => $simulasi->id, 'idJadwal' => $jadwal->id]) }}" class="btn btn-md btn-default mb-3"><i class="mdi mdi-upload mr-3 text-default"></i>PUSH NILAI</a>
        <div class="panel panel-default panel-table">
            <div class="panel-heading">
                Data Member Yang Membeli {{ $simulasi->judul }}
            </div>
            <div class="panel-body table-responsive">
                <table id="datatables" class="table datatables table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Sekolah</th>
                            <th>Ruang</th>
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
                            <th>No HP</th>
                            <th>Sekolah</th>
                            <th>Ruang</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($jadwal->peserta as $i => $data)
                        <tr>
                            <td>
                                @if($data->pivot->is_attempted)
                                <span class="mdi mdi-circle text-success" title="{{ $data->mode_simulasi }}"></span>
                                @endif
                            </td>
                            <td>{{ $data->pivot->no_peserta }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->username }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->no_hp }}</td>
                            <td>{{ $data->asal_sekolah }}</td>
                            <td>
                                @if($data->mode_simulasi == "offline")
                                <strong><a href="{{ route('adminsimulasi.simulasi.kelola.ruang', ['id' => $simulasi->id, 'idRuang' => $data->ruang->id]) }}">{{ $data->ruang->nama }}</a></strong>
                                @else
                                -
                                @endif
                            </td>
                            <td>
                                @if($data->mode_simulasi == "offline")
                                <strong><a href="{{ route('adminsimulasi.simulasi.kelola.peserta.kartuujian', ['id' => $simulasi->id, 'idPeserta' => $data->id]) }}" class="btn btn-md btn-default"><i class="mdi mdi-print mr-3"></i>Cetak Kartu</a></strong>
                                @else
                                -
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
