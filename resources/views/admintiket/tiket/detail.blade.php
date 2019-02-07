@extends('layouts.admin')
@section('title')
Tiket Member
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default panel-table">
            <div class="panel-body">
                <table id="datatables" class="table table-striped">
                    <thead>
                        <tr>
                            <th>PIN</th>
                            <th>KAP</th>
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
                            <th>KAP</th>
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
                            <td>{{ $data->kap }}</td>
                            <td>{{ $data->kategoriTiket->nama }}</td>
                            <td>
                                <a href="{{ route('admintiket.tiket.member.detail', $data->id_cetak_tiket) }}" title="Detail Tiket">{{ hariTanggalWaktu($data->cetakTiket->created_at) }}</a>
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