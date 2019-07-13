@extends('layouts.admin')
@section('title')
Tiket Peserta {{ $simulasi->judul }}
@endsection
@section('content')
<a href="{{ route('adminsimulasi.simulasi.kelola.tiket', ['id' => $simulasi->id]) }}" class="btn btn-default btn-space btn-icon"><i class="mdi mdi-arrow-back"></i>Kembali</a>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default panel-table">
            <div class="panel-body">
                <table id="datatables" class="table table-striped">
                    <thead>
                        <tr>
                            <th>PIN</th>
                            <th>Kategori</th>
                            <th>Tanggal Cetak</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Sekolah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>PIN</th>
                            <th>Kategori</th>
                            <th>Tanggal Cetak</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Sekolah</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($tiket as $data)
                        <tr>
                            <td>{{ $data->pin }}</td>
                            <td>{{ $data->kategoriTiket->nama }}</td>
                            <td>
                                <a href="{{ route('adminsimulasi.simulasi.kelola.tiket.detail', ['id' => $simulasi->id, 'idCetak' => $data->id_cetak_tiket]) }}" title="Detail Tiket">{{ hariTanggalWaktu($data->cetakTiket->created_at) }}</a>
                            </td>
                            <td>{{ $data->user != null ? $data->user->nama : "-" }}</td>
                            <td>{{ $data->user != null ? $data->user->username : "-" }}</td>
                            <td>{{ $data->user != null ? ($data->user->sekolah != null ? $data->user->sekolah->nama : "-") : "-" }}</td>
                            <td>
                                @if($data->user != null)
                                <a href="{{ route('admintiket.tiket.member.data.edit', $data->user->id) }}" class="btn btn-xs btn-success" title="Edit Data Member"> <i class="mdi mdi-edit"></i> </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col-md-12 -->
</div> <!-- end row -->
@endsection