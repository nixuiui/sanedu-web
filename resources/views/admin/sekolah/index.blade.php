@extends('layouts.admin')

@section('title')
Sekolah
@endsection

@section('content')
<a href="{{ route('admin.sekolah.tambah') }}" class="btn btn-primary btn-space"><i class="mdi mdi-plus mr-3"></i>Tambah Sekolah</a>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default panel-table">
            <div class="panel-heading">
                Data Sekolah
            </div>
            <div class="panel-body table-responsive noSwipe">
                <table id="datatables" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Provinsi</th>
                            <th>Kabupaten</th>
                            <th>Sekolah</th>
                            <th>Siswa Terdaftar</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sekolah as $data)
                        <tr>
                            <td>{{ $data->provinsi->name }}</td>
                            <td>{{ $data->kota->name }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->siswa->count() }} orang</td>
                            <td>
                                <a href="{{ route('admin.sekolah.delete', $data->id) }}" class="btn btn-xs btn-danger"><i class="mdi mdi-delete mr-2"></i>Hapus</a>
                                <a href="{{ route('admin.sekolah.edit', $data->id) }}" class="btn btn-xs btn-success"><i class="mdi mdi-edit mr-2"></i>Edit</a>
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
