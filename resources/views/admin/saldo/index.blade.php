@extends('layouts.adminnopadding')

@section('title')
Saldo
@endsection

@section('description')

@endsection

@section('navigation')
    @include('admin.saldo.menu')
@endsection

@section('content')
<div class="email-inbox-header">
    <div class="row">
        <div class="col-md-12">
            <div class="email-title">
                <span class="icon mdi mdi-accounts-alt mr-3"></span> Request Top Up
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default panel-table no-border mb-0">
    <div class="panel-body">
        @if($topup->count() <= 0)
        <div class="data-is-empty">
            <p><i class="mdi mdi-close-circle"></i></p>
            <p>BELUM ADA MEMBER</p>
        </div>
        @else
        <table id="datatables" class="table datatables table-borderless table-striped table-hover">
            <thead>
                <tr>
                    <th>Member</th>
                    <th>Saldo</th>
                    <th>Jumlah Bayar</th>
                    <th>Pembayaran</th>
                    <th>Expired Date</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Member</th>
                    <th>Saldo</th>
                    <th>Jumlah Bayar</th>
                    <th>Pembayaran</th>
                    <th>Expired Date</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach($topup as $i => $data)
                <tr>
                    <td class="user-avatar"> 
                        <img src="{{asset('asset-beagle/img/avatar7.png')}}" alt="Avatar">{{ $data->user->nama }} ({{ "@".$data->user->username }})
                    </td>
                    <td>{{ formatUang($data->saldo) }}</td>
                    <td>{{ formatUang($data->jumlah_bayar) }}</td>
                    <td>{{ $data->metodePembayaran->nama }}</td>
                    <td>{{ hariTanggalWaktu($data->expired_date) }}</td>
                    <td>
                        <a href="{{ route('admin.saldo.topup.approve', $data->id) }}" class="btn btn-default"><i class="mdi mdi-check-circle text-success mr-3"></i>Setujui</a>
                        <a href="{{ route('admin.saldo.topup.delete', $data->id) }}" class="btn btn-danger delete"><i class="mdi mdi-delete"></i></a>
                    </td>
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
