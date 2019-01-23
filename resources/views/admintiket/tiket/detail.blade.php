@extends('layouts.admin')
@section('title')
Tiket Member
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default panel-table">
            <div class="panel-body">
                <table id="datatables" class="table table-striped">
                    <thead>
                        <tr>
                            <th>PIN</th>
                            <th>KAP</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Sekolah</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>PIN</th>
                            <th>KAP</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Sekolah</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($tiket as $data)
                        <tr>
                            <td>{{ $data->pin }}</td>
                            <td>{{ $data->kap }}</td>
                            <td>{{ $data->user != null ? $data->user->nama : "-" }}</td>
                            <td>{{ $data->user != null ? $data->user->username : "-" }}</td>
                            <td>{{ $data->user != null ? ($data->user->sekolah != null ? $data->user->sekolah->nama : "-") : "-" }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col-md-12 -->
</div> <!-- end row -->
@endsection