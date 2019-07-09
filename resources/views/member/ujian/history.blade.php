@extends('layouts.admin')

@section('title')
Riwayat Pengerjaan Soal
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default panel-table">
            <div class="panel-heading">
                History Ujian
            </div>
            <div class="panel-body">
                <div class="table-responsive noSwipe">
                    <table id="datatables" class="table datatables table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Ujian</th>
                                <th>Soal</th>
                                <th>Nilai</th>
                                <th>Waktu</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Ujian</th>
                                <th>Soal</th>
                                <th>Nilai</th>
                                <th>Waktu</th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($history as $i => $data)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{ $data->ujian->jenisUjian->nama }}</td>
                                <td><a href="{{ route('member.ujian.soal.preattempt', ['idSoal' => $data->ujian->id]) }}">{{ $data->ujian->judul }}</a></td>
                                <td>{{ $data->jumlah_benar }}</td>
                                <td>{{ hariTanggalWaktu($data->start_attempt) }}</td>
                                <td><a href="{{ route('member.ujian.history', $data->id) }}" target="_blank"><i class="mdi mdi-open-in-new"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
