@extends('layouts.admin')

@section('title')
Form Informasi
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

    $("input[type=file]").click(function(){
        $(this).val("");
    });

    $("input[type=file]").change(function(){
        var file = $(this)[0].files[0];
        var reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function () {
            $("#imagePreview").attr("src", reader.result);
            $("input[name=foto]").val(reader.result);
        };
        reader.onerror = function (error) {
            console.log('Error: ', error);
        };
    });

    $("button").click(function() {
        $.ajax({
            type: 'post',
            contentType: "application/json",
            dataType: 'json',
            url: "http://localhost/sanedu-storage/upload-image.php",
            data: {
                file: $("input[type=text]").val()
            },
            success: function(data) {
                alert(4);
            },
            error: function() {
            }
        });
    });
});
</script>
@endsection

@section('content')
@if(isset($informasi))
<form class="row" action="{{ route('admin.informasi.save', $informasi->id) }}" method="post">
@else
<form class="row" action="{{ route('admin.informasi.save') }}" method="post">
@endif
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-body">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>JUDUL INFORMASI</label>
                    <input type="text" class="form-control input-sm" placeholder="Judul Informasi" name="judul"  value="{{ isset($informasi) ? $informasi->judul : old('judul') }}" required>
                    @if($errors->has('judul'))
                    <span class="help-block">
                        <strong>{{ $errors->first('judul') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>ISI INFORMASI</label>
                    <textarea name="isi" class="form-control input-sm" rows="8" cols="80" required>
                        {!! isset($informasi) ? $informasi->isi : old('isi') !!}
                    </textarea>
                    @if($errors->has('isi'))
                    <span class="help-block">
                        <strong>{{ $errors->first('isi') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                    <label>KATEGORI INFORMASI</label>
                    <select class="form-control input-sm" name="kategori" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($kategori as $data)
                        @if(isset($informasi))
                        <option value="{{ $data->id }}" {{ $informasi->id_kategori == $data->id ? "selected" : "" }}>{{ $data->nama }}</option>
                        @else
                        <option value="{{ $data->id }}" {{ old('kategori') == $data->id ? "selected" : "" }}>{{ $data->nama }}</option>
                        @endif
                        @endforeach
                    </select>
                    @if($errors->has('kategori'))
                    <span class="help-block">
                        <strong>{{ $errors->first('kategori') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <input type="hidden" name="foto">
                    <input class="inputfile" id="file-1" type="file" name="file-1" data-multiple-caption="{count} files selected" multiple="" accept="image/*">
                    <label class="btn-secondary" for="file-1"> <i class="mdi mdi-upload"></i><span>Pilih Foto...</span></label>
                    @if($errors->has('kategori'))
                    <span class="help-block">
                        <strong>{{ $errors->first('kategori') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    @if(isset($informasi))
                    <img id="imagePreview" class="img-fluid" src="{{ $informasi->foto_url }}">
                    @else
                    <img id="imagePreview" class="img-fluid">
                    @endif
                </div>
                <button type="submit"  class="btn btn-primary btn-fill btn-md btn-icon"><i class="mdi mdi-check"></i>Simpan</button>
            </div>
        </div>
    </div>
</form> <!-- end row -->
@endsection
