@extends('layouts.adminnopadding')

@section('title')
Kelola Ujian
@endsection

@section('description')
{{ $ujian->judul }}
@endsection

@section('navigation')
    @include('adminujian.ujian.menu', ['jumlahSoal' => $ujian->soal->count(), 'jumlahPeserta' => $ujian->diBeliOleh->count(), 'jumlahRiwayat' => $ujian->attempt->count()])
@endsection

@section('content')
<div class="email-inbox-header">
    <div class="row">
        <div class="col-md-12">
            <div class="email-title">
                <span class="icon mdi mdi-accounts-alt mr-3"></span> Riwayat Pengerjaan Ujian oleh {{ $peserta ? $peserta->nama : "Semua Peserta" }}
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default panel-table no-border mb-0">
    <div class="panel-body">
        @if($history->count() <= 0)
        <div class="data-is-empty">
            <p><i class="mdi mdi-close-circle"></i></p>
            <p>BELUM ADA RIWAYAT PENGERJAAN UJIAN</p>
        </div>
        @else
        <table id="datatables" class="table datatables table-borderless table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peserta</th>
                    <th>Nilai</th>
                    <th class="text-center">Benar</th>
                    <th class="text-center">Salah</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Nama Peserta</th>
                    <th>Nilai</th>
                    <th class="text-center">Benar</th>
                    <th class="text-center">Salah</th>
                    <th>Waktu</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach($history as $i => $data)
                <tr class="clickable-row" data-href='{{ route('admin.ujian.soal.history', ['id' => $ujian->id, 'idAttempt' => $data->id]) }}'>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $data->user->nama }}</td>
                    <td class="milestone">
                        <span class="completed"><strong>{{ $data->jumlah_benar }}</strong>/{{ $ujian->jumlah_soal }}</span>
                        <span class="version">-</span>
                        <div class="progress">
                            <div style="width: {{ ($data->jumlah_benar/$ujian->jumlah_soal)*100 }}%" class="progress-bar progress-bar-primary"></div>
                        </div>
                    </td>
                    <td class="text-center">{{ $data->jumlah_benar }}</td>
                    <td class="text-center">{{ $data->jumlah_salah }}</td>
                    <td>{{ hariTanggalWaktu($data->start_attempt) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection

@section('script')
@endsection
