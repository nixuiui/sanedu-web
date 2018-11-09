@extends('layouts.admin')
@section('title')
Proses Perhitungan Nilai Akhir
@endsection
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="">
            <strong>Peserta Saintek (@{{ jumlahSaintek }})</strong>
        </div>
    </div>
    <div class="col-md-6">
        <div class="">
            <strong>Peserta Soshum ({{$soshum->count()}})</strong>
        </div>
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    var app = new Vue({
        el: "#app",
        data: {
            message: "Hello",
            pesertaSaintek: {!! $saintek !!},
            jumlahSaintek: {{ $saintek->count() }}
        }
    });
</script>
@endsection
