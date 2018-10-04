@extends('layouts.admin')

@section('title')
Peserta Simulasi - {{ $simulasi->judul }}
@endsection

@section('content')
<a href="{{ URL::previous() }}" class="btn btn-default btn-space btn-icon"><i class="mdi mdi-arrow-back"></i>Kembali</a>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default panel-table">
            <div class="panel-heading">
                Data Member Yang Membeli {{ $simulasi->judul }}
            </div>
            <div class="panel-body">
                <table id="datatables" class="table datatables table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Sekolah</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Peserta</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Sekolah</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($simulasi->peserta as $i => $peserta)
                        <tr>
                            <td>{{ $peserta->pivot->no_peserta }}</td>
                            <td>{{ $peserta->nama }}</td>
                            <td>{{ $peserta->username }}</td>
                            <td>{{ $peserta->email }}</td>
                            <td>{{ $peserta->no_hp }}</td>
                            <td>{{ $peserta->asal_sekolah }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
