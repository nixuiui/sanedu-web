@extends('layouts.admin')
@section('title')
Ujian
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <a href="{{ route('admin.ujian.soal.tambah') }}" class="btn btn-md btn-fill btn-primary btn-space btn-icon"><i class="mdi mdi-plus"></i> Buat Soal Ujian</a>

        <div class="panel panel-default panel-table">
            <div class="panel-body">
                <table id="datatables" class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Judul Soal</th>
                            <th>Jenis Ujian</th>
                            <th>Jumlah Soal</th>
                            <th>Harga</th>
                            <th>Publish</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>Judul Soal</th>
                            <th>Kategori Soal</th>
                            <th>Jumlah Soal</th>
                            <th>Harga</th>
                            <th>Publish</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($ujian as $val)
                        <tr>
                            <td><i class="mdi mdi-circle {{ $val->is_published ? "text-success" : "text-default" }}" title="{{ $val->is_published ? "Sudah Publish" : "Belum Publish" }}"></i></td>
                            <td>{{ $val->judul }}</td>
                            <td>{{ $val->jenisUjian->nama }}</td>
                            <td>{{ $val->jumlah_soal }} soal</td>
                            <td>{{ formatUang($val->harga) }}</td>
                            <td>{{ $val->is_published ? "Published" : "Draft" }}</td>
                            <td class="text-right">
                                <a href="{{ route('admin.ujian.soal.kelola', $val->id) }}" class="btn btn-xs btn-warning" title="Edit Soal Ujian" data-jumlahtiket=""><i class="mdi mdi-edit"></i></a>
                                <a href="{{ route('admin.ujian.soal.delete', $val->id) }}" class="btn btn-xs btn-danger delete"><i class="mdi mdi-delete"></i></a>
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

@section('script')
@endsection
