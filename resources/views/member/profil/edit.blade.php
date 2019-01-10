@extends('layouts.admin')

@section('title')
Pengaturan Profil
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <form class="panel panel-default" action="{{ route('member.profil.edit.profil') }}" method="post">
            <div class="panel-heading">
                Profil Andas
            </div>
            <div class="panel-body">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" class="form-control input-sm" placeholder="Nama Lengkap" name="nama"  value="{{ $user->nama }}" required>
                    @if ($errors->has('nama'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nama') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Nomor HP</label>
                    <input type="text" class="form-control input-sm" placeholder="Nomor HP" name="no_hp"  value="{{ $user->no_hp }}" required>
                    @if ($errors->has('no_hp'))
                    <span class="help-block">
                        <strong>{{ $errors->first('no_hp') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Nomor HP Orang Tua</label>
                    <input type="text" class="form-control input-sm" placeholder="Nomor HP Orang Tua" name="no_hp_ortu"  value="{{ $user->no_hp_ortu }}" required>
                    @if ($errors->has('no_hp_ortu'))
                    <span class="help-block">
                        <strong>{{ $errors->first('no_hp_ortu') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" class="form-control input-sm" placeholder="Alamat" name="alamat"  value="{{ $user->alamat }}" required>
                    @if ($errors->has('alamat'))
                    <span class="help-block">
                        <strong>{{ $errors->first('alamat') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Tempat Lahir</label>
                    <input type="text" class="form-control input-sm" placeholder="Tempat Lahir" name="tempat_lahir"  value="{{ $user->tempat_lahir }}" required>
                    @if ($errors->has('tempat_lahir'))
                    <span class="help-block">
                        <strong>{{ $errors->first('tempat_lahir') }}</strong>
                    </span>
                    @endif
                </div>
                <button type="submit"  class="btn btn-primary btn-fill btn-md">Simpan Perubahan</button>
            </div>
        </form>
        <form class="panel panel-default" action="{{ route('member.profil.edit.sekolah') }}" method="post">
            <div class="panel-heading"><i class="mdi mdi-balance mr-3"></i> Informasi Sekolah</div>
            <div class="panel-body">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Provinsi</label>
                            <select class="form-control input-sm" id="inputProvinsi" name="id_provinsi">
                                @foreach($provinsi as $data)
                                <option value="{{ $data->id }}" {{ $user->id_sekolah != null && $user->sekolah->id_provinsi == $data->id ? "selected" : "" }}>{{ $data->name }}</option>
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
                                @if($user->id_sekolah != null && $kota->count() > 0)
                                @foreach($kota as $data)
                                <option value="{{ $data->id }}" {{ $user->sekolah->id_kota == $data->id ? "selected" : "" }}>{{ $data->name }}</option>
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
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tingkat Sekolah</label>
                            <select class="form-control input-sm" id="inputTingkatSekolah" required {{ $user->id_sekolah == null ? "disabled" : "" }}>
                                <option value="">-- Pilih Tingkat Sekolah --</option>
                                <option value="1301" {{ $user->id_sekolah != null && $user->sekolah->id_tingkat_sekolah == 1301 ? "selected" : "" }}>SD</option>
                                <option value="1302" {{ $user->id_sekolah != null && $user->sekolah->id_tingkat_sekolah == 1302 ? "selected" : "" }}>SMP</option>
                                <option value="1303" {{ $user->id_sekolah != null && $user->sekolah->id_tingkat_sekolah == 1303 ? "selected" : "" }}>SMA</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kelas</label>
                            <select class="form-control input-sm" id="inputKelas" name="id_kelas" required {{ $user->id_kelas == null ? "disabled" : "" }}>
                                @if($user->id_kelas != null && $sekolah->count() > 0)
                                @foreach($kelas as $data)
                                <option value="{{ $data->id }}" {{ $user->id_kelas == $data->id ? "selected" : "" }}>{{ $data->nama }}</option>
                                @endforeach
                                @endif
                            </select>
                            @if ($errors->has('id_kelas'))
                            <span class="help-block">
                                <strong>{{ $errors->first('id_kelas') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Sekolah</label>
                    <select class="form-control input-sm" id="inputSekolah" name="id_sekolah" required {{ $user->id_sekolah == null ? "disabled" : "" }}>
                        @if($user->id_sekolah != null && $sekolah->count() > 0)
                        @foreach($sekolah as $data)
                        <option value="{{ $data->id }}" {{ $user->id_sekolah == $data->id ? "selected" : "" }}>{{ $data->nama }}</option>
                        @endforeach
                        @endif
                    </select>
                    @if ($errors->has('id_sekolah'))
                    <span class="help-block">
                        <strong>{{ $errors->first('id_sekolah') }}</strong>
                    </span>
                    @endif
                </div>
                <button type="submit"  class="btn btn-primary btn-fill btn-md">Simpan Perubahan</button>
            </div>
        </form>
    </div>
    <div class="col-md-6">
        <form class="panel panel-default" action="{{ route('member.profil.edit.email') }}" method="post">
            <div class="panel-heading"><i class="mdi mdi-email mr-3"></i> Email</div>
            <div class="panel-body">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Gunakan email yang aktif</label>
                    <input type="email" class="form-control input-sm" placeholder="email" name="email"  value="{{ $user->email }}">
                    @if($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
                <button type="submit"  class="btn btn-primary btn-fill btn-md">Simpan Perubahan</button>
            </div>
        </form>
        <form class="panel panel-default" action="{{ route('member.profil.edit.username') }}" method="post">
            <div class="panel-heading">Username</div>
            <div class="panel-body">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" class="form-control input-sm" placeholder="Username" name="username"  value="{{ $user->username }}">
                    @if ($errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                    @endif
                </div>
                <button type="submit"  class="btn btn-primary btn-fill btn-md">Simpan Perubahan</button>
            </div>
        </form>
        <form class="panel panel-default" action="{{ route('member.profil.edit.password') }}" method="post">
            <div class="panel-heading">Kata Sandi</div>
            <div class="panel-body">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Password Lama</label>
                    <input type="password" class="form-control input-sm" placeholder="Password Lama" name="current_password" >
                    @if ($errors->has('current_password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('current_password') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Password Baru</label>
                    <input type="password" class="form-control input-sm" placeholder="Minimal 6 karakter" name="password" >
                    @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Ulangi Password</label>
                    <input type="password" class="form-control input-sm" placeholder="Ulangi Password" name="password_confirmation" >
                    @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                    @endif
                </div>
                <button type="submit"  class="btn btn-primary btn-fill btn-md">Simpan Perubahan</button>
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
    getKelas();
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

function getKelas() {
	var tingkatSekolah = $("#inputTingkatSekolah");
    var url = "{{ route('ajax.kelas') }}?id_tingkat_sekolah=" + tingkatSekolah.val();
    $.ajax({
        type: 'get',
        url: url,
        data: {
        },
        success: function(data) {
            var json 			= jQuery.parseJSON(data);
            var inputKelas 	= $("#inputKelas");
            if(json.success) {
                inputKelas.html("");
                inputKelas.prop("disabled", false);
                inputKelas.append("<option value=''>Pilih Kelas</option>");
                if(json.data.length > 0) {
                    $.each(json.data, function(i, val) {
                        inputKelas.append("<option value=" + val.id + "> " + val.nama + "</option>");
                    });
                }
                else {
                    inputKelas.html("");
                    inputKelas.append("<option>Data Kelas Belum Ada</option>");
                }
            }
            else {
                inputKelas.html("");
                inputKelas.append("<option>" + json.message + "</option>");
            }
        },
    });
}
</script>
@endsection