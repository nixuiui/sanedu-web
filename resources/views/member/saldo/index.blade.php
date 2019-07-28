@extends('layouts.admin')

@section('title')
Saldo
@endsection

@section('style')
@endsection

@section('script')
@endsection

@section('content')
@if(isset($_GET['topup']))
<?php
$kodeUnik = rand(100,999);
$jumlahBayar = $_GET['saldo'] + $kodeUnik;
?>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row mb-3">
                    <div class="col-xs-6">
                        Harga
                    </div>
                    <div class="col-xs-6 text-right">
                        {{ formatUang($_GET['saldo']) }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-xs-6">
                        Harga
                    </div>
                    <div class="col-xs-6 text-right">
                        {{ formatUang($kodeUnik) }}
                    </div>
                </div>
                <hr class="mb-4 mt-0">
                <div class="row">
                    <div class="col-xs-6">
                        <strong>Total Pembayaran</strong>
                    </div>
                    <div class="col-xs-6 text-right">
                        <strong>{{ formatUang($jumlahBayar) }}</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <form class="panel-body" action="{{ route('member.saldo.topup') }}" method="POST">
                @csrf
                <input type="hidden" name="jumlah_bayar" value="{{ $jumlahBayar }}">
                <input type="hidden" name="saldo" value="{{ $_GET['saldo'] }}">
                <label for="">Pilih Metode Pembayaran</label>
                <select name="metode_pembayaran" class="form-control mb-4" required>
                    @foreach ($metodePembayaran as $data)
                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                    @endforeach
                </select>
                <button type="submit" name="topup" class="btn btn-success btn-lg btn-block">Lanjutkan
                    Pembayaran</button>
            </form>
        </div>
    </div>
</div>
@else
<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="text-success">
                    SALDO ANDA
                </div>
                <div style="font-size: 30px"><strong>{{ formatUang(Auth::user()->saldo) }}</strong></div>
            </div>
            <hr class="mt-0 mb-0">
            <form class="panel-body" action="" method="GET">
                <div class="mb-3">Nominal Top-up</div>
                <select name="saldo" class="form-control mb-4" required>
                    <option value="5000">Rp 5.000</option>
                    <option value="10000">Rp 10.000</option>
                    <option value="20000">Rp 20.000</option>
                    <option value="50000">Rp 50.000</option>
                    <option value="100000">Rp 100.000</option>
                </select>
                <button type="submit" name="topup" class="btn btn-success btn-lg btn-block">TOP-UP</button>
            </form>
        </div>
        @if($topup->count() > 0)
        <div class="panel panel-default panel-table">
            <div class="panel-heading">
                <div class="title">Top-up Menunggu Dibayar</div>
            </div>
            <div class="panel-body table-responsive">
                <table class="table table-striped table-borderless">
                    <tbody class="no-border-x">
                        @foreach ($topup as $data)
                        <tr>
                            <td>{{ formatUang($data->saldo) }}</td>
                            <td class="text-right">
                                <a href="{{ route('member.saldo.petunjuk.bayar', $data->id) }}" class="text-primary">Lihat Petunjuk Bayar</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
    <div class="col-md-8">
        <div class="panel panel-default panel-table">
            <div class="panel-heading">
                Riwayat Transaksi
            </div>
            <div class="panel-body table-responsive">
                @if($riwayat->count() <= 0)
                <div class="data-is-empty">
                    <h5>BELUM ADA RIWAYAT TRANSAKSI</h5>
                </div>
                @else
                <table id="datatables" class="table table-striped table-hover table-borderless">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Deb/Crd</th>
                            <th class="text-left">Saldo</th>
                            <th class="text-center">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="no-border-x">
                        @foreach ($riwayat as $key => $val)
                        <tr class="clickable-row" data-href="">
                            <td>{{ $key+1 }}</td>
                            <td>{{ formatUang($val->deb_cr) }}</td>
                            <td>{{ formatUang($val->saldo) }}</td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
</div>
@endif
@endsection