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
                <span class="icon mdi mdi-accounts-alt mr-3"></span> Member Sanedu di Setiap Provinsi
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default panel-table no-border mb-0">
    <div class="panel-body">
        <table class="table table-borderless table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Provinsi</th>
                    <th>Jumlah Member</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Provinsi</th>
                    <th>Jumlah Member</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach($provinsi as $i => $data)
                <tr class="clickable-row" data-href='{{ route('admin.member.provinsi', ['id' => $data->id]) }}'>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $data->name }}</td>
                    <td class="milestone">
                        <span class="version">{{ $data->user->count() }}</span>
                        <div class="progress">
                            <div style="width: {{ $data->user->count() > 0 ? (($data->user->count()/$jumlahMember->jumlah)*100) . "%" : "0%"  }}" class="progress-bar progress-bar-primary"></div>
                        </div>
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
