@extends('layouts.adminnopadding')

@section('title')
Member
@endsection

@section('description')

@endsection

@section('navigation')
    @include('admin.member.menu')
@endsection

@section('content')
<div class="email-inbox-header">
    <div class="row">
        <div class="col-md-12">
            <div class="email-title">
                <span class="icon mdi mdi-accounts-alt mr-3"></span> Member Sanedu
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default panel-table no-border mb-0">
    <div class="panel-body">
        @if($users->count() <= 0)
        <div class="data-is-empty">
            <p><i class="mdi mdi-close-circle"></i></p>
            <p>BELUM ADA MEMBER</p>
        </div>
        @else
        <table id="datatables" class="table datatables table-borderless table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peserta</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>No HP Ortu</th>
                    <th>Provinsi</th>
                    <th>Sekolah</th>
                    <th>Saldo</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Nama Peserta</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>No HP Ortu</th>
                    <th>Provinsi</th>
                    <th>Sekolah</th>
                    <th>Saldo</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach($users as $i => $data)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ $data->no_hp }}</td>
                    <td>{{ $data->no_hp_ortu }}</td>
                    <td>{{ $data->provinsi != null ? $data->provinsi->name : "" }}</td>
                    <td>{{ $data->sekolah != null ? $data->sekolah->nama : "" }}</td>
                    <td>{{ formatUang($data->saldo) }}</td>
                    <td>
                        <a href="{{ route('admin.member.delete', $data->id) }}" class="btn btn-xs btn-danger delete" title="Delete">
                            <i class="mdi mdi-delete"></i>
                        </a>
                        <a href="{{ route('admin.member.edit', $data->id) }}" class="btn btn-xs btn-default" title="Edit">
                            <i class="mdi mdi-edit"></i>
                        </a>
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
