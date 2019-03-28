@extends('layouts.admin')

@section('title')
Tambah Sekolah
@endsection

@section('content')
<div class="row">
    <div class="col-md-4">
        <form class="panel panel-default" action="{{ route('admin.sekolah.edit.post', $sekolah->id) }}" method="post">
            <div class="panel-heading"><i class="mdi mdi-comments"></i> Tambah Sekolah</div>
            <div class="panel-body">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Provinsi</label>
                    <select class="form-control input-sm" id="inputProvinsi" name="id_provinsi" required>
                        <option value="">-- Pilih Provinsi --</option>
                        @foreach($provinsi as $data)
                        <option value="{{ $data->id }}" {{ $sekolah->id_provinsi == $data->id ? "selected" : "" }}>{{ $data->name }}</option>
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
                        @foreach($kota as $data)
                        <option value="{{ $data->id }}" {{ $sekolah->id_kota == $data->id ? "selected" : "" }}>{{ $data->name }}</option>
                        @endforeach
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
                        <option value="1301" {{ $sekolah->id_tingkat_sekolah == 1301 ? "selected" : "" }}>SD</option>
                        <option value="1302" {{ $sekolah->id_tingkat_sekolah == 1302 ? "selected" : "" }}>SMP</option>
                        <option value="1303" {{ $sekolah->id_tingkat_sekolah == 1303 ? "selected" : "" }}>SMA</option>
                    </select>
                    @if($errors->has('id_tingkat_sekolah'))
                    <span class="help-block">
                        <strong>{{ $errors->first('id_tingkat_sekolah') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Nama Sekolah</label>
                    <input type="text" class="form-control input-sm" placeholder="Nama Sekolah" name="nama"  value="{{ $sekolah->nama }}" required>
                </div>
                <button type="submit"  class="btn btn-primary btn-fill btn-md">Simpan</button>
            </div>
        </form>
    </div>
</div> <!-- end row -->
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