@extends('layouts.admin')

@section('title')
Pengerjaan Soal Selesai
@endsection

@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default panel-big">
            <div class="panel-heading text-center">
                <h2>
                    SELAMAT ANDA TELAH MENYELESAIKAN UJIAN <br><br>
                    <strong>NILAI ANDA</strong>
                </h2>
            </div>
            <div class="panel-body text-center">
                <div class="text-nilai-announcement mb-5">
                    {{ $attempt->jumlah_benar }}
                </div>
                <p>Nilai tertinggi adalah 100</p>
            </div>
        </div>
        <div class="card-info text-center">
            Kembali ke <a href="{{ route('member.ujian.soal.preattempt', $attempt->id_ujian) }}">halaman Ujian</a>
        </div>
    </div>
</div>
@endsection
