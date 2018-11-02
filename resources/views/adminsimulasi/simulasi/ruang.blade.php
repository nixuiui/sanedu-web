@extends('layouts.admin')
@section('title')
Ruang Simulasi
@endsection
@section('content')
<div class="row">
    <div class="col-md-8">
        <a href="{{ route('adminsimulasi.simulasi.kelola', $simulasi->id) }}" class="btn btn-md btn-default btn-space"><i class="mdi mdi-arrow-left mr-3"></i> Kembali</a>
        <a href="{{ route('adminsimulasi.simulasi.kelola.ruang.form', $simulasi->id) }}" class="btn btn-md btn-fill btn-primary btn-space"><i class="mdi mdi-plus mr-3"></i> Tambah Ruang</a>
        <a href="{{ route('adminsimulasi.simulasi.kelola.pindah.ruang', $simulasi->id) }}" class="btn btn-md btn-fill btn-primary btn-space"><i class="mdi mdi-plus mr-3"></i> Pindah Ruang</a>
        <div class="panel panel-default panel-table">
            <div class="panel-body table-responsive">
                <table id="datatables" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama Ruang</th>
                            <th>Mapel</th>
                            <th>Alamat</th>
                            <th>Kursi</th>
                            <th>Pengawas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama Ruang</th>
                            <th>Mapel</th>
                            <th>Alamat</th>
                            <th>Kursi</th>
                            <th>Pengawas</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($simulasi->ruang as $data)
                        <tr>
                            <td><strong><a href="{{ route('adminsimulasi.simulasi.kelola.ruang', ['id' => $simulasi->id, 'idRuang' => $data->id]) }}">{{ $data->nama }}</a></strong></td>
                            <td>{{ $data->ruangMapel->nama }}</td>
                            <td>{{ $data->alamat }}</td>
                            <td>{{ $data->jumlah_peserta }}/{{ $data->kapasitas }} Orang</td>
                            <td>{{ $data->pengawas->count() }}</td>
                            <td class="text-right">
                                <a href="{{ route('adminsimulasi.simulasi.kelola.ruang.form', ['id' => $simulasi->id, 'idRuang' => $data->id]) }}" class="btn btn-xs btn-success" title="Edit Agenda"><i class="mdi mdi-edit"></i></a>
                                <a href="{{ route('adminsimulasi.simulasi.kelola.ruang.delete', ['id' => $simulasi->id, 'idRuang' => $data->id]) }}" class="btn btn-xs btn-danger delete" title="Hapus Agenda"><i class="mdi mdi-delete"></i></a>
                                <a href="{{ route('adminsimulasi.simulasi.kelola.ruang.absen', ['id' => $simulasi->id, 'idRuang' => $data->id]) }}" class="btn btn-xs btn-default" title="Print Absen"><i class="mdi mdi-print"></i></a>
                                <a href="{{ route('adminsimulasi.simulasi.kelola.ruang.borang', ['id' => $simulasi->id, 'idRuang' => $data->id]) }}" class="btn btn-xs btn-default" title="Borang"><i class="mdi mdi-download mr-3"></i>Borang Rekomendasi</a>
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
