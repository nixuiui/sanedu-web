@extends('layouts.admin')

@section('title')
Peserta Simulasi - {{ $simulasi->judul }}
@endsection

@section('content')
<a href="{{ route('adminsimulasi.simulasi.kelola', $simulasi->id) }}" class="btn btn-default btn-space btn-icon"><i class="mdi mdi-arrow-back"></i>Kembali</a>
<div class="row">
    <div class="col-md-3">
        <div class="alert alert-warning">
            <p>Isi dengan <strong>(A,B,C,D,E)</strong> atau <strong>Kosongkan</strong></p>
            <p>Gunakan <strong>TAB</strong> untuk pindah nomor soal</p>
            <p>Jika ada kesalahan dalam pengisian silahkan lapor</p>
        </div>
        <form action="{{ route('adminsimulasi.simulasi.kelola.koreksi.post', $simulasi->id) }}" method="post">
            @csrf
            <input type="hidden" name="id_mapel" value="{{ $idMapel }}">
            <div class="mb-3">
                <select class="form-control input-sm select2" name="id_peserta" required>
                    <option value="">-- Pilih Peserta --</option>
                    @foreach($peserta as $data)
                    <option value="{{ $data->id }}">{{ $data->no_peserta }} {{ $data->profil->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="panel panel-default panel-table">
                <div class="panel-body table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="10px">No</th>
                                <th>Jawban</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 0; $i < $jumlahSoal; $i++)
                            <tr>
                                <td>{{$i + 1}}</td>
                                <td>
                                    <input type="hidden" name="jawaban[id_soal][]" class="form-control input-xs" placeholder="A" value="{{ $kunciJawaban[$i]->id }}">
                                    <input type="hidden" name="jawaban[no_soal][]" class="form-control input-xs" placeholder="A" value="{{ $kunciJawaban[$i]->no }}">
                                    <input type="hidden" name="jawaban[kunci][]" class="form-control input-xs" placeholder="A" value="{{ $kunciJawaban[$i]->jawaban }}">
                                    <input type="text" name="jawaban[jawaban][]" class="form-control input-xs" pattern="[a-eA-E]{1}" placeholder="A">
                                </td>
                            </tr>
                            @endfor
                            <tr>
                                <td colspan="2"><button type="submit" class="btn btn-primary btn-md btn-block">KIRIM</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
