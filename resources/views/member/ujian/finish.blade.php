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
                    {{ round($attempt->nilai, 2) }}
                </div>
                <p>Soal yang berhasil Anda jawab dengan benar {{ $attempt->jumlah_benar."/".$attempt->ujian->jumlah_soal}}</p>
            </div>
        </div>
        <div class="card-info text-center">
        Lihat <a href="{{ route('member.ujian.history', $attempt->id) }}">hasil pengerjaan</a> atau kembali ke <a href="{{ route('member.ujian.soal.preattempt', $attempt->id_ujian) }}">halaman Ujian</a>
        </div>
    </div>
</div>
@endsection
