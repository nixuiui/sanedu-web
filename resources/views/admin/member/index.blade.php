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

<div class="panel panel-default no-border mb-0 no-radius">
    <div class="panel-body">
        <a href="{{route('admin.member.export')}}" class="btn btn-sm btn-primary pl-3 pr-3 mb-3">
            <i class="mdi mdi-download mr-3"></i>Export Data
        </a>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default panel-table">
                    <div class="panel-heading">
                        <div class="title">Data Member per Tahun</div>
                    </div>
                    <div class="panel-body table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="width:37%;">Tahun</th>
                                    <th style="width:36%;">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($userByYear as $item)    
                                <tr>
                                    <td style="width:37%;">{{ $item->year }}</td>
                                    <td style="width:36%;">{{ $item->jumlah }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection