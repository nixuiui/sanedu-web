@extends('layouts.admin')

@section('title')
Ruang Simulasi
@endsection

@section('content')
<a href="{{ route('adminsimulasi.simulasi.kelola', $simulasi->id) }}" class="btn btn-md btn-default btn-space"><i class="mdi mdi-arrow-left"></i> Kembali</a>
<div class="row">
    <div class="col-md-6">
        @if(isset($ruang))
        <form class="panel panel-default form-horizontal" action="{{ route('adminsimulasi.simulasi.kelola.ruang.post', ['id' => $simulasi->id, 'idRuang' => $ruang->id]) }}" method="post">
        @else
        <form class="panel panel-default form-horizontal" action="{{ route('adminsimulasi.simulasi.kelola.ruang.post', $simulasi->id) }}" method="post">
        @endif
            <div class="panel-heading">
                Form Ruangan
            </div>
            <div class="panel-body">
                @csrf
                @if(!isset($ruang))
                <div class="form-group">
                    <label class="control-label col-sm-2">Jenis Ruangan</label>
                    <div class="col-sm-10">
                        <select class="form-control input-sm col-md-9" width="100px" name="id_mapel">
                            @foreach($mapel as $d)
                            <option value="{{ $d->id }}">{{ $d->nama }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('id_mapel'))
                        <span class="help-block">
                            {{ $errors->first('id_mapel') }}
                        </span>
                        @endif
                    </div>
                </div>
                @else
                <div class="form-group">
                    <label class="text-right col-sm-2">Jenis Ruangan</label>
                    <div class="col-sm-10 text-bold text-muted">
                        {{ $ruang->ruangMapel->nama }}
                    </div>
                </div>
                @endif
                <div class="form-group">
                    <label class="control-label col-sm-2">Nama Ruangan</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama" class="form-control input-sm" value="{{ isset($ruang) ? $ruang->nama : old('nama') }}" placeholder="Nama Tempat" required>
                        @if($errors->has('nama'))
                        <span class="help-block">
                            {{ $errors->first('nama') }}
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">Kapasitas</label>
                    <div class="col-sm-10">
                        <input type="number" name="kapasitas" class="form-control input-sm" value="{{ isset($ruang) ? $ruang->kapasitas : old('kapasitas') }}" placeholder="0" required>
                        @if($errors->has('kapasitas'))
                        <span class="help-block">
                            {{ $errors->first('kapasitas') }}
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">Alamat Ruang</label>
                    <div class="col-sm-10">
                        <input type="text" name="alamat" class="form-control input-sm" value="{{ isset($ruang) ? $ruang->alamat : old('alamat') }}" placeholder="Jl. ..." required>
                        @if($errors->has('alamat'))
                        <span class="help-block">
                            {{ $errors->first('alamat') }}
                        </span>
                        @endif
                    </div>
                </div>
                <div class="row xs-mt-10">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit"  class="btn btn-primary btn-fill btn-md btn-hspace" name="simpan" value="simpan">{{ isset($ruang) ? "Simpan Perubahan" : "Simpan" }}</button>
                        @if(!isset($ruang))
                        <button type="submit"  class="btn btn-default btn-fill btn-md btn-hspace" name="simpan" value="simpanandnext">Simpan dan Buat agenda baru</button>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>
</div> <!-- end row -->
@endsection

@section('script')
@endsection
