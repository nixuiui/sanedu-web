@extends('layouts.admin')

@section('title')
Ujian Selesai
@endsection

@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default panel-big">
            <div class="panel-heading text-center">
                <h2>NILAI ANDA</h2>
            </div>
            <div class="panel-body text-center">
                <div class="text-nilai-announcement">
                    {{ round(($attempt->jumlah_benar / $attempt->ujian->soal->count())*100, 2) }}
                </div>
            </div>
        </div>
        <div class="card-info text-center">
            Kembali ke <a href="{{ route('member.ujian.soal.preattempt', $attempt->id_ujian) }}">halaman Ujian</a>
        </div>
    </div>
</div>
@endsection
