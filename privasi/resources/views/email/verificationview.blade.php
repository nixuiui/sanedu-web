@extends('layouts.admin')

@section('title')
Verifikasi Email
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div role="alert" class="alert alert-warning alert-icon alert-dismissible">
            <div class="icon"><span class="mdi mdi-info-outline"></span></div>
            <div class="message">
                {!! $success !!}
            </div>
        </div>
    </div> <!-- end col-md-12 -->

</div> <!-- end row -->
@endsection
