@extends('layouts.adminnopadding')

@section('title')
Kelola Sekolah
@endsection

@section('navigation')
    @include('admin.sekolah.menu')
@endsection

@section('content')
<div class="email-inbox-header">
    <div class="row">
        <div class="col-md-12">
            <div class="email-title">
                <span class="icon mdi mdi-plus mr-3"></span> Tambah Data Sekolah
            </div>
        </div>
    </div>
</div>

<form class="panel panel-default no-border mb-0" action="{{ route('admin.sekolah.tambah.post') }}" method="post">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 mb-5">
                @include('partials.admin.helpers.alert')
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Provinsi</label>
                    <select class="form-control input-sm" id="inputProvinsi" name="id_provinsi" required>
                        <option value="">-- Pilih Provinsi --</option>
                        @foreach($provinsi as $data)
                        <option value="{{ $data->id }}" {{ old('id_provinsi') == $data->id ? "selected" : "" }}>{{ $data->name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('id_provinsi'))
                    <span class="help-block">
                        <strong>{{ $errors->first('id_provinsi') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Kabupaten/Kota</label>
                    <select class="form-control input-sm" id="inputKota" name="id_kota" required>
                    </select>
                    @if($errors->has('id_kota'))
                    <span class="help-block">
                        <strong>{{ $errors->first('id_kota') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Tingkat Sekolah</label>
                    <select class="form-control input-sm" name="id_tingkat_sekolah" required>
                        <option value="">-- Pilih Tingkat Sekolah --</option>
                        <option value="1301">SD</option>
                        <option value="1302">SMP</option>
                        <option value="1303">SMA</option>
                    </select>
                    @if($errors->has('id_tingkat_sekolah'))
                    <span class="help-block">
                        <strong>{{ $errors->first('id_tingkat_sekolah') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Nama Sekolah</label>
                    <input type="text" class="form-control input-sm" placeholder="Nama Sekolah" name="nama[]"  value="{{ old('nama') }}" required>
                </div>
                <button type="submit"  class="btn btn-primary btn-fill btn-md">Simpan</button>
            </div>
        </div>
    </div>
</form>
@endsection


@section('script')
<script type="text/javascript">
$("#inputProvinsi").change(function() {
	var el = $("#inputProvinsi");
	if(el.val() != "null") {
		var url = "{{ route('ajax.lokasi.provinsi', ['idProvinsi' => ':id']) }}";
		url     = url.replace(':id', el.val());
		$.ajax({
			type: 'get',
			url: url,
			data: {
			},
			success: function(data) {
				var json 			= jQuery.parseJSON(data);
				var inputKota 	= $("#inputKota");
				if(json.success) {
					inputKota.html("");
					inputKota.append("<option>Pilih Kabupaten/Kota</option>");
                    if(json.data.kota.length > 0) {
                        $.each(json.data.kota, function(i, val) {
                            inputKota.append("<option value=" + val.id + "> " + val.name + "</option>");
                        });
                    }
    				else {
    					inputKota.html("");
    					inputKota.append("<option>Data Kabupaten/Kota Belum Ada</option>");
    				}
				}
				else {
					inputKota.html("");
					inputKota.append("<option>" + json.message + "</option>");
				}
			},
		});
	}
});
</script>
@endsection