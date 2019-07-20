@extends('layouts.admin')

@section('title')
Passing Grade
@endsection

@section('content')
<div class="page-loader"></div>
<div class="row" id="passgrade">
    <div class="col-md-4 col-md-offset-4 col-sm-8 col-sm-offser-2">
        <form class="panel panel-preattempt" action="{{ route('member.passgrade.beli', $universitas->id) }}" method="POST">
            @csrf
            <div class="panel-heading">PASSING GRADE</div>
            <div class="panel-section" style="min-height: 250px">
                <div class="row">
                    <div class="col-xs-6">
                        {{ $universitas->nama }}
                    </div>
                    <div class="col-xs-6 text-right">
                        {{ formatUang($universitas->harga) }}
                    </div>
                </div>
            </div>
            <div class="panel-section">
                <div class="row">
                    <div class="col-xs-6 text-bold">
                        SALDO ANDA
                    </div>
                    <div class="col-xs-6 text-right">
                        {{ formatUang(Auth::user()->saldo) }}
                    </div>
                </div>
            </div>
            <div class="panel-section text-right">
                <div v-if="voucherOpened">
                    <div class="mb-3 text-muted cursor-pointer" @click="openVoucher">Tutup<i class="mdi mdi-close ml-3"></i></div>
                    <input type="number" name="voucher" class="form-control input-sm" placeholder="Masukan Kode Voucher">
                </div>
                <span class="cursor-pointer text-primary" @click="openVoucher" v-else>Gunakan Kode Voucher</span>
            </div>
            <div class="panel-section">
                <button type="submit" class="btn btn-success btn-block">Bayar Sekarang</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('script')
<script>
var app = new Vue({
    el: "#passgrade",
    data: {
        saldo: {!! Auth::user()->saldo !!},
        voucherOpened: false
    },
    methods: {
        openVoucher: function() {
            this.voucherOpened = !this.voucherOpened;
        }
    }
})
</script>
@endsection