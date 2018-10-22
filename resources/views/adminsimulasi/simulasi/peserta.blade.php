@extends('layouts.admin')

@section('title')
Peserta Simulasi - {{ $simulasi->judul }}
@endsection

@section('content')
<a href="{{ URL::previous() }}" class="btn btn-default btn-space btn-icon"><i class="mdi mdi-arrow-back"></i>Kembali</a>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default panel-table">
            <div class="panel-heading">
                Data Member Yang Membeli {{ $simulasi->judul }}
            </div>
            <div class="panel-body table-responsive">
                <table id="datatables" class="table datatables table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Sekolah</th>
                            <th>Ruang</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Peserta</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Sekolah</th>
                            <th>Ruang</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($simulasi->peserta as $i => $peserta)
                        <tr>
                            <td><i class="mdi mdi-circle {{ $peserta->mode_simulasi == 'online' ? "text-success" : "text-default" }}" title="{{ $peserta->mode_simulasi }}"></i></td>
                            <td>{{ $peserta->no_peserta }}</td>
                            <td>{{ $peserta->profil->nama }}</td>
                            <td>{{ $peserta->profil->username }}</td>
                            <td>{{ $peserta->profil->email }}</td>
                            <td>{{ $peserta->profil->no_hp }}</td>
                            <td>{{ $peserta->profil->asal_sekolah }}</td>
                            <td>
                                @if($peserta->mode_offline)
                                <strong><a href="{{ route('adminsimulasi.simulasi.kelola.ruang', ['id' => $simulasi->id, 'idRuang' => $peserta->ruang->id]) }}">{{ $peserta->ruang->nama }}</a></strong>
                                @else
                                -
                                @endif
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
