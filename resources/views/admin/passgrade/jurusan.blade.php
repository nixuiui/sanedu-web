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
                <span class="icon mdi mdi-accounts-alt mr-3"></span> Passing Grade {{ $universitas->nama }}
            </div>
        </div>
    </div>
</div>
<div class="panel no-border no-radius mb-0">
    <div class="panel-body">
        <a href="{{ route('admin.passgrade.form.jurusan', $universitas->id) }}" class="btn btn-rounded btn-md btn-primary btn-space btn-icon"> <i class="mdi mdi-plus"></i> Tambah Data Passing Grade</a>
    </div>
</div>

<div class="panel panel-default panel-table table-responsive no-border mb-0">
    <div class="panel-body table-responsive noSwipe">
        <table id="datatables" class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Jurusan</th>
                    <th class="text-center">Kuota</th>
                    <th class="text-center">Peminat</th>
                    <th class="text-center">Pass Grade</th>
                    <th class="text-center">Akreditasi</th>
                    <th class="text-center">Soshum</th>
                    <th class="text-center">Saintek</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Jurusan</th>
                    <th class="text-center">Kuota</th>
                    <th class="text-center">Peminat</th>
                    <th class="text-center">Pass Grade</th>
                    <th class="text-center">Akreditasi</th>
                    <th class="text-center">Soshum</th>
                    <th class="text-center">Saintek</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach($jurusan as $no => $w)
                <tr>
                    <td>{{ $no+1 }}</td>
                    <td>{{ $w->jurusan }}</td>
                    <td class="text-center">{{ $w->kuota }}</td>
                    <td class="text-center">{{ $w->peminat }}</td>
                    <td class="text-center">{{ $w->passing_grade }}</td>
                    <td class="text-center">{{ $w->akreditasi }}</td>
                    <td class="text-center">{!! $w->soshum == 1 ? "<i class='mdi mdi-check-circle text-success'></i>" : "" !!}</td>
                    <td class="text-center">{!! $w->saintek == 1 ? "<i class='mdi mdi-check-circle text-success'></i>" : "" !!}</td>
                    <td class="text-right">
                        <a href="{{ route('admin.passgrade.form.jurusan', ['id' => $universitas->id, 'idJur' => $w->id]) }}" class="btn btn-xs btn-default" title="Lihat Passing Grade"><i class="mdi mdi-edit"></i></a>
                        {{-- <a href="{{ route('admin.passgrade.delete.jurusan', ['id' => $universitas->id, 'idJur' => $w->id]) }}" class="btn btn-xs btn-danger delete"><i class="mdi mdi-delete"></i></a> --}}
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
