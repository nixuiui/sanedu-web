@extends('layouts.admin')

@section('title')
Edit Grup Chat
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <form class="panel panel-default" action="{{ route('admin.grupchat.tambah.post') }}" method="post">
            <div class="panel-heading"><i class="mdi mdi-comments"></i> Tambah Grup Chat</div>
            <div class="panel-body">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Kategori Grup Chat</label>
                    <select class="form-control input-sm" name="kategori">
                        @foreach($grupKategori as $grup)
                        <option value="{{ $grup->id }}" {{ old('kategori') == $grup->id ? "selected" : "" }}>{{ $grup->nama }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('kategori'))
                    <span class="help-block">
                        <strong>{{ $errors->first('kategori') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Nama Grup</label>
                    <input type="text" class="form-control input-sm" placeholder="Nama Grup" name="nama"  value="{{ old('nama') }}">
                    @if($errors->has('nama'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nama') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Link Grup</label>
                    <input type="text" class="form-control input-sm" placeholder="http:// Grup" name="link"  value="{{ old('link') }}">
                    @if($errors->has('link'))
                    <span class="help-block">
                        <strong>{{ $errors->first('link') }}</strong>
                    </span>
                    @endif
                </div>
                <button type="submit"  class="btn btn-primary btn-fill btn-md">Simpan</button>
            </div>
        </form>
    </div>
</div> <!-- end row -->
@endsection
