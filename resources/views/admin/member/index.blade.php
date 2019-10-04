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

<div class="panel panel-default no-border mb-0">
    <div class="panel-body">
        <a href="{{route('admin.member.export')}}" class="btn btn-sm btn-primary pl-3 pr-3"><i class="mdi mdi-download mr-3"></i>Export Data</a>
    </div>
</div>
@endsection

@section('script')
@endsection
