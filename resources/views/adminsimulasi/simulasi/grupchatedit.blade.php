@extends('layouts.admin')

@section('title')
Edit Grup Chat
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <form class="panel panel-default" action="{{ route('adminsimulasi.simulasi.kelola.grupchat.edit.post', ['id' => $simulasi->id, 'idGrup' => $grup->id]) }}" method="post">
            <div class="panel-heading"><i class="mdi mdi-comments"></i> Grup Chat</div>
            <div class="panel-body">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Nama Grup</label>
                    <input type="text" class="form-control input-sm" placeholder="Nama Grup" name="nama"  value="{{ $grup->nama }}">
                    @if($errors->has('nama'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nama') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Link Grup</label>
                    <input type="text" class="form-control input-sm" placeholder="Link Grup" name="link"  value="{{ $grup->link }}">
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
