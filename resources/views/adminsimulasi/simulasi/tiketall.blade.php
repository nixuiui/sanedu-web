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
                            <th>KAP</th>
                            <th>Nama Pengguna</th>
                            <th>Sekolah</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>PIN</th>
                            <th>KAP</th>
                            <th>Nama Pengguna</th>
                            <th>Sekolah</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($simulasi->tiket as $tiket)
                        <tr>
                            <td>{{ $tiket->pin }}</td>
                            <td>{{ $tiket->kap }}</td>
                            <td>{{ $tiket->user != null ? $tiket->user->nama : "-" }}</td>
                            <td>{{ $tiket->user != null ? ($tiket->user->sekolah != null ? $tiket->user->sekolah->nama : "-") : "-" }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col-md-12 -->
</div> <!-- end row -->
@endsection