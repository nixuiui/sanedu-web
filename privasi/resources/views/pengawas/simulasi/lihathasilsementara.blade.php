@extends('layouts.admin')

@section('title')
Hasil Sementara - {{ $simulasi->judul }}
@endsection

@section('content')
<a href="{{ route('pengawas.simulasi.kelola', $simulasi->id) }}" class="btn btn-default btn-space btn-icon"><i class="mdi mdi-arrow-back"></i>Kembali</a>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default panel-table">
            <div class="panel-body table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="200px">No Peserta</th>
                            <th width="300px">Nama</th>
                            @for($i=0; $i < $jumlahSoal; $i++)
                            <th class="text-center">{{ $i+1 }}</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($peserta as $data)
                        <tr>
                            <td>{{ $data->no_peserta }}</td>
                            <td>{{ $data->profil->nama }}</td>
                            @for($i=0; $i < $jumlahSoal; $i++)
                            <td class="text-center">
                                {{ $data->koreksi[$i]->jawaban != null ? $data->koreksi[$i]->jawaban : "-" }}
                            </td>
                            @endfor
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
