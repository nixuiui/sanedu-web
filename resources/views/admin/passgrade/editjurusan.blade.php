@extends('layouts.admin')

@section('title')
Passing Grade
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        @if(isset($jurusan))
        <form class="panel panel-default" action="{{ route('admin.passgrade.save.jurusan',  ['id' => $universitas->id, 'idJur' => $jurusan->id]) }}" method="post" enctype="multipart/form-data">
        @else
        <form class="panel panel-default" action="{{ route('admin.passgrade.save.jurusan',  ['id' => $universitas->id]) }}" method="post" enctype="multipart/form-data">
        @endif
            <div class="panel-heading">Ubah Jurusan</div>
            <div class="panel-body">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Nama Jurusan*</label>
                            <input type="text" class="form-control input-sm" placeholder="Ilmu Komputer" name="jurusan"  value="{{ isset($jurusan) ? $jurusan->jurusan : old('jurusan') }}">
                            @if($errors->has('jurusan'))
                            <span class="help-block">
                                <strong>{{ $errors->first('jurusan') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Kuota*</label>
                            <input type="number" class="form-control input-sm" placeholder="1000" name="kuota"  value="{{ isset($jurusan) ? $jurusan->kuota : old('kuota') }}">
                            @if($errors->has('kuota'))
                            <span class="help-block">
                                <strong>{{ $errors->first('kuota') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Peminat*</label>
                            <input type="number" class="form-control input-sm" placeholder="1000" name="peminat"  value="{{ isset($jurusan) ? $jurusan->peminat : old('peminat') }}">
                            @if($errors->has('peminat'))
                            <span class="help-block">
                                <strong>{{ $errors->first('peminat') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Passing Grade*</label>
                            <input type="text" class="form-control input-sm" placeholder="35.5" name="passing_grade"  value="{{ isset($jurusan) ? $jurusan->passing_grade : old('passing_grade') }}">
                            @if($errors->has('passing_grade'))
                            <span class="help-block">
                                <strong>{{ $errors->first('passing_grade') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label>Akreditasi*</label>
                            <input type="text" class="form-control input-sm" placeholder="A" name="akreditasi"  value="{{ isset($jurusan) ? $jurusan->passing_grade : old('passing_grade') }}">
                            @if($errors->has('akreditasi'))
                            <span class="help-block">
                                <strong>{{ $errors->first('akreditasi') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group text-center">
                            <label>Soshum</label> <br>
                            <div class="be-checkbox be-checkbox-color inline">
                                <input id="soshum" name="soshum" type="checkbox" value="1" {{ isset($jurusan) && $jurusan->soshum == 1 ? "checked" : "" }}>
                                <label for="soshum"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group text-center">
                            <label>Saintek</label> <br>
                            <div class="be-checkbox be-checkbox-color inline">
                                <input id="saintek" name="saintek" type="checkbox" value="1" {{ isset($jurusan) && $jurusan->saintek == 1 ? "checked" : "" }}>
                                <label for="saintek"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit"  class="btn btn-primary btn-fill btn-md">Simpan</button>
            </div>
        </form>
    </div>
</div> <!-- end row -->
@endsection
