@extends('layouts.adminnopadding')

@section('title')
Pengaturan
@endsection

@section('description')

@endsection

@section('navigation')
    @include('admin.setting.menu')
@endsection

@section('content')
<div class="email-inbox-header">
    <div class="row">
        <div class="col-md-12">
            <div class="email-title">
                <span class="icon mdi mdi-accounts-alt mr-3"></span> Metode Pembayaran Sanedu
            </div>
        </div>
    </div>
</div>
<div class="panel no-border no-radius mb-0">
    <div class="panel-body">
        <a href="{{ route('admin.setting.metode.pembayaran.form') }}" class="btn btn-default btn-md btn-icon btn-hspace btn-rounded"><i class="mdi mdi-plus"></i>Tambah Metode Pembayaran</a>
    </div>
</div>
<div class="panel panel-default panel-table no-border mb-0">
    <div class="panel-body">
        <table class="table table-borderless table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Logo</th>
                    <th>Nama</th>
                    <th>No. Rekening</th>
                    <th>Nama Pemilik</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($metodePembayaran as $i => $data)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $data->logo }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->nomo_rekening }}</td>
                    <td>{{ $data->nama_pemilik }}</td>
                    <td class="text-right">
                        <a href="{{ route('admin.setting.metode.pembayaran.form', $data->id) }}" class="btn btn-xs btn-default print" title="Cetak Tiket"><i class="mdi mdi-edit"></i></a>
                        <a href="{{ route('admin.setting.metode.pembayaran.delete', $data->id) }}" class="btn btn-xs btn-danger delete"><i class="mdi mdi-delete"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')
@endsection
