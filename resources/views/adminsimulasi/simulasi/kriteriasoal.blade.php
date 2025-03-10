@extends('layouts.admin')

@section('title')
Kriteria Soal
@endsection

@section('content')
<a href="{{ route('adminsimulasi.simulasi.kelola', $simulasi->id) }}" class="btn btn-default btn-space btn-icon"><i class="mdi mdi-arrow-back"></i>Kembali</a>
<a href="{{ route('adminsimulasi.simulasi.kelola.generate.kriteria.soal', $simulasi->id) }}" class="btn btn-default btn-space">Generate</a>
<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default panel-table">
            <div class="panel-heading">
                SOAL SAINTEK
            </div>
            <div class="panel-body">
                <table class="datatables table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Jumlah Benar</th>
                            <th class="text-center">Jumlah Salah</th>
                            <th class="text-center">Kriteria</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($soalSaintek as $i => $d)
                        <tr>
                            <td class="text-center">{{ $d->no }}</td>
                            <td class="text-center">{{ $d->jumlah_benar }}</td>
                            <td class="text-center">{{ $d->jumlah_salah }}</td>
                            <td class="text-center">{{ $d->kriteria }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default panel-table">
            <div class="panel-heading">
                SOAL SOSHUM
            </div>
            <div class="panel-body">
                <table class="datatables table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Jumlah Benar</th>
                            <th class="text-center">Jumlah Salah</th>
                            <th class="text-center">Kriteria</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($soalSoshum as $i => $d)
                        <tr>
                            <td class="text-center">{{ $d->no }}</td>
                            <td class="text-center">{{ $d->jumlah_benar }}</td>
                            <td class="text-center">{{ $d->jumlah_salah }}</td>
                            <td class="text-center">{{ $d->kriteria }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
