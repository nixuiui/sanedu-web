@extends('layouts.admin')

@section('title')
Simulasi {{ $simulasi->judul }}
@endsection

@section('content')
<div class="row">
        @if(!isset($_GET['pin']) && !isset($_GET['kap']) && !isset($_GET['enroll']))
        <div class="col-md-8">
            <div class="row">
                @if($simulasi->enroll)
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Masuk Menggunakan Kode Enroll
                        </div>
                        <div class="panel-body">
                            <form class="" action="" method="get">
                                <div class="form-group">
                                    <label for="">Enroll</label>
                                    <input type="text" class="form-control input-sm" name="enroll" placeholder="KODE ENROLL" value="{{ old('enroll') }}">
                                </div>
                                <button type="submit" class="btn btn-md btn-primary">Selanjutnya</button>
                            </form>
                        </div>
                    </div>
                </div>
                @else
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Masukan PIN & KAP Anda
                        </div>
                        <div class="panel-body">
                            <form class="" action="" method="get">
                                <div class="form-group">
                                    <label for="">PIN</label>
                                    <input type="text" class="form-control input-sm input-pin" name="pin" placeholder="PIN" value="{{ old('pin') }}">
                                </div>
                                <div class="form-group">
                                    <label for="">KAP</label>
                                    <input type="text" class="form-control input-sm input-kap" name="kap" placeholder="KAP" value="{{ old('kap') }}">
                                </div>
                                <button type="submit" class="btn btn-md btn-primary">Selanjutnya</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        @else
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Pilihan Passing Grade
                </div>
                <div class="panel-body">
                    <form class="" action="{{ route('member.simulasi.register.post', $simulasi->id)}}" method="post">
                        @csrf
                        <input type="hidden" name="pin" value="{{ $tiket ? $tiket->pin : "" }}">
                        <input type="hidden" name="kap" value="{{ $tiket ? $tiket->kap : "" }}">
                        <input type="hidden" name="enroll" value="{{ $enroll ? $enroll : "" }}">
                        <div class="form-group">
                            <label class="control-label">PILIHAN SIMULASI</label>
                            <div>
                                @if($simulasi->is_offline)
                                <div class="be-radio inline">
                                    <input type="radio" name="mode" id="OFFLINE" value="offline" checked>
                                    <label for="OFFLINE">OFFLINE</label>
                                </div>
                                @endif
                                @if($simulasi->is_online)
                                <div class="be-radio inline mb-3">
                                    <input type="radio" name="mode" id="ONLINE" value="online">
                                    <label for="ONLINE">ONLINE</label>
                                </div>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="control-label">JURUSAN</label>
                            <div class="">
                                <div class="be-radio inline">
                                    <input type="radio" name="jurusan" id="SAINTEK" value="1516" checked>
                                    <label for="SAINTEK">SAINTEK</label>
                                </div>
                                <div class="be-radio inline">
                                    <input type="radio" name="jurusan" id="SOSHUM" value="1517">
                                    <label for="SOSHUM">SOSHUM</label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h6><strong>PILIHAN 1</strong></h6>
                        <div class="form-group">
                            <label class=" control-label">UNIVERSITAS</label>
                            <div class="">
                                <select id="univ1" class="select2 input-univ input-sm" name="univ_1" data-parseto="jurusan_1">
                                    <option value="">Pilih Universitas</option>
                                    @foreach($universitas as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" control-label">JURUSAN</label>
                            <div class="">
                                <select id="jurusan_1" class="select2 input-jurusan input-sm" name="jurusan_1" required>
                                </select>
                                @if($errors->has('jurusan_1'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('jurusan_1') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <h6><strong>PILIHAN 2</strong></h6>
                        <div class="form-group">
                            <label class=" control-label">UNIVERSITAS</label>
                            <div class="">
                                <select id="univ2" class="select2 input-univ input-sm" data-parseto="jurusan_2">
                                    <option value="">Pilih Universitas</option>
                                    @foreach($universitas as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" control-label">JURUSAN</label>
                            <div class="">
                                <select id="jurusan_2" class="select2 input-jurusan input-sm" name="jurusan_2" required>
                                </select>
                                @if($errors->has('jurusan_2'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('jurusan_2') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <h6><strong>PILIHAN 3</strong></h6>
                        <div class="form-group">
                            <label class=" control-label">UNIVERSITAS</label>
                            <div class="">
                                <select id="univ3" class="select2 input-univ input-sm" data-parseto="jurusan_3">
                                    <option value="">Pilih Universitas</option>
                                    @foreach($universitas as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" control-label">JURUSAN</label>
                            <div class="">
                                <select id="jurusan_3" class="select2 input-jurusan input-sm" name="jurusan_3" required>
                                </select>
                                @if($errors->has('jurusan_3'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('jurusan_3') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Provinsi</label>
                                <select class="form-control input-sm" id="inputProvinsi" name="id_provinsi">
                                    @foreach($provinsi as $data)
                                    <option value="{{ $data->id }}" {{ Auth::user()->id_sekolah != null && Auth::user()->sekolah->id_provinsi == $data->id ? "selected" : "" }}>{{ $data->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('id_provinsi'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('id_provinsi') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kabupaten/Kota</label>
                                <select class="form-control input-sm" id="inputKota" name="id_kota">
                                    @if(Auth::user()->id_sekolah != null && $kota->count() > 0)
                                    @foreach($kota as $data)
                                    <option value="{{ $data->id }}" {{ Auth::user()->sekolah->id_kota == $data->id ? "selected" : "" }}>{{ $data->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @if($errors->has('id_kota'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('id_kota') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Tingkat Sekolah</label>
                        <select class="form-control input-sm" id="inputTingkatSekolah" required {{ Auth::user()->id_sekolah == null ? "disabled" : "" }}>
                            <option value="">-- Pilih Tingkat Sekolah --</option>
                            <option value="1301" {{ Auth::user()->id_sekolah != null && Auth::user()->sekolah->id_tingkat_sekolah == 1301 ? "selected" : "" }}>SD</option>
                            <option value="1302" {{ Auth::user()->id_sekolah != null && Auth::user()->sekolah->id_tingkat_sekolah == 1302 ? "selected" : "" }}>SMP</option>
                            <option value="1303" {{ Auth::user()->id_sekolah != null && Auth::user()->sekolah->id_tingkat_sekolah == 1303 ? "selected" : "" }}>SMA</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Asal Sekolah</label>
                        <select class="form-control input-sm" id="inputSekolah" name="id_sekolah" required {{ Auth::user()->id_sekolah == null ? "disabled" : "" }}>
                            @if(Auth::user()->id_sekolah != null && $sekolah->count() > 0)
                            @foreach($sekolah as $data)
                            <option value="{{ $data->id }}" {{ Auth::user()->id_sekolah == $data->id ? "selected" : "" }}>{{ $data->nama }}</option>
                            @endforeach
                            @endif
                        </select>
                        @if ($errors->has('id_sekolah'))
                        <span class="help-block">
                            <strong>{{ $errors->first('id_sekolah') }}</strong>
                        </span>
                        @endif
                    </div>
                        <button type="submit" class="btn btn-sm btn-primary btn-block">Daftar</button>
                    </form>
                </div>
            </div>
        </div>
        @endif
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $('.input-kap').mask('000000-000000', {placeholder: "KAP"});
    $('.input-pin').mask('0000-0000-0000-0000', {placeholder: "PIN"});
</script>
<script type="text/javascript">
$(document).ready(function(){
    $("input[name=jurusan]").change(function() {
        $(".input-jurusan").html("");
    });
    $(".select2").change(function() {
        var el = $(this);
        var jurusan = $("input[name=jurusan]:checked").val();
        var inputJurusan = $("#" + el.data('parseto'));
        var url = "{{ route('ajax.universitas', ['id' => ':id', 'jurusan' => 'idjur']) }}";
        url = url.replace(":id", el.val());
        url = url.replace("idjur", jurusan);
        $.ajax({
            type: "get",
            url: url,
            success: function(data) {
                if(data.length > 0) {
                    inputJurusan.html("");
                    inputJurusan.append("<option>Pilih Jurusan</option>");
                    $.each(data, function(i, val) {
                        inputJurusan.append("<option value=" + val.id + "> " + val.jurusan + "</option>");
                    });
                }
                else {
                    inputJurusan.html("");
                    inputJurusan.append("<option>Tidak ada jurusan</option>");
                }
            }
        });
    });
});
</script>
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
					inputKota.append("<option value=''>Pilih Kabupaten/Kota</option>");
                    if(json.data.kota.length > 0) {
                        $.each(json.data.kota, function(i, val) {
                            inputKota.append("<option value=" + val.id + "> " + val.name + "</option>");
                        });
                    }
    				else {
    					inputKota.html("");
    					inputKota.append("<option>Data Kabupaten/Kota Belum Ada</option>");
    				}
                    $("#inputTingkatSekolah").prop("disabled", true);
                    $("#inputSekolah").prop("disabled", true);
				}
				else {
					inputKota.html("");
					inputKota.append("<option>" + json.message + "</option>");
				}
			},
		});
	}
});

$("#inputKota").change(function() {
    if($(this).val() != null && $(this).val() != "")
        $("#inputTingkatSekolah").prop("disabled", false);
    else
        $("#inputTingkatSekolah").prop("disabled", true);
    var tingkatSekolah = $("#inputTingkatSekolah");
    if(tingkatSekolah.val() != null && tingkatSekolah.val() != "") {
        getSekolah();
    }
});

$("#inputTingkatSekolah").change(function() {
    if($(this).val() != null && $(this).val() != "")
        $("#inputSekolah").prop("disabled", false);
    else
        $("#inputSekolah").prop("disabled", true);
    getSekolah();
});

function getSekolah() {
	var tingkatSekolah = $("#inputTingkatSekolah");
	var kota = $("#inputKota");
    var url = "{{ route('ajax.sekolah') }}?id_kota=" + kota.val() + "&id_tingkat_sekolah=" + tingkatSekolah.val();
    $.ajax({
        type: 'get',
        url: url,
        data: {
        },
        success: function(data) {
            var json 			= jQuery.parseJSON(data);
            var inputSekolah 	= $("#inputSekolah");
            if(json.success) {
                inputSekolah.html("");
                inputSekolah.prop("disabled", false);
                inputSekolah.append("<option value=''>Pilih Sekolah</option>");
                if(json.data.length > 0) {
                    $.each(json.data, function(i, val) {
                        inputSekolah.append("<option value=" + val.id + "> " + val.nama + "</option>");
                    });
                }
                else {
                    inputSekolah.html("");
                    inputSekolah.append("<option>Data Sekolah Belum Ada</option>");
                }
            }
            else {
                inputSekolah.html("");
                inputSekolah.append("<option>" + json.message + "</option>");
            }
        },
    });
}
</script>
@endsection
