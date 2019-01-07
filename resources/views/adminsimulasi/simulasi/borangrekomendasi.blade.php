@extends('layouts.admin')

@section('title')
Borang Rekomendasi - {{ $simulasi->judul }}
@endsection

@section('content')
<a href="{{ route('adminsimulasi.simulasi.kelola', ['id' => $simulasi->id]) }}" class="btn btn-default btn-space btn-icon"><i class="mdi mdi-arrow-back"></i>Kembali</a>
<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default panel-table">
            <div class="panel-heading">
                Peserta Saintek
            </div>
            <div class="panel-body table-responsive">
                <table class="table datatables table-striped">
                    <thead>
                        <tr>
                            <th>Cluster</th>
                            <th>Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i=0; $i<$saintek; $i++)
                        <tr>
                            <td>Cluster {{ $i+1 }}</td>
                            <td><a href="{{ route('adminsimulasi.simulasi.kelola.download.borang', ['id' => $simulasi->id, 'idMapel' => 1516, 'cluster' => $i+1]) }}" class="btn btn-default btn-md">Download</a></td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default panel-table">
            <div class="panel-heading">
                Peserta Soshum
            </div>
            <div class="panel-body table-responsive">
                <table class="table datatables table-striped">
                    <thead>
                        <tr>
                            <th>Cluster</th>
                            <th>Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i=0; $i<$soshum; $i++)
                        <tr>
                            <td>Cluster {{ $i+1 }}</td>
                            <td><a href="{{ route('adminsimulasi.simulasi.kelola.download.borang', ['id' => $simulasi->id, 'idMapel' => 1517, 'cluster' => $i+1]) }}" class="btn btn-default btn-md">Download</a></td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
