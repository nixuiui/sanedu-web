@extends('layouts.adminnopadding')

@section('title')
Kelola Sekolah
@endsection

@section('navigation')
    @include('admin.sekolah.menu', ['jumlahSekolahBaru', $jumlahSekolahBaru])
@endsection

@section('content')
<div class="email-inbox-header">
    <div class="row">
        <div class="col-md-12">
            <div class="email-title">
                <span class="icon mdi mdi-balance mr-3"></span> Data Sekolah
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default panel-table no-border mb-0">
    <div class="panel-body table-responsive noSwipe">
        @if($siswa->count() <= 0)
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
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Nama Peserta</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>No HP Ortu</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach($siswa as $i => $data)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ $data->no_hp }}</td>
                    <td>{{ $data->no_hp_ortu }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection
