@extends('layouts.admin')
@section('title')
Scan Jawaban Peserta - {{ $simulasi->judul }}
@endsection
@section('content')
<div class="row">
    <div class="col-md-6">
        <a href="{{ route('adminsimulasi.simulasi.kelola', $simulasi->id) }}" class="btn btn-md btn-default btn-space"><i class="mdi mdi-arrow-left mr-3"></i> Kembali</a>
        <div class="panel panel-default">
            <div class="panel-heading">
                Upload Hasil Scan
            </div>
            <form class="panel-body" action="{{ route('adminsimulasi.simulasi.kelola.scan.post', $simulasi->id) }}" method="post"  enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Jenis Ujian</label>
                            <select class="form-control input-xs" name="id_mapel">
                                <option value="">Pilih Ujian</option>
                                @foreach($simulasiUjian as $val)
                                <option value="{{ $val->mapel->id }}">{{ $val->mapel->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label for="">Upload file (.xlsx)</label> <br>
                            <input class="inputfile" id="fileUpload" type="file" name="fileUpload" data-multiple-caption="{count} files selected" multiple="" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel,text/comma-separated-values, text/csv, application/csv">
                            <label class="btn-secondary" for="fileUpload"> <i class="mdi mdi-upload"></i><span>Pilih File...</span></label>
                        </div>
                    </div>
                </div>
                <button type="submit" id="btnProcess" class="btn btn-primary btn-fill btn-md btn-icon">Proses Sekarang</button>
            </form>
        </div>
    </div>
</div>
@endsection