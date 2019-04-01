@extends('layouts.auth')
@section('title')
Daftar
@endsection

@section("desc")
Mari bergabung bersama ribuan siswa lainnya di Indonesia...
@endsection

@section('content')
<div class="form-holder">
    <div class="form-content">
        <div class="form-items">
            <h3>Daftar Sanedu</h3>
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show with-icon" role="alert">
                    {!! session('success') !!}
                </div>
            @elseif(session('danger'))
                <div class="alert alert-danger alert-dismissible fade show with-icon" role="alert">
                    {!! session('danger') !!}
                </div>
            @endif
            @if($step == 1)
            <form action="{{ route('auth.register') }}" method="GET">
                @csrf
                <div class="form-group">
                    <input class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="E-mail Address" required>
                </div>
                <div class="form-button full-width">
                    <button type="submit" class="ibtn">Kirim</button>
                </div>
            </form>
            <div class="other-links">
                <span>Sudah punya akun?</span><a href="{{ route('auth.login') }}">Masuk</a>
            </div>
            @else
            <form action="{{ route('auth.register.post') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="email" placeholder="EMAIL" value="{{ isset($_GET['email']) ? $_GET['email'] : "" }}" disabled required>
                    <input type="hidden" class="form-control" name="email" placeholder="EMAIL" value="{{ isset($_GET['email']) ? $_GET['email'] : "" }}" required>
                </div>
                @if($errors->has('email'))
                <span class="help-block">
                    <span>{{ $errors->first('email') }}</span>
                </span>
                @endif
                
                <hr>
                <div class="form-group">
                    <label for="">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama" placeholder="Tulis nama Anda" autofocus value="{{ old('nama') }}" required>
                    @if($errors->has('nama'))
                    <span class="help-block">
                        <span>{{ $errors->first('nama') }}</span>
                    </span>
                    @endif
                </div>
                
                <div class="form-group">
                    <label for="">No. Handphone</label>
                    <input type="number" class="form-control" name="no_hp" placeholder="+628xxxxxx" value="{{ old('no_hp') }}" required>
                    @if($errors->has('no_hp'))
                    <span class="help-block">
                        <span>{{ $errors->first('no_hp') }}</span>
                    </span>
                    @endif
                </div>
                
                <div class="form-group">
                    <label for="">No. Handphone Orang Tua</label>
                    <input type="number" class="form-control" name="no_hp_ortu" placeholder="+628xxxxxx" value="{{ old('no_hp_ortu') }}" required>
                    @if($errors->has('no_hp_ortu'))
                    <span class="help-block">
                        <span>{{ $errors->first('no_hp_ortu') }}</span>
                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="">No. Handphone Orang Tua</label>
                    <input type="text" class="form-control" name="tempat_lahir" placeholder="Jakarta" value="{{ old('tempat_lahir') }}" required>
                    @if($errors->has('tempat_lahir'))
                    <span class="help-block">
                        <span>{{ $errors->first('tempat_lahir') }}</span>
                    </span>
                    @endif
                </div>
                
                <div class="form-group">
                    <label for="">Tanggal Lahir</label>
                    <input type="date" class="form-control" name="tanggal_lahir" placeholder="Tanggal Lahir" value="{{ old('tanggal_lahir') }}" required>
                    @if($errors->has('tanggal_lahir'))
                    <span class="help-block">
                        <span>{{ $errors->first('tanggal_lahir') }}</span>
                    </span>
                    @endif
                </div>
                
                <div class="form-group">
                    <label for="">Alamat</label>
                    <input type="text" class="form-control" name="alamat" placeholder="ALAMAT" value="{{ old('alamat') }}" required>
                    @if($errors->has('alamat'))
                    <span class="help-block">
                        <span>{{ $errors->first('alamat') }}</span>
                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="">Provinsi</label>
                    <select class="form-control" id="inputProvinsi" name="id_provinsi" required">
                        <option value="">-- Pilih Provinsi --</option>
                        @foreach($provinsi as $data)
                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="">Kabupaten</label>
                    <select class="form-control" id="inputKota" name="id_kota" required">
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Sekolah</label>
                    <select class="form-control" id="inputTingkatSekolah" name="id_kota" disabled required">
                        <option value="">-- Pilih Tingkat Sekolah --</option>
                        <option value="1301" >SD</option>
                        <option value="1302" >SMP</option>
                        <option value="1303" >SMA</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Nama Sekolah</label>
                    <select class="form-control" id="inputSekolah" name="id_sekolah" disabled required">
                    </select>
                    @if ($errors->has('id_sekolah'))
                    <span class="help-block">
                        <span>{{ $errors->first('id_sekolah') }}</span>
                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="">Kelas</label>
                    <select class="form-control" id="inputKelas" name="id_kelas" disabled required">
                    </select>
                    @if ($errors->has('id_kelas'))
                    <span class="help-block">
                        <span>{{ $errors->first('id_kelas') }}</span>
                    </span>
                    @endif
                </div>
                
                <hr>
                
                <p>
                    Username dan Password digunakan untuk melakukan login ke Sanedu. Silahkan diingat untuk username dan password.
                </p>

                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Username" value="{{ old('username') }}" required>
                    <small class="label">Username: Gunakan huruf, angka tanpa spasi</small>
                    @if($errors->has('username'))
                    <span class="help-block">
                        <span>{{ $errors->first('username') }}</span>
                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                    @if($errors->has('password'))
                    <span class="help-block">
                        <span>{{ $errors->first('password') }}</span>
                    </span>
                    @endif
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Ulangi Password" required>
                </div>

                <div class="form-button">
                    <button id="submit" type="submit" class="ibtn">Daftar</button>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>

<script src="{{ asset('asset-beagle/lib/jquery/jquery.min.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $('.input-kap').mask('000000-000000', {placeholder: "KAP"});
    $('.input-pin').mask('0000-0000-0000-0000', {placeholder: "PIN"});
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