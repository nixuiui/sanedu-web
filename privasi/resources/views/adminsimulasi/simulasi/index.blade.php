@extends('layouts.admin')
@section('title')
Simulasi
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <a href="{{ route('adminsimulasi.simulasi.tambah') }}" class="btn btn-md btn-fill btn-primary btn-space btn-icon"><i class="mdi mdi-plus"></i> Buat Simulasi Baru</a>

        <div class="panel panel-default panel-table">
            <div class="panel-body table-responsive">
                <table id="datatables" class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Judul Simulasi</th>
                            <th>Tingkat Sekolah</th>
                            <th>Tanggal Pelaksanaan</th>
                            <th>Tempat Pelaksanaan</th>
                            <th>Harga</th>
                            <th>Peserta</th>
                            <th>Publish</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>Judul Simulasi</th>
                            <th>Tingkat Sekolah</th>
                            <th>Tanggal Pelaksanaan</th>
                            <th>Tempat Pelaksanaan</th>
                            <th>Harga</th>
                            <th>Peserta</th>
                            <th>Publish</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($simulasi as $data)
                        <tr>
                            <td><i class="mdi mdi-circle {{ $data->id_status == 1902 ? "text-success" : $data->id_status == 1903 ? "text-primary" : "text-default" }}" title="{{ $data->id_status == 1902 ? "Published" :  $data->id_status == 1903 ? "Pendaftaran Ditutup" : "Draft" }}"></i></td>
                            <td><a href="{{ route('adminsimulasi.simulasi.kelola', $data->id) }}" data-jumlahtiket="">{{ $data->judul }}</a></td>
                            <td>{{ $data->tingkatSekolah->nama }}</td>
                            <td>{{ $data->tanggal_pelaksanaan }} soal</td>
                            <td>{{ $data->tempat_pelaksanaan }} soal</td>
                            <td>{{ formatUang($data->harga) }}</td>
                            @if($data->peserta->count() > 0)
                            <td><a href="{{ route('adminsimulasi.simulasi.kelola.peserta', $data->id) }}">{{ $data->peserta->count() . " peserta" }}</a></td>
                            @else
                            <td>-</td>
                            @endif
                            <td>{{ $data->id_status == 1902 ? "Published" :  $data->id_status == 1903 ? "Pendaftaran Ditutup" : "Draft" }}</td>
                            <td class="text-right">
                                <a href="{{ route('adminsimulasi.simulasi.kelola', $data->id) }}" class="btn btn-xs btn-warning" title="Edit Soal Ujian" data-jumlahtiket=""><i class="mdi mdi-edit"></i></a>
                                <a href="{{ route('adminsimulasi.simulasi.kelola.delete', $data->id) }}" class="btn btn-xs btn-danger delete"><i class="mdi mdi-delete"></i></a>
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
