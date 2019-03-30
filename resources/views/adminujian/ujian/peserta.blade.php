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
                <span class="icon mdi mdi-accounts-alt mr-3"></span> Peserta Ujian
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default panel-table no-border mb-0">
    <div class="panel-body">
        @if($ujian->diBeliOleh->count() <= 0)
        <div class="data-is-empty">
            <p><i class="mdi mdi-close-circle"></i></p>
            <p>BELUM ADA PESERTA UJIAN</p>
        </div>
        @else
        <table id="datatables" class="table datatables table-borderless table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peserta</th>
                    <th>Email</th>
                    <th>Pengerjaan</th>
                    <th>No HP</th>
                    <th>Sekolah</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Nama Peserta</th>
                    <th>Email</th>
                    <th>Pengerjaan</th>
                    <th>No HP</th>
                    <th>Sekolah</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach($ujian->diBeliOleh as $i => $data)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->email }}</td>
                    <td><a href="{{ route('admin.ujian.soal.history', $ujian->id)."?idPeserta=$data->id" }}" class="block hover-underline">{{ $data->attempt->where('id_ujian', $ujian->id)->count() }}x</a></td>
                    <td>{{ $data->no_hp }}</td>
                    <td>{{ $data->asal_sekolah }}</td>
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
