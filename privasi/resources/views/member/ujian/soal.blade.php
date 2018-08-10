@extends('layouts.adminaside')

@section('title')
Ujian Matematika
@endsection

@section('content')
<span class="label label-default label-md label-space">SOAL NO: 24</span>
<span class="label label-default label-md pull-right label-icon"><i class="mdi mdi-time-countdown"></i>WAKTU: 00:00:11</span>
<div class="panel panel-default">
    <div class="panel-body">
        asd
    </div>
</div>
@endsection

@section('content-side')
<div class="row">
    <div class="col-md-12 mb-3">
        <a href="#" class="btn btn-success btn-block">SELESAI</a>
    </div>
    <div class="col-md-12 mb-3">
        @for($i=0; $i<=99; $i++)
            @if($i%5 == 0)
            <div class="btn-soal-group">
            @endif
                <a href="#" class="btn btn-sm btn-default btn-soal"><span class="flex"><span>{{ $i+1 }}</span></span></a>
            @if($i%5 == 4)
            </div>
            @endif
        @endfor
    </div>
    <div class="col-md-12">
        <a href="#" class="btn btn-success btn-block">SELESAI</a>
    </div>
</div>
@endsection
