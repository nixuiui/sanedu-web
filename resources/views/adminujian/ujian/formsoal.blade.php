@extends('layouts.admin')

@section('title')
Soal {{ $ujian->judul }}
@endsection

@section('style')
@endsection

@section('script')<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace( 'soal' );
    CKEDITOR.replace( 'a' );
    CKEDITOR.replace( 'b' );
    CKEDITOR.replace( 'c' );
    CKEDITOR.replace( 'd' );
    CKEDITOR.replace( 'e' );
</script>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="alert alert-primary alert-icon alert-icon-border alert-dismissible" role="alert">
            <div class="icon"><span class="mdi mdi-mail-send"></span></div>
            <div class="message">
                <strong>Soal {{ $ujian->judul }} {{ $group ? " - " . $group->nama : "" }}</strong>
            </div>
        </div>
        @if(isset($soal))
        <form class="panel panel-default" action="{{ route('admin.ujian.soal.form.soal.post', ['id' => $ujian->id, 'idSoal' => $soal->id]) }}" method="post">
        @else
        <form class="panel panel-default" action="{{ route('admin.ujian.soal.form.soal.post', $ujian->id) }}" method="post">
        @endif
            <div class="panel-body">
                <button type="submit"  class="btn btn-primary btn-fill btn-md btn-space" name="simpan" value="simpan">Simpan</button>
                <button type="submit"  class="btn btn-default btn-fill btn-md btn-space" name="simpan" value="simpanandnext">Simpan dan Lanjut Buat Soal</button>
                @csrf
                <input type="hidden" name="id_group" value="{{ $group ? $group->id : "" }}">
                <div class="form-group">
                    <label><strong>SOAL</strong></label>
                    <textarea name="soal" class="form-control input-sm" rows="8" cols="80" required autofocus>
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
                <button type="submit"  class="btn btn-primary btn-fill btn-md btn-space" name="simpan" value="simpan">Simpan</button>
                <button type="submit"  class="btn btn-default btn-fill btn-md btn-space" name="simpan" value="simpanandnext">Simpan dan Lanjut Buat Soal</button>
            </div>
        </form>
    </div>
</div> <!-- end row -->
@endsection

@section('script')
@endsection
