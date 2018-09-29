@extends('layouts.admin')

@section('title')
Soal Ujian
@endsection

@section('content')
<a href="{{ route('adminsimulasi.simulasi.kelola', $simulasi->id) }}" class="btn btn-md btn-default btn-space"><i class="mdi mdi-arrow-left"></i> Kembali</a>
<div class="row">
    <div class="col-md-6">
        @if(isset($ruang))
        <form class="panel panel-default" action="{{ route('adminsimulasi.simulasi.kelola.ruang.post', ['id' => $simulasi->id, 'idRuang' => $ruang->id]) }}" method="post">
        @else
        <form class="panel panel-default" action="{{ route('adminsimulasi.simulasi.kelola.ruang.post', $simulasi->id) }}" method="post">
        @endif
            <div class="panel-heading">
                Form Ruangan
            </div>
            <div class="panel-body">
                @csrf
                <div class="form-group">
                    <label><strong>Nama Ruangan</strong></label>
                    <input type="text" name="nama_ruang" class="form-control input-sm" value="{{ isset($ruang) ? $ruang->nama_ruang : old('nama_ruang') }}" required>
                    @if($errors->has('nama_ruang'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nama_ruang') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label><strong>Kapasitas</strong></label>
                    <input type="number" name="kapasitas" class="form-control input-sm" value="{{ isset($ruang) ? $ruang->kapasitas : old('kapasitas') }}" required>
                    @if($errors->has('kapasitas'))
                    <span class="help-block">
                        <strong>{{ $errors->first('kapasitas') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label><strong>Alamat Ruang</strong></label>
                    <input type="text" name="alamat" class="form-control input-sm" value="{{ isset($ruang) ? $ruang->alamat : old('alamat') }}" required>
                    @if($errors->has('alamat'))
                    <span class="help-block">
                        <strong>{{ $errors->first('alamat') }}</strong>
                    </span>
                    @endif
                </div>
                <button type="submit"  class="btn btn-default btn-fill btn-md btn-space" name="simpan" value="simpan">Simpan</button>
                <button type="submit"  class="btn btn-primary btn-fill btn-md btn-space" name="simpan" value="simpanandnext">Simpan dan Buat agenda baru</button>
            </div>
        </form>
    </div>
</div> <!-- end row -->
@endsection

@section('script')
@endsection
