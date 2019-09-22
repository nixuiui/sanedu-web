@extends('layouts.admin')

@section('title')
Ujian Selesai
@endsection

@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default panel-big">
            <div class="panel-heading text-center">
                <h2>NILAI SEMENTARA</h2>
            </div>
            <div class="panel-body text-center">
                <div class="text-nilai-announcement mb-5">
                    {{ round($attempt->nilai, 2) }}
                </div>
                <p>Nilai sementara kamu adalah hasil pengerjaan sebelum dilakukan analisis IRT, maka setelah dianalisis IRT akan ada penyusutan bobot nilai. Silahkan cek nilai akhir kamu pada tanggal {{ $simulasi->tanggal_pengumuman != null ? hariTanggal($simulasi->tanggal_pengumuman) : "-" }}</p>
                <p>Soal yang berhasil Anda jawab dengan benar {{ $attempt->jumlah_benar."/".$attempt->ujian->jumlah_soal}}</p>
            </div>
        </div>
        <div class="card-info text-center">
            Lihat <a href="{{ route('member.simulasi.history', ['id' => $simulasi->id, 'idAttempt' => $attempt->id]) }}">hasil pengerjaan</a> atau kembali ke <a href="{{ route('member.simulasi.open', $simulasi->id) }}">halaman Simulasi</a>
        </div>
    </div>
</div>
@endsection
