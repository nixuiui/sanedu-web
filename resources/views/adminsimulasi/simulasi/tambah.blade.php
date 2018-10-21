@extends('layouts.admin')

@section('title')
Buat Simulasi Baru
@endsection

@section('content')
<div class="row">
    <div class="col-md-9">
        <form class="panel panel-default" action="{{ route('adminsimulasi.simulasi.tambah.post') }}" method="post">
            <div class="panel-heading">Form Buat Simulasi Baru</div>
            <div class="panel-body">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tingkat Sekolah</label>
                            <select class="form-control input-sm" id="inputSekolah" name="id_sekolah">
                                <option value="">Pilih Sekolah</option>
                                @foreach($sekolah as $val)
                                <option value="{{ $val->id }}">{{ $val->nama }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('id_sekolah'))
                            <span class="help-block">
                                <strong>{{ $errors->first('id_sekolah') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Judul Simulasi</label>
                            <input type="text" class="form-control input-sm" placeholder="Simulasi SBMPTN" name="judul"  value="{{ old('judul') }}" required>
                            @if($errors->has('judul'))
                            <span class="help-block">
                                <strong>{{ $errors->first('judul') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Instansi Pelaksana</label>
                            <input type="text" class="form-control input-sm" placeholder="Study & Fun" name="instansi"  value="{{ old('instansi') }}" required>
                            @if($errors->has('instansi'))
                            <span class="help-block">
                                <strong>{{ $errors->first('instansi') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Harga (Rp)</label>
                            <input type="number" class="form-control input-sm" placeholder="1000" name="harga"  value="{{ 0 | old('harga') }}" required>
                            @if($errors->has('harga'))
                            <span class="help-block">
                                <strong>{{ $errors->first('harga') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tanggal Pelaksanaan</label>
                            <input type="date" class="form-control input-sm" name="tanggal_pelaksanaan"  value="{{ old('tanggal_pelaksanaan') }}" required>
                            @if($errors->has('tanggal_pelaksanaan'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tanggal_pelaksanaan') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tempat Pelaksanaan</label>
                            <input type="text" class="form-control input-sm" placeholder="Nama Tempat" name="tempat_pelaksanaan"  value="{{ old('tempat_pelaksanaan') }}" required>
                            @if($errors->has('tempat_pelaksanaan'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tempat_pelaksanaan') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tanggal Pengumuman</label>
                            <input type="date" class="form-control input-sm" name="tanggal_pengumuman"  value="{{ old('tanggal_pengumuman') }}" required>
                            @if($errors->has('tanggal_pengumuman'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tanggal_pengumuman') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <p>Pilih cogambar untuk dijadikan cover</p>
                            <input type="hidden" name="featured_image">
                            <input class="inputfile" id="file-1" type="file" name="file-1" data-multiple-caption="{count} files selected" multiple="" accept="image/*">
                            <label class="btn-secondary" for="file-1"> <i class="mdi mdi-upload"></i><span>Pilih Foto...</span></label>
                            @if($errors->has('kategori'))
                            <span class="help-block">
                                <strong>{{ $errors->first('kategori') }}</strong>
                            </span>
                            @endif
                        </div>
                        <img id="imagePreview" class="img-fluid" width="300px">
                    </div>
                </div>
                <hr>
                <button type="submit"  class="btn btn-primary btn-fill btn-md">Simpan Simulasi</button>
            </div>
        </form>
    </div>
</div> <!-- end row -->
@endsection

@section('script')
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("input[type=file]").click(function(){
        $(this).val("");
    });

    $("input[type=file]").change(function(){
        var file = $(this)[0].files[0];
        var reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function () {
            $("#imagePreview").attr("src", reader.result);
            $("input[name=featured_image]").val(reader.result);
        };
        reader.onerror = function (error) {
            console.log('Error: ', error);
        };
    });
});
</script>
@endsection
