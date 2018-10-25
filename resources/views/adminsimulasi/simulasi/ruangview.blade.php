@extends('layouts.admin')
@section('title')
Simulasi - Ruang  {{ $ruang->nama }}
@endsection
@section('content')
<a href="{{ route('adminsimulasi.simulasi.kelola', $simulasi->id) }}" class="btn btn-md btn-default btn-space"><i class="mdi mdi-arrow-left mr-3"></i> Kembali</a>
<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default panel-table">
            <div class="panel-heading">
                Data Pengawas
            </div>
            <div class="panel-body table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="10px">No</th>
                            <th>Nama Pengawas</th>
                            <th>NO HP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($ruang->pengawas->count() > 0)
                        @foreach($ruang->pengawas as $i => $data)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $data->profil->nama }}</td>
                            <td>{{ $data->profil->no_hp }}</td>
                        </tr>
                        @endforeach
                        @else
                        <td colspan="3" class="text-center">
                            Belum ada pengawas untuk ruangan ini
                            <a href="{{ route('adminsimulasi.simulasi.kelola.pengawas.form', $simulasi->id) }}">Tambah Pengawas</a>
                        </td>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="panel panel-default panel-table">
            <div class="panel-heading">
                Data Peserta
            </div>
            <div class="panel-body table-responsive">
                <table id="datatables" class="table datatables table-striped">
                    <thead>
                        <tr>
                            <th>No Peserta</th>
                            <th>Nama Peserta</th>
                            <th>Sekolah</th>
                            <th>No HP</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($ruang->peserta->count() > 0)
                            @foreach($ruang->peserta as $i => $data)
                            <tr>
                                <td>{{ $data->pivot->no_peserta }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->asal_sekolah }}</td>
                                <td>{{ $data->no_hp }}</td>
                                <td>{{ $data->email }}</td>
                            </tr>
                            @endforeach
                        @else
                                <td colspan="5" class="text-center">Belum ada peserta untuk ruangan ini</td>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> <!-- end row -->

@endsection

@section('script')
@endsection
