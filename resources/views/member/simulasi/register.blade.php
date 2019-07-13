@extends('layouts.admin')
@section('title') Simulasi {{ $simulasi->judul }}
@endsection

@section('content')
<div class="row">
    @if(!isset($_GET['pin']) && !isset($_GET['kap']) && !isset($_GET['enroll']))
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-preattempt">
            <div class="heading">
                {{ $simulasi->judul }}
            </div>
            <div class="panel-section">
                <div class="text-muted text-center">
                    SIMULASI 
                    @if($simulasi->is_online)
                    ONLINE
                    @endif
                    @if($simulasi->is_offline)
                    OFFLINE
                    @endif    
                </div>
            </div>
            <div class="panel-section">
                <div class="row">
                    <div class="col-md-3 col-xs-6 mb-3">
                        <div class="text-muted">PENYELENGGARA</div>
                        <div>{{ $simulasi->instansi }}</div>
                    </div>
                    <div class="col-md-3 col-xs-6 mb-3">
                        <div class="text-muted">SEKOLAH</div>
                        <div>{{ $simulasi->tingkatSekolah->nama }}</div>
                    </div>
                    <div class="col-md-3 col-xs-6 mb-3">
                        <div class="text-muted">HARGA</div>
                        <div>{{ $simulasi->harga > 0 ? formatUang($simulasi->harga) : "GRATIS"}}</div>
                    </div>
                </div>
            </div>
            <div class="panel-section">
                <div class="row">
                    <div class="col-md-3 col-xs-6 mb-3">
                        <div class="text-muted">WAKTU PELAKSANAAN</div>
                        <div>{{ hariTanggal($simulasi->tanggal_pelaksanaan) }}</div>
                    </div>
                    <div class="col-md-3 col-xs-6 mb-3">
                        <div class="text-muted">TEMPAT</div>
                        <div>{{ $simulasi->tempat_pelaksanaan }}</div>
                    </div>
                    <div class="col-md-6 col-xs-6 mb-3">
                        <div class="text-muted">WAKTU PENGUMUMAN</div>
                        <div>
                            {{ $simulasi->tanggal_pengumuman != null ? hariTanggal($simulasi->tanggal_pengumuman) : "-" }}
                        </div>
                    </div>
                </div>
            </div>
            @if($simulasi->is_offline)
            <div class="panel-section">
                <div class="row">
                    <div class="col-md-3 col-xs-6 mb-3">
                        <?php
                        $peserta = $simulasi->ruang->where('id_mapel', 1516)->sum('jumlah_peserta');
                        $kuota = $simulasi->ruang->where('id_mapel', 1516)->sum('kapasitas');
                        ?>
                        <div class="text-muted">KUOTA SAINTEK</div>
                        <div>{{ "$peserta/$kuota" }}</div>
                    </div>
                    <div class="col-md-3 col-xs-6 mb-3">
                        <?php
                        $peserta = $simulasi->ruang->where('id_mapel', 1517)->sum('jumlah_peserta');
                        $kuota = $simulasi->ruang->where('id_mapel', 1517)->sum('kapasitas');
                        ?>
                        <div class="text-muted">KUOTA SOSHUM</div>
                        <div>{{ "$peserta/$kuota" }}</div>
                    </div>
                </div>
            </div>
            @endif
            @if($simulasi->is_online)
            <div class="panel-section">
                <div class="row">
                    <div class="col-sm-12">
                        <?php
                        $peserta = $simulasi->jadwalOnline->sum('jumlah_peserta');
                        $kuota = $simulasi->jadwalOnline->sum('kapasitas');
                        ?>
                        <div class="text-muted">KUOTA PESERTA ONLINE</div>
                        <div>{{ "$peserta/$kuota" }}</div>
                    </div>
                </div>
            </div>
            @endif
            @if($simulasi->enroll)
            <div class="panel-section">
                Masuk Menggunakan Kode Enroll
                <form class="" action="" method="get">
                    <div class="form-group">
                        <label for="">Enroll</label>
                        <input type="text" class="form-control input-md" name="enroll" placeholder="KODE ENROLL"
                            value="{{ old('enroll') }}">
                    </div>
                    <button type="submit" class="btn btn-md btn-primary">Selanjutnya</button>
                </form>
            </div>
            @else
            <div class="panel-section">
                <form class="" action="" method="get">
                    <div class="form-group">
                        <input type="text" class="form-control input-sm input-pin" name="pin" placeholder="Masukan PIN Untuk Daftar" value="{{ old('pin') }}">
                    </div>
                    <button type="submit" class="btn btn-md btn-primary btn-block">Selanjutnya</button>
                </form>
            </div>
            @endif
        </div>
    </div>
    @else
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                Pilihan Passing Grade
            </div>
            <div class="panel-body">
                <form class="" action="{{ route('member.simulasi.register.post', $simulasi->id)}}" method="post">
                    @csrf
                    <input type="hidden" name="pin" value="{{ $tiket ? $tiket->pin : " " }}">
                    <input type="hidden" name="kap" value="{{ $tiket ? $tiket->kap : " " }}">
                    <input type="hidden" name="enroll" value="{{ $enroll ? $enroll : " " }}">
                    <div class="form-group hide">
                        <label class="control-label">PILIHAN SIMULASI</label>
                        <div>
                            @if($simulasi->is_offline)
                            <div class="be-radio inline">
                                <input type="radio" name="mode" id="OFFLINE" value="offline" checked>
                                <label for="OFFLINE">OFFLINE</label>
                            </div>
                            @endif @if($simulasi->is_online)
                            <div class="be-radio inline mb-3">
                                <input type="radio" name="mode" id="ONLINE" value="online" checked>
                                <label for="ONLINE">ONLINE</label>
                            </div>
                            @endif
                        </div>
                    </div>
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
                            <select id="univ1" class="select2 input-univ input-md" name="univ_1"
                                data-parseto="jurusan_1">
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
                            <select id="jurusan_1" class="select2 input-jurusan input-md" name="jurusan_1" required>
                            </select> @if($errors->has('jurusan_1'))
                            <span class="help-block">
                                <strong>{{ $errors->first('jurusan_1') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                    <hr>
                    <h6><strong>PILIHAN 2</strong></h6>
                    <div class="form-group">
                        <label class=" control-label">UNIVERSITAS</label>
                        <div class="">
                            <select id="univ2" class="select2 input-univ input-md" data-parseto="jurusan_2">
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
                            <select id="jurusan_2" class="select2 input-jurusan input-md" name="jurusan_2" required>
                            </select> @if($errors->has('jurusan_2'))
                            <span class="help-block">
                                <strong>{{ $errors->first('jurusan_2') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                    <hr>
                    <h6><strong>PILIHAN 3</strong></h6>
                    <div class="form-group">
                        <label class=" control-label">UNIVERSITAS</label>
                        <div class="">
                            <select id="univ3" class="select2 input-univ input-md" data-parseto="jurusan_3">
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
                            <select id="jurusan_3" class="select2 input-jurusan input-md" name="jurusan_3" required>
                            </select> @if($errors->has('jurusan_3'))
                            <span class="help-block">
                                <strong>{{ $errors->first('jurusan_3') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                    <hr>

                    <h6><strong>SEKOLAH ANDA</strong></h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Provinsi</label>
                                <select class="form-control input-md" id="inputProvinsi" name="id_provinsi">
                                    @foreach($provinsi as $data)
                                    <option value="{{ $data->id }}"
                                        {{ Auth::user()->id_sekolah != null && Auth::user()->sekolah->id_provinsi == $data->id ? "selected" : "" }}>
                                        {{ $data->name }}</option>
                                    @endforeach
                                </select> @if($errors->has('id_provinsi'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('id_provinsi') }}</strong>
                                </span> @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kabupaten/Kota</label>
                                <select class="form-control input-md" id="inputKota" name="id_kota">
                                    @if(Auth::user()->id_sekolah != null && $kota->count() > 0)
                                    @foreach($kota as $data)
                                    <option value="{{ $data->id }}"
                                        {{ Auth::user()->sekolah->id_kota == $data->id ? "selected" : "" }}>
                                        {{ $data->name }}</option>
                                    @endforeach
                                    @endif
                                </select> @if($errors->has('id_kota'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('id_kota') }}</strong>
                                </span> @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Tingkat Sekolah</label>
                        <select class="form-control input-md" id="inputTingkatSekolah" required
                            {{ Auth::user()->id_sekolah == null ? "disabled" : "" }}>
                            <option value="">-- Pilih Tingkat Sekolah --</option>
                            <option value="1301"
                                {{ Auth::user()->id_sekolah != null && Auth::user()->sekolah->id_tingkat_sekolah == 1301 ? "selected" : "" }}>
                                SD</option>
                            <option value="1302"
                                {{ Auth::user()->id_sekolah != null && Auth::user()->sekolah->id_tingkat_sekolah == 1302 ? "selected" : "" }}>
                                SMP</option>
                            <option value="1303"
                                {{ Auth::user()->id_sekolah != null && Auth::user()->sekolah->id_tingkat_sekolah == 1303 ? "selected" : "" }}>
                                SMA</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Asal Sekolah</label>
                        <select class="form-control input-md" id="inputSekolah" name="id_sekolah" required
                            {{ Auth::user()->id_sekolah == null ? "disabled" : "" }}>
                            @if(Auth::user()->id_sekolah != null && $sekolah->count() > 0)
                            @foreach($sekolah as $data)
                            <option value="{{ $data->id }}"
                                {{ Auth::user()->id_sekolah == $data->id ? "selected" : "" }}>{{ $data->nama }}</option>
                            @endforeach
                            @endif
                        </select> @if ($errors->has('id_sekolah'))
                        <span class="help-block">
                            <strong>{{ $errors->first('id_sekolah') }}</strong>
                        </span> @endif
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js" type="text/javascript">
</script>
<script type="text/javascript">
    $('.input-kap').mask('000000-000000', {placeholder: "KAP"});
    $('.input-pin').mask('0000-0000-0000-0000', {placeholder: "Masukan PIN Untuk Daftar"});

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