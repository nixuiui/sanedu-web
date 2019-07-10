@extends('layouts.adminnopadding')

@section('title')
Passing Grade
@endsection

@section('navigation')
@include('admin.passgrade.menu')
@endsection

@section('content')
<div class="email-inbox-header">
    <div class="row">
        <div class="col-md-12">
            <div class="email-title">
                <span class="icon mdi mdi-accounts-alt mr-3"></span> Passing Grade
            </div>
        </div>
    </div>
</div>
<div class="panel no-border no-radius mb-0">
    <div class="panel-body">
        @include('partials.admin.helpers.alert')
        <div class="btn-group btn-hspace">
            <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">
                Passing Grade Tahun {{ $activeYears }} <span class="icon-dropdown mdi mdi-chevron-down"></span>
            </button>
            <ul role="menu" class="dropdown-menu">
                @foreach($years as $year)
                <li><a href="{{ route('admin.passgrade', ['tahun' => $year->tahun]) }}">{{$year->tahun}}</a></li>
                @endforeach
                <li class="divider"></li>
                <li><a href="{{ route('admin.passgrade.create', ['tahun' => $years->last()->tahun + 1]) }}">Buat Passing Grade Tahun {{ $years->last()->tahun + 1 }}</a></li>
            </ul>
        </div>
        <a href="{{ route('admin.passgrade.form.univ') }}"
            class="btn btn-md btn-primary btn-rounded pull-right btn-icon">
            <i class="mdi mdi-plus"></i> Tambah Data Universitas
        </a>
    </div>
</div>

<div class="panel panel-default panel-table table-responsive no-border mb-0">
    <div class="panel-body">
        <table id="datatables" class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Universitas</th>
                    <th>Jumlah Jurusan</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Universitas</th>
                    <th>Jumlah Jurusan</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach($universitas as $no => $w)
                <tr>
                    <td>{{ $no+1 }}</td>
                    <td>
                        <a href="{{ route('admin.passgrade.open.univ', $w->id) }}">{{ $w->nama }}</a>
                    </td>
                    <td>{{ $w->jurusan->count() }} jurusan</td>
                    <td class="text-right">
                        <a href="{{ route('admin.passgrade.open.univ', $w->id) }}" class="btn btn-xs btn-default"
                            title="Lihat Passing Grade"><i class="mdi mdi-eye"></i></a>
                        <a href="{{ route('admin.passgrade.form.univ', $w->id) }}" class="btn btn-xs btn-success"
                            title="Lihat Passing Grade"><i class="mdi mdi-edit"></i></a>
                        {{-- <a href="{{ route('admin.passgrade.delete.univ', $w->id) }}" class="btn btn-xs
                        btn-danger delete"><i class="mdi mdi-delete"></i></a> --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
</script>
@endsection