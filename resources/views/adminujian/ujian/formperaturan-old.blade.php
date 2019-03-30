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
        height: 500
      });
});
</script>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <form class="panel panel-default" action="{{ route('admin.ujian.save.peraturan', $ujian->id) }}" method="post">
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
                <button type="submit"  class="btn btn-primary btn-fill btn-md">Simpan</button>
            </div>
        </form>
    </div>
</div> <!-- end row -->
@endsection

@section('script')
@endsection
