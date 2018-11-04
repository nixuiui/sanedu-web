@extends('layouts.admin')

@section('title')
Hasil Sementara - {{ $simulasi->judul }}
@endsection

@section('content')
<a href="{{ route('adminsimulasi.simulasi.kelola', $simulasi->id) }}" class="btn btn-default btn-space btn-icon"><i class="mdi mdi-arrow-back"></i>Kembali</a>
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default panel-table">
            <div class="panel-body table-responsive">
                <table class="table datatables table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>No Peserta</th>
                            <th>Nama</th>
                            <th>Asal Sekolah</th>
                            <th class="text-center">Benar</th>
                            <th class="text-center">Salah</th>
                            <th class="text-center">Tidak Diisi</th>
                            <th class="text-center">Nilai Sementara</th>
                            <th class="text-right"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($peserta->count() > 0)
                        @foreach($peserta as $data)
                        <tr>
                            <td>
                                <span class="mdi mdi-circle {{ $data->mode_simulasi == 'online' ? "text-success" : "text-danger" }}" title="{{ $data->mode_simulasi }}"></span>
                                {{ $data->mode_simulasi }}
                            </td>
                            <td>{{ $data->no_peserta }}</td>
                            <td>{{ $data->profil->nama }}</td>
                            <td>{{ $data->profil->asal_sekolah }}</td>
                            <td class="text-center">{{ $data->jumlah_benar }}</td>
                            <td class="text-center">{{ $data->jumlah_salah }}</td>
                            <td class="text-center">{{ $data->jumlah_tidak_jawab }}</td>
                            <td class="text-center">{{ $data->jumlah_benar }}</td>
                            <td class="text-right"><a href="{{ route('adminsimulasi.simulasi.kelola.hasil.sementara.delete', ['id' => $simulasi->id, 'idPeserta' => $data->id]) }}" class="btn btn-md btn-danger delete"><i class="mdi mdi-delete"></i></a></td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="8" class="text-center text-muted">Belum ada peserta yang di koreksi</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
