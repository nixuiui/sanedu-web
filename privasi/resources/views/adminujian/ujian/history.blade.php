@extends('layouts.admin')

@section('title')
History - {{ $ujian->judul }}
@endsection

@section('content')
<a href="{{ URL::previous() }}" class="btn btn-default btn-space btn-icon"><i class="mdi mdi-arrow-back"></i>Kembali</a>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default panel-table">
            <div class="panel-heading">
                Data Pengerjaan {{ $ujian->judul }} oleh Member
            </div>
            <div class="panel-body">
                <table id="datatables" class="table datatables table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Peserta</th>
                            <th>Ujian</th>
                            <th>Soal</th>
                            <th>Nilai</th>
                            <th class="text-center">Benar</th>
                            <th class="text-center">Salah</th>
                            <th>Waktu</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Peserta</th>
                            <th>Ujian</th>
                            <th>Soal</th>
                            <th>Nilai</th>
                            <th class="text-center">Benar</th>
                            <th class="text-center">Salah</th>
                            <th>Waktu</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($history as $i => $data)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $data->user->nama }}</td>
                            <td>{{ $data->ujian->jenisUjian->nama }}</td>
                            <td>{{ $data->ujian->judul }}</td>
                            <td class="text-center">{{ $data->jumlah_benar }}</td>
                            <td class="text-center">{{ $data->jumlah_benar }}</td>
                            <td class="text-center">{{ $data->jumlah_salah }}</td>
                            <td>{{ hariTanggalWaktu($data->start_attempt) }}</td>
                            <td><a href="{{ route('admin.ujian.soal.history', ['id' => $ujian->id, 'idAttempt' => $data->id]) }}"><i class="mdi mdi-open-in-new"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
