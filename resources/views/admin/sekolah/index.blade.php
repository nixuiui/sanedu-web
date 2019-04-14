@extends('layouts.adminnopadding')

@section('title')
Kelola Sekolah
@endsection

@section('navigation')
    @include('admin.sekolah.menu')
@endsection

@section('content')
<div class="email-inbox-header">
    <div class="row">
        <div class="col-md-12">
            <div class="email-title">
                <span class="icon mdi mdi-balance mr-3"></span> Data Sekolah
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default panel-table no-border mb-0">
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
                    <td>{{ $data['provinsi'] }}</td>
                    <td>{{ $data['kota'] }}</td>
                    <td>{{ $data['nama'] }}</td>
                    <td>{{ $data['siswa'] }} orang</td>
                    <td>
                        <a href="{{ route('admin.sekolah.delete', $data['id']) }}" class="btn btn-xs btn-danger"><i class="mdi mdi-delete mr-2"></i>Hapus</a>
                        <a href="{{ route('admin.sekolah.edit', $data['id']) }}" class="btn btn-xs btn-success"><i class="mdi mdi-edit mr-2"></i>Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
