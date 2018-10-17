@extends('layouts.admin')

@section('title')
Pembeli Soal - {{ $ujian->judul }}
@endsection

@section('content')
<a href="{{ URL::previous() }}" class="btn btn-default btn-space btn-icon"><i class="mdi mdi-arrow-back"></i>Kembali</a>
<a href="{{ route('admin.ujian.soal', $ujian->id) }}" class="btn btn-default btn-space">Lihat Soal Ujian</a>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default panel-table">
            <div class="panel-heading">
                Data Member Yang Membeli {{ $ujian->judul }}
            </div>
            <div class="panel-body">
                <table id="datatables" class="table datatables table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Peserta</th>
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
                        @foreach($ujian->diBeliOleh as $i => $data)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->username }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->no_hp }}</td>
                            <td>{{ $data->asal_sekolah }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
