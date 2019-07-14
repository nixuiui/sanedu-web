@extends('layouts.adminnopadding')

@section('title')
Voucher Passing Grade
@endsection

@section('navigation')
@include('admin.passgrade.menu')
@endsection

@section('content')
<div class="email-inbox-header">
    <div class="row">
        <div class="col-md-12">
            <div class="email-title">
                <span class="icon mdi mdi-ticket-star mr-3"></span> Voucher Passing Grade
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default panel-table table-responsive no-border mb-0">
    <div class="panel-body">
        <table id="datatables" class="table table-striped">
            <thead>
                <tr>
                    <th>PIN</th>
                    <th>Tanggal Cetak</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>PIN</th>
                    <th>Tanggal Cetak</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach($voucher as $data)
                <tr>
                    <td>{{ $data->pin }}</td>
                    <td>
                        <a href="{{ route('admin.passgrade.tiket.detail', ['idCetak' => $data->id_cetak_tiket]) }}" title="Detail Tiket">{{ hariTanggalWaktu($data->cetakVoucher->created_at) }}</a>
                    </td>
                    <td>{{ $data->user != null ? $data->user->nama : "-" }}</td>
                    <td>{{ $data->user != null ? $data->user->username : "-" }}</td>
                    <td>
                        @if($data->user != null)
                        <a href="{{ route('admintiket.tiket.member.data.edit', $data->user->id) }}" class="btn btn-xs btn-success" title="Edit Data Member"> <i class="mdi mdi-edit"></i> </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection