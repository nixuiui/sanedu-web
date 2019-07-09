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
                <span class="icon mdi mdi-accounts-alt mr-3"></span> Passing Grade {{ $universitas->nama }}
            </div>
        </div>
    </div>
</div>
@if(isset($jurusan))
<form class="panel panel-default panel-table table-responsive no-border mb-0 p-5" action="{{ route('admin.passgrade.save.jurusan',  ['id' => $universitas->id, 'idJur' => $jurusan->id]) }}" method="post" enctype="multipart/form-data">
@else
<form class="panel panel-default panel-table table-responsive no-border mb-0 p-5" action="{{ route('admin.passgrade.save.jurusan',  ['id' => $universitas->id]) }}" method="post" enctype="multipart/form-data">
@endif
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6 col-md-offset-2">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Nama Jurusan*</label>
                    <input type="text" class="form-control input-md" placeholder="Ilmu Komputer" name="jurusan"  value="{{ isset($jurusan) ? $jurusan->jurusan : old('jurusan') }}">
                    @if($errors->has('jurusan'))
                    <span class="help-block">
                        <strong>{{ $errors->first('jurusan') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kuota*</label>
                            <input type="number" class="form-control input-md" placeholder="1000" name="kuota"  value="{{ isset($jurusan) ? $jurusan->kuota : old('kuota') }}">
                            @if($errors->has('kuota'))
                            <span class="help-block">
                                <strong>{{ $errors->first('kuota') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Peminat*</label>
                            <input type="number" class="form-control input-md" placeholder="1000" name="peminat"  value="{{ isset($jurusan) ? $jurusan->peminat : old('peminat') }}">
                            @if($errors->has('peminat'))
                            <span class="help-block">
                                <strong>{{ $errors->first('peminat') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Passing Grade*</label>
                            <input type="text" class="form-control input-md" placeholder="35.5" name="passing_grade"  value="{{ isset($jurusan) ? $jurusan->passing_grade : old('passing_grade') }}">
                            @if($errors->has('passing_grade'))
                            <span class="help-block">
                                <strong>{{ $errors->first('passing_grade') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Akreditasi*</label>
                            <input type="text" class="form-control input-md" placeholder="A" name="akreditasi"  value="{{ isset($jurusan) ? $jurusan->passing_grade : old('passing_grade') }}">
                            @if($errors->has('akreditasi'))
                            <span class="help-block">
                                <strong>{{ $errors->first('akreditasi') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group text-left">
                            <label>Soshum</label> <br>
                            <div class="be-checkbox be-checkbox-color inline">
                                <input id="soshum" name="soshum" type="checkbox" value="1" {{ isset($jurusan) && $jurusan->soshum == 1 ? "checked" : "" }}>
                                <label for="soshum"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group text-left">
                            <label>Saintek</label> <br>
                            <div class="be-checkbox be-checkbox-color inline">
                                <input id="saintek" name="saintek" type="checkbox" value="1" {{ isset($jurusan) && $jurusan->saintek == 1 ? "checked" : "" }}>
                                <label for="saintek"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit"  class="btn btn-primary btn-fill btn-lg">Simpan</button>
            </div>
        </div>
    </div>
</form>
@endsection
