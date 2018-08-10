@extends('layouts.admin')
@section('title')
Data Member
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="btn-group btn-hspace btn-space">
            <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle btn-icon" aria-expanded="false">
                <i class="icon icon-left mdi mdi-globe"></i> Download Data Member
                <span class="icon-dropdown mdi mdi-chevron-down"></span>
            </button>
            <ul role="menu" class="dropdown-menu">
                <li><a href="{{ route('admintiket.tiket.member.download', ['file' => 'pdf']) }}">PDF</a></li>
                <li><a href="{{ route('admintiket.tiket.member.download', ['file' => 'excel']) }}">Excel</a></li>
            </ul>
        </div>
        <div class="panel panel-default panel-table">
            <div class="panel-body">
                <table id="datatables" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>PIN</th>
                            <th>KAP</th>
                            <th>Nama</th>
                            <th>Asal Sekolah</th>
                            <th>No. Telp</th>
                            <th>Total Point</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>PIN</th>
                            <th>KAP</th>
                            <th>Nama</th>
                            <th>Asal Sekolah</th>
                            <th>No. Telp</th>
                            <th>Total Point</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($tiket as $no => $val)
                        <tr>
                            <td>{{ $no+1 }}</td>
                            <td>{{ $val->pin }}</td>
                            <td>{{ $val->kap }}</td>
                            <td>{{ $val->user->nama }}</td>
                            <td>{{ $val->user->asal_sekolah }}</td>
                            <td>{{ $val->user->no_hp }}</td>
                            <td></td>
                            <td>
                                <!-- <a href="#" class="btn btn-xs btn-danger delete" title="Hapus"> <i class="mdi mdi-delete"></i> </a> -->
                                <a href="{{ route('admintiket.tiket.member.data.edit', $val->user->id) }}" class="btn btn-xs btn-success" title="Edit Data Member"> <i class="mdi mdi-edit"></i> </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col-md-12 -->
</div> <!-- end row -->
@endsection
