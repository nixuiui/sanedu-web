@extends('layouts.admin')

@section('title')
Buat Ujian Baru
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2">
        <form class="panel panel-default" action="{{ route('admin.ujian.soal.tambah.post') }}" method="post">
            <div class="panel-heading">Form Ujian</div>
            <div class="panel-body">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Judul Ujian</label>
                            <input type="text" class="form-control input-sm" placeholder="Ujian Nasional SMA Matematika" name="judul"  value="{{ old('judul') }}" required>
                            @if($errors->has('judul'))
                            <span class="help-block">
                                <strong>{{ $errors->first('judul') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Ujian</label>
                            <select class="form-control input-sm" id="inputUjian" name="id_ujian" disabled>
                                <option value=""></option>
                            </select>
                            @if($errors->has('id_ujian'))
                            <span class="help-block">
                                <strong>{{ $errors->first('id_ujian') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kelas</label>
                            <select class="form-control input-sm" id="inputKelas" name="id_kelas" disabled>
                                <option value=""></option>
                            </select>
                            @if($errors->has('id_kelas'))
                            <span class="help-block">
                                <strong>{{ $errors->first('id_kelas') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Mata Ujian</label>
                            <select class="form-control input-sm" id="inputMapel" name="id_mata_pelajaran" disabled>
                                <option value=""></option>
                            </select>
                            @if($errors->has('id_mata_pelajaran'))
                            <span class="help-block">
                                <strong>{{ $errors->first('id_mata_pelajaran') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
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
                    <div class="col-md-12 col-lg-6">
                        <div class="form-group">
                            <label for="">&nbsp;</label>
                            <div class="be-checkbox">
                                <input id="checkSoal" name="check_soal" type="checkbox">
                                <label for="checkSoal">Soal Ujian Berkelompok</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <div class="form-group">
                            <label>(DURASI) Menit</label>
                            <input type="number" id="durasiMenit" class="form-control input-sm" placeholder="60" name="menit"  value="{{ old('durasi') }}" required>
                            @if($errors->has('menit'))
                            <span class="help-block">
                                <strong>{{ $errors->first('menit') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <div class="form-group">
                            <label>Detik</label>
                            <input type="number" id="durasiDetik" class="form-control input-sm" placeholder="60" name="detik"  value="{{ old('durasi') }}" required>
                            @if($errors->has('detik'))
                            <span class="help-block">
                                <strong>{{ $errors->first('detik') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <button type="submit"  class="btn btn-primary btn-fill btn-md">Simpan</button>
            </div>
        </form>
    </div>
</div> <!-- end row -->
@endsection

@section('script')
<script type="text/javascript">
$("#checkSoal").click(function() {
    var isChecked = $(this).prop('checked');
    if(isChecked) {
        $("#durasiMenit").attr("disabled", "disabled");
        $("#durasiDetik").attr("disabled", "disabled");
    }
    else {
        $("#durasiMenit").removeAttr("disabled");
        $("#durasiDetik").removeAttr("disabled");
    }
});
$("#inputSekolah").change(function() {
	var dataSekolah = $("#inputSekolah");
	if(dataSekolah.val() != "null") {
		var url = "{{ route('ajax.pustaka.create.ujian') }}";
		$.ajax({
			type: 'get',
			url: url,
			data: {
                idSekolah: dataSekolah.val(),
                request: "jenisujian"
			},
			success: function(response) {
                var inputKelas 	= $("#inputKelas").attr('disabled', true).html("");
                var inputMapel 	= $("#inputMapel").attr('disabled', true).html("");
                var inputUjian 	= $("#inputUjian");
                inputUjian.attr('disabled', false);
				inputUjian.html("");
                if(response.length > 0) {
                    inputUjian.append("<option>Pilih Jenis Ujian</option>");
                    $.each(response, function(i, val) {
                        inputUjian.append("<option value=" + val.id + "> " + val.nama + "</option>");
                    });
                }
				else {
					inputUjian.html("");
					inputUjian.append("<option>Pilih Jenis Ujian</option>");
				}
			},
		});
	}
});
$("#inputUjian").change(function() {
    var dataSekolah = $("#inputSekolah");
	var dataUjian = $("#inputUjian");
	if(dataUjian.val() != "null") {
		var url = "{{ route('ajax.pustaka.create.ujian') }}";
		$.ajax({
			type: 'get',
			url: url,
			data: {
                idSekolah: dataSekolah.val(),
                idUjian: dataUjian.val(),
                request: "kelasmapel"
			},
			success: function(response) {
                var inputKelas 	= $("#inputKelas");
				var inputMapel 	= $("#inputMapel");
                inputKelas.attr('disabled', true);
                inputKelas.html("");
                inputMapel.attr('disabled', true);
				inputMapel.html("");
                console.log(response);
                if(response.kelas.length > 0) {
                    inputKelas.attr('disabled', false);
                    inputKelas.append("<option>Pilih Kelas</option>");
                    $.each(response.kelas, function(i, val) {
                        inputKelas.append("<option value=" + val.id + "> " + val.nama + "</option>");
                    });
                }
                else {
                    inputKelas.attr('disabled', true);
                }
                if(response.mapel.length > 0) {
                    inputMapel.attr('disabled', false);
                    inputMapel.append("<option>Pilih Mata Pelajaran</option>");
                    $.each(response.mapel, function(i, val) {
                        inputMapel.append("<option value=" + val.id + "> " + val.nama + "</option>");
                    });
                }
                else {
                    inputMapel.attr('disabled', true);
                }
			},
		});
	}
});

</script>
@endsection
