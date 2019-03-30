@extends('layouts.adminnopadding')

@section('title')
Kelola Ujian
@endsection

@section('description')
{{ $ujian->judul }}
@endsection

@section('navigation')
    @include('adminujian.ujian.menu', ['jumlahSoal' => $ujian->soal->count(), 'jumlahPeserta' => $ujian->diBeliOleh->count(), 'jumlahRiwayat' => $ujian->attempt->count()])
@endsection

@section('content')
<div class="email-inbox-header">
    <div class="row">
        <div class="col-md-12">
            <div class="email-title">
                <span class="icon mdi mdi-grain mr-3"></span> Peraturan Ujian
            </div>
        </div>
    </div>
</div>

<form class="panel panel-default no-border no-radius" action="{{ route('admin.ujian.save.peraturan', $ujian->id) }}" method="post">
    <div class="panel-body">
        @csrf
        <div class="form-group">
            <label><strong>PERATURAN</strong></label>
            <textarea name="peraturan" class="form-control input-sm" rows="8" cols="80" required>
                {!! $ujian->peraturan !!}
            </textarea>
            @if($errors->has('peraturan'))
            <span class="help-block">
                <strong>{{ $errors->first('peraturan') }}</strong>
            </span>
            @endif
        </div>
        <button type="submit"  class="btn btn-primary btn-fill btn-lg">Simpan</button>
    </div>
</form>

@endsection

@section('style')
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
@endsection

@section('script')
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('textarea').summernote({
        height: 500
      });
});
</script>
@endsection