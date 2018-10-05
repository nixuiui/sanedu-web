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
                    <input type="text" name="nama" class="form-control input-sm" value="{{ isset($ruang) ? $ruang->nama : old('nama') }}" required>
                    @if($errors->has('nama'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nama') }}</strong>
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
                <button type="submit"  class="btn btn-primary btn-fill btn-md btn-hspace" name="simpan" value="simpan">{{ isset($ruang) ? "Simpan Perubahan" : "Simpan" }}</button>
                @if(!isset($ruang))
                <button type="submit"  class="btn btn-default btn-fill btn-md btn-hspace" name="simpan" value="simpanandnext">Simpan dan Buat agenda baru</button>
                @endif
            </div>
        </form>
    </div>
</div> <!-- end row -->
@endsection

@section('script')
@endsection
