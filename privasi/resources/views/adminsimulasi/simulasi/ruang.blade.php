@extends('layouts.admin')
@section('title')
Simulasi
@endsection
@section('content')
<div class="row">
    <div class="col-md-6">
        <a href="{{ route('adminsimulasi.simulasi.kelola', $simulasi->id) }}" class="btn btn-md btn-default btn-space"><i class="mdi mdi-arrow-left mr-3"></i> Kembali</a>
        <a href="{{ route('adminsimulasi.simulasi.kelola.ruang.form', $simulasi->id) }}" class="btn btn-md btn-fill btn-primary btn-space"><i class="mdi mdi-plus mr-3"></i> Tambah Ruang</a>
        <div class="panel panel-default panel-table">
            <div class="panel-body table-responsive">
                <table id="datatables" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama Ruang</th>
                            <th>Alamat</th>
                            <th>Kursi</th>
                            <th>Pengawas</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama Ruang</th>
                            <th>Alamat</th>
                            <th>Kursi</th>
                            <th>Pengawas</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($simulasi->ruang as $data)
                        <tr>
                            <td><strong><a href="{{ route('adminsimulasi.simulasi.kelola.ruang', ['id' => $simulasi->id, 'idRuang' => $data->id]) }}">{{ $data->nama }}</a></strong></td>
                            <td>{{ $data->alamat }}</td>
                            <td>{{ $data->jumlah_peserta }}/{{ $data->kapasitas }} Orang</td>
                            <td>{{ $data->pengawas->count() }}</td>
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
