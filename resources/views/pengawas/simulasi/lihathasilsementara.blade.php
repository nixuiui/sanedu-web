@extends('layouts.admin')

@section('title')
Hasil Sementara - {{ $simulasi->judul }}
@endsection

@section('content')
<a href="{{ route('pengawas.simulasi.kelola', $simulasi->id) }}" class="btn btn-default btn-space btn-icon"><i class="mdi mdi-arrow-back"></i>Kembali</a>
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default panel-table">
            <div class="panel-body table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No Peserta</th>
                            <th>Nama</th>
                            <th>Asal Sekolah</th>
                            <th class="text-center">Benar</th>
                            <th class="text-center">Salah</th>
                            <th class="text-center">Tidak Diisi</th>
                            <th class="text-center">Nilai Sementara</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($peserta as $data)
                        <tr>
                            <td>{{ $data->no_peserta }}</td>
                            <td>{{ $data->profil->nama }}</td>
                            <td>{{ $data->profil->asal_sekolah }}</td>
                            <td class="text-center">{{ $data->jumlah_benar }}</td>
                            <td class="text-center">{{ $data->jumlah_salah }}</td>
                            <td class="text-center">{{ $data->jumlah_tidak_jawab }}</td>
                            <td class="text-center">{{ $data->jumlah_benar }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
