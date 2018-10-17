@extends('layouts.admin')

@section('title')
Passing Grade
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        @if(isset($universitas))
        <form class="panel panel-default" action="{{ route('admin.passgrade.save.univ', $universitas) }}" method="post" enctype="multipart/form-data">
        @else
        <form class="panel panel-default" action="{{ route('admin.passgrade.save.univ') }}" method="post" enctype="multipart/form-data">
        @endif
            <div class="panel-heading">Form Universitas</div>
            <div class="panel-body">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Nama Universitas*</label>
                    <input type="text" class="form-control input-sm" placeholder="Nama Universitas" name="nama"  value="{{ isset($universitas) ? $universitas->nama : old('nama') }}">
                    @if($errors->has('nama'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nama') }}</strong>
                    </span>
                    @endif
                </div>
                @if(!isset($universitas))
                <div class="form-group">
                    <label>Upload File Passing Grade (Optional)</label> <br>
                    <label><i class="text-muted">(Kolom: jurusan, kuota, peminat, passing_grade, akreditasi, soshum, saintek)</i></label> <br>
                    <input class="inputfile" id="file" type="file" name="file" value="{{ old('file') }}">
                    <label class="btn-secondary" for="file"> <i class="mdi mdi-upload"></i><span>Pilih File</span></label>
                    @if($errors->has('file'))
                    <span class="help-block">
                        <strong>{{ $errors->first('file') }}</strong>
                    </span>
                    @endif
                </div>
                @endif
                <button type="submit"  class="btn btn-primary btn-fill btn-md">Simpan</button>
            </div>
        </form>
    </div>
</div> <!-- end row -->
@endsection
