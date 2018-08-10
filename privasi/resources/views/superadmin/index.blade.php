@extends('layouts.admin')

@section('title')
Beranda
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div role="alert" class="alert alert-primary alert-icon alert-dismissible">
            <div class="icon"><span class="mdi mdi-info-outline"></span></div>
            <div class="message">
                Hi <strong>{{ Auth::user()->nama }}</strong>, Selamat Datang di Halaman Administrator
            </div>
        </div>
    </div> <!-- end col-md-12 -->

</div> <!-- end row -->
@endsection
