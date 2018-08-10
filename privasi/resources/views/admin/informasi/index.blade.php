@extends('layouts.admin')
@section('title')
Informasi
@endsection
@section('content')
<a href="{{ route('admin.informasi.form') }}" class="btn btn-md btn-primary btn-space btn-icon"> <i class="mdi mdi-plus"></i> Tambah Informasi</a>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default panel-table">
            <div class="panel-heading">
                Informasi
            </div>
            <div class="panel-body">
                <table id="datatables" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Penulis</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Penulis</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($informasi as $no => $w)
                        <tr>
                            <td>{{ $no+1 }}</td>
                            <td>
                                {{ $w->judul }} <br>
                                <small><span class="text-muted">{{ hariTanggalWaktu($w->created_at) }}</span></small>
                            </td>
                            <td>{{ $w->kategori->nama }}</td>
                            <td>{{ $w->author->nama }}</td>
                            <td class="text-right">
                                <a href="{{ route('admin.informasi.form', $w->id) }}" class="btn btn-xs btn-default" title="Cetak Tiket"><i class="mdi mdi-edit"></i></a>
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
