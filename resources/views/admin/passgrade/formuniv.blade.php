@extends('layouts.adminnopadding')

@section('title')
Passing Grade
@endsection

@section('navigation')
@include('admin.passgrade.menu')
@endsection

@section('content')
<div class="email-inbox-header">
    <div class="row">
        <div class="col-md-12">
            <div class="email-title">
                <span class="icon mdi mdi-accounts-alt mr-3"></span> Passing Grade
            </div>
        </div>
    </div>
</div>
@if(isset($universitas))
<form class="panel panel-default no-border mb-0" action="{{ route('admin.passgrade.save.univ', $universitas) }}" method="post" enctype="multipart/form-data">
@else
<form class="panel panel-default no-border mb-0" action="{{ route('admin.passgrade.save.univ') }}" method="post" enctype="multipart/form-data">
@endif
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6 col-md-offset-2">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Nama Universitas*</label>
                    <input type="text" class="form-control input-md" placeholder="Nama Universitas" name="nama"  value="{{ isset($universitas) ? $universitas->nama : old('nama') }}" required>
                    @if($errors->has('nama'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nama') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Akreditasi Universitas*</label>
                    <input type="text" class="form-control input-md" placeholder="Akreditasi Universitas" name="akreditasi"  value="{{ isset($universitas) ? $universitas->akreditasi : old('akreditasi') }}" required>
                    @if($errors->has('akreditasi'))
                    <span class="help-block">
                        <strong>{{ $errors->first('akreditasi') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Harga*</label>
                    <input type="number" class="form-control input-md" placeholder="Harga" name="harga"  value="{{ isset($universitas) ? $universitas->harga : old('harga') }}" required>
                    @if($errors->has('harga'))
                    <span class="help-block">
                        <strong>{{ $errors->first('harga') }}</strong>
                    </span>
                    @endif
                </div>
                @if(!isset($universitas))
                <div class="form-group">
                    <label>Upload File Passing Grade (Optional)</label> <br>
                    <label for=""><a href="{{route('admin.passgrade.download.format')}}">Download Format</a></label><br>
                    <input class="inputfile" id="file" type="file" name="file" value="{{ old('file') }}">
                    <label class="btn-secondary" for="file"> <i class="mdi mdi-upload"></i><span>Pilih File</span></label>
                    @if($errors->has('file'))
                    <span class="help-block">
                        <strong>{{ $errors->first('file') }}</strong>
                    </span>
                    @endif
                </div>
                @endif
                <button type="submit"  class="btn btn-primary btn-fill btn-lg btn-hspace btn-fill">Simpan</button>
            </div>
        </div>
    </div>
</form>

@endsection
