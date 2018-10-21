@extends('layouts.admin')
@section('title')
Pengawas Simulasi
@endsection
@section('content')
<div class="row">
    <div class="col-md-6">
        <a href="{{ route('adminsimulasi.simulasi.kelola', $simulasi->id) }}" class="btn btn-md btn-default btn-space"><i class="mdi mdi-arrow-left mr-3"></i> Kembali</a>
        <a href="{{ route('adminsimulasi.simulasi.kelola.pengawas.form', $simulasi->id) }}" class="btn btn-md btn-fill btn-primary btn-space"><i class="mdi mdi-plus mr-3"></i> Tambah Pengawas</a>
        <div class="panel panel-default panel-table">
            <div class="panel-body table-responsive">
                <table id="datatables" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama Pengawas</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Ruang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama Pengawas</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Ruang</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($simulasi->pengawas as $data)
                        <tr>
                            <td>{{ $data->profil->nama }}</td>
                            <td>{{ $data->profil->email }}</td>
                            <td>{{ $data->profil->no_hp }}</td>
                            <td>
                                @if($data->ruang)
                                <a href="{{ route('adminsimulasi.simulasi.kelola.ruang', ['id' => $simulasi->id, 'idRuang' => $data->ruang->id]) }}"><strong>{{ $data->ruang->nama }}</strong></a>
                                @endif
                            </td>
                            <td><a href="{{ route('adminsimulasi.simulasi.kelola.pengawas.form', ['id' => $simulasi->id, 'idPengawas' => $data->id]) }}" class="btn btn-xs btn-default">Atur Ruang</a></td>
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
