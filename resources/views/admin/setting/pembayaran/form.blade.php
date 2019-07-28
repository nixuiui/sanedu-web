@extends('layouts.adminnopadding')

@section('title')
Kelola Ujian
@endsection

@section('description')
@endsection

@section('navigation')
    @include('admin.setting.menu')
@endsection

@section('content')
<div class="email-inbox-header">
    <div class="row">
        <div class="col-md-12">
            <div class="email-title">
                <span class="icon mdi mdi-settings mr-3"></span> Pengaturan Ujian
            </div>
        </div>
    </div>
</div>

@if(isset($metodePembayaran))
<form class="panel panel-default no-border no-radius" action="{{ route('admin.setting.metode.pembayaran.action', $metodePembayaran->id) }}" method="post">
@else
<form class="panel panel-default no-border no-radius" action="{{ route('admin.setting.metode.pembayaran.action') }}" method="post">
@endif
    <div class="panel-body pb-5">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control input-md" placeholder="Bank, Fintech, atau yang lainnya" name="nama"  value="{{ isset($metodePembayaran) ? $metodePembayaran->nama : old('nama') }}" required>
                    @if($errors->has('nama'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nama') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No. Rekening</label>
                            <input type="text" class="form-control input-md" placeholder="123456789" name="nomor_rekening"  value="{{ isset($metodePembayaran) ? $metodePembayaran->nomor_rekening : old('nomor_rekening') }}" required>
                            @if($errors->has('nomor_rekening'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nomor_rekening') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Pemilik Rekening</label>
                            <input type="text" class="form-control input-md" placeholder="nama Pemilik Rekening" name="nama_pemilik"  value="{{ isset($metodePembayaran) ? $metodePembayaran->nama_pemilik : old('nama_pemilik') }}" required>
                            @if($errors->has('nama_pemilik'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nama_pemilik') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <p><label>Logo</label></p>
                    <input type="hidden" name="featured_image">
                    <input class="inputfile" id="file-1" type="file" name="file-1" data-multiple-caption="{count} files selected" multiple="" accept="image/*">
                    <label class="btn-secondary" for="file-1"> <i class="mdi mdi-upload"></i><span>Pilih Logo...</span></label>
                </div>
                <img id="imagePreview" class="img-fluid mb-5" width="300px">
                <div class="form-group">
                    <label>Intruksi</label>
                    <textarea name="intruksi" class="form-control input-sm" rows="8" cols="80" required autofocus>
                            {!! isset($metodePembayaran) ? $metodePembayaran->intruksi : old('intruksi') !!}
                        </textarea>
                    @if($errors->has('instruksi'))
                    <span class="help-block">
                        <strong>{{ $errors->first('instruksi') }}</strong>
                    </span>
                    @endif
                </div>
                <button type="submit"  class="btn btn-primary btn-fill btn-lg btn-icon btn-hspace">Simpan</button>
            </div>
        </div>
    </div>
</form>
@endsection

@section('script')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
    CKEDITOR.replace( 'intruksi' );
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