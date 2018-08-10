@extends('layouts.admin')
@section('title')
Passing Grade
@endsection

@section('content')
<a href="{{ route('admin.passgrade.form.univ') }}" class="btn btn-md btn-primary btn-space btn-icon"> <i class="mdi mdi-plus"></i> Tambah Data Universitas</a>
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default panel-table">
            <div class="panel-heading">
                Universitas
            </div>
            <div class="panel-body">
                <table id="datatables" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Universitas</th>
                            <th>Jumlah Jurusan</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Universitas</th>
                            <th>Jumlah Jurusan</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($universitas as $no => $w)
                        <tr>
                            <td>{{ $no+1 }}</td>
                            <td>
                                <a href="{{ route('admin.passgrade.open.univ', $w->id) }}" >{{ $w->nama }}</a>
                            </td>
                            <td>{{ $w->jurusan->count() }} jurusan</td>
                            <td class="text-right">
                                <a href="{{ route('admin.passgrade.open.univ', $w->id) }}" class="btn btn-xs btn-default" title="Lihat Passing Grade"><i class="mdi mdi-eye"></i></a>
                                <a href="{{ route('admin.passgrade.form.univ', $w->id) }}" class="btn btn-xs btn-success" title="Lihat Passing Grade"><i class="mdi mdi-edit"></i></a>
                                <a href="{{ route('admin.informasi.delete', $w->id) }}" class="btn btn-xs btn-danger delete"><i class="mdi mdi-delete"></i></a>
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
<script type="text/javascript">
</script>
@endsection
