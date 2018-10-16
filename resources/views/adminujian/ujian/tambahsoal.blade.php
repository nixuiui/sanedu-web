@extends('layouts.admin')

@section('title')
Soal Ujian
@endsection
@section('style')
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
@endsection
@section('script')
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('textarea').summernote({
        height: 200
      });
});
</script>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="alert alert-primary alert-icon alert-icon-border alert-dismissible" role="alert">
            <div class="icon"><span class="mdi mdi-mail-send"></span></div>
            <div class="message">
                <strong>Soal No {{ $ujian->soal->count() + 1 }}</strong>
            </div>
        </div>
        @if(isset($soal))
        <form class="panel panel-default" action="{{ route('admin.ujian.soal.form.soal.post', ['id' => $ujian->id, 'idSoal' => $soal->id]) }}" method="post">
        @else
        <form class="panel panel-default" action="{{ route('admin.ujian.soal.form.soal.post', $ujian->id) }}" method="post">
        @endif
            <div class="panel-body">
            <button type="submit"  class="btn btn-default btn-fill btn-md btn-space" name="simpan" value="simpan">Simpan</button>
            <button type="submit"  class="btn btn-primary btn-fill btn-md btn-space" name="simpan" value="simpanandnext">Simpan dan Lanjut Soal Nomor {{ $ujian->soal->count() + 2 }}</button>
                @csrf
                <div class="form-group">
                    <label><strong>SOAL</strong></label>
                    <textarea name="soal" class="form-control input-sm" rows="8" cols="80" required>
                        {!! isset($soal) ? $soal->soal : old('soal') !!}
                    </textarea>
                    @if($errors->has('soal'))
                    <span class="help-block">
                        <strong>{{ $errors->first('soal') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label><strong>JAWABAN A</strong></label>
                    <textarea name="a" class="form-control input-sm" rows="4" cols="80">
                        {!! isset($soal) ? $soal->a : old('a') !!}
                    </textarea>
                    @if($errors->has('a'))
                    <span class="help-block">
                        <strong>{{ $errors->first('a') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label><strong>JAWABAN B</strong></label>
                    <textarea name="b" class="form-control input-sm" rows="4" cols="80">
                        {!! isset($soal) ? $soal->b : old('b') !!}
                    </textarea>
                    @if($errors->has('b'))
                    <span class="help-block">
                        <strong>{{ $errors->first('b') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label><strong>JAWABAN C</strong></label>
                    <textarea name="c" class="form-control input-sm" rows="4" cols="80">
                        {!! isset($soal) ? $soal->c : old('c') !!}
                    </textarea>
                    @if($errors->has('c'))
                    <span class="help-block">
                        <strong>{{ $errors->first('c') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label><strong>JAWABAN D</strong></label>
                    <textarea name="d" class="form-control input-sm" rows="4" cols="80">
                        {!! isset($soal) ? $soal->d : old('d') !!}
                    </textarea>
                    @if($errors->has('d'))
                    <span class="help-block">
                        <strong>{{ $errors->first('d') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label><strong>JAWABAN E</strong></label>
                    <textarea name="e" class="form-control input-sm" rows="4" cols="80">
                        {!! isset($soal) ? $soal->e : old('e') !!}
                    </textarea>
                    @if($errors->has('e'))
                    <span class="help-block">
                        <strong>{{ $errors->first('e') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label><strong>KUNCI JAWABAN</strong></label>
                    <select class="form-control input-sm" name="jawaban" required>
                        <option value="a">Pilih Jawaban</option>
                        <option value="a" {{ isset($soal) && $soal->jawaban == 'a' ? "selected" : "" }}>A</option>
                        <option value="b" {{ isset($soal) && $soal->jawaban == 'b' ? "selected" : "" }}>B</option>
                        <option value="c" {{ isset($soal) && $soal->jawaban == 'c' ? "selected" : "" }}>C</option>
                        <option value="d" {{ isset($soal) && $soal->jawaban == 'd' ? "selected" : "" }}>D</option>
                        <option value="e" {{ isset($soal) && $soal->jawaban == 'e' ? "selected" : "" }}>E</option>
                    </select>
                    @if($errors->has('e'))
                    <span class="help-block">
                        <strong>{{ $errors->first('e') }}</strong>
                    </span>
                    @endif
                </div>
                <button type="submit"  class="btn btn-default btn-fill btn-md" name="simpan" value="simpan">Simpan</button>
                <button type="submit"  class="btn btn-primary btn-fill btn-md" name="simpan" value="simpanandnext">Simpan dan Lanjut Soal Nomor {{ $ujian->soal->count() + 2 }}</button>
            </div>
        </form>
    </div>
</div> <!-- end row -->
@endsection

@section('script')
@endsection
