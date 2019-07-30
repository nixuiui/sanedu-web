@extends('layouts.admin')

@section('title')
Informasi
@endsection

@section('style')
@endsection

@section('script')
@endsection

@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                Menunggu Pembayaran
            </div>
            <div class="panel-body text-center">
                Mohon selesaikan pembayaran Anda sebelum tanggal <strong>{{ hariTanggalWaktu($topup->expired_date) }} WIB</strong> dengan rincian sebagai berikut.
            </div>
            <hr class="mb-0 mt-0">
            <div class="panel-body text-center">
                <div class="text-muted mb-3">JUMLAH YANG HARUS DIBAYAR</strong></div>
                <div style="font-size: 26px; font-weight: 500">{{ formatUang($topup->jumlah_bayar) }}</div>
            </div>
            <hr class="mb-0 mt-0">
            <div class="panel-body text-center">
                <div class="text-muted mb-3">PEMBAYARAN MELALUI <strong>{{ $topup->metodePembayaran->nama }}</strong></div>
                <div style="font-size: 26px; font-weight: 500">{{ $topup->metodePembayaran->nomor_rekening }}</div>
                <div class="text-muted mt-3">a/n {{ strtoupper($topup->metodePembayaran->nama_pemilik) }}</div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">PETUNJUK PEMBAYARAN</div>
            <div class="panel-body">
                {!! $topup->metodePembayaran->intruksi !!}
            </div>
        </div>
        <a href="{{ route('member.saldo') }}" class="btn btn-default btn-block btn-lg"><i class="mdi mdi-arrow-left mr-4"></i>Kembali</a>
    </div>
</div>
@endsection
