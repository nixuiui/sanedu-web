@extends('layouts.auth')
@section('title')
Daftar
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('asset-landing/css/login.css')}}">
@endsection

@section('content')
<div class='wrapper Down'>
    <div id='formContent'>
        <!-- Tabs Titles -->
        <h2 class='active'> DAFTAR MEMBER SANEDU</h2>

        <!-- Icon -->
        <div class=''>
            <a href='index.php'>
                <img src="{{ asset('asset-landing/img/main/icon.svg')}}" alt='User Icon' style='height: 130px; width: 130px;' />
            </a>
        </div>

        <!-- Registrasi -->
        @if($step == 1)
        <form action="{{ route('auth.register') }}" method="GET">
            @if(isset($success))
                <div class="alert alert-success" style="width:85%; margin: 0 auto 15px;">
                    {!! $success !!}
                </div>
            @elseif(isset($danger))
                <div class="alert alert-danger" style="width:85%; margin: 0 auto 15px;">
                    {!! $danger !!}
                </div>
            @endif
            <input type="text" class=" input-pin" name="pin" placeholder="PIN" value="{{ old('pin') }}" autofocus required>
            <input type="text" class=" input-kap" name="kap" value="{{ old('kap') }}" required>
            <input type="submit" class="" value="LANJUTKAN">
        </form>
        @elseif($step == 2)
        <form action="{{ route('auth.register') }}" method="GET">
            @if(isset($success))
                <div class="alert alert-success" style="width:85%; margin: 0 auto 15px;">
                    {!! $success !!}
                </div>
            @elseif(isset($danger))
                <div class="alert alert-danger" style="width:85%; margin: 0 auto 15px;">
                    {!! $danger !!}
                </div>
            @endif
            <input type="text" class="" value="{{ $_GET['kap'] }}" disabled required>
            <input type="hidden" class="" name="kap" placeholder="KAP" value="{{ $_GET['kap'] }}" required>
            <input type="text" class="" value="{{ $_GET['pin'] }}" disabled required>
            <input type="hidden" class="" name="pin" placeholder="PIN" value="{{ $_GET['pin'] }}" required>
            <hr>
            <input type="text" class="" name="email" value="{{ old('email') }}" placeholder="EMAIL" required>
            <input type="submit" class="" value="LANJUTKAN">
        </form>
        @else
        <form action="{{ route('auth.register.post') }}" method="POST">
            @csrf
            <input type="text" class="" value="{{ $_GET['kap'] }}" disabled required>
            <input type="hidden" class="" name="kap" placeholder="KAP" value="{{ $_GET['kap'] }}" required>
            @if($errors->has('kap'))
            <span class="help-block">
                <span>{{ $errors->first('kap') }}</span>
            </span>
            @endif
            <input type="text" class="" value="{{ $_GET['pin'] }}" disabled required>
            <input type="hidden" class="" name="pin" placeholder="PIN" value="{{ $_GET['pin'] }}" required>
            @if($errors->has('pin'))
            <span class="help-block">
                <span>{{ $errors->first('pin') }}</span>
            </span>
            @endif
            <input type="text" class="" name="email" placeholder="EMAIL" value="{{ $_GET['email'] }}" disabled required>
            <input type="hidden" class="" name="email" placeholder="EMAIL" value="{{ $_GET['email'] }}" required>
            @if($errors->has('email'))
            <span class="help-block">
                <span>{{ $errors->first('email') }}</span>
            </span>
            @endif
            <hr>
            <h2 class='active'> INFORMASI ANDA</h2>
            <input type="text" class="" name="nama" placeholder="NAMA ANDA" autofocus value="{{ old('nama') }}" required>
            @if($errors->has('nama'))
            <span class="help-block">
                <span>{{ $errors->first('nama') }}</span>
            </span>
            @endif
            <input type="number" class="" name="no_hp" placeholder="NO. HANDPHONE" value="{{ old('no_hp') }}" required>
            @if($errors->has('no_hp'))
            <span class="help-block">
                <span>{{ $errors->first('no_hp') }}</span>
            </span>
            @endif
            <input type="number" class="" name="no_hp_ortu" placeholder="NO. HANDPHONE ORANG TUA" value="{{ old('no_hp_ortu') }}" required>
            @if($errors->has('no_hp_ortu'))
            <span class="help-block">
                <span>{{ $errors->first('no_hp_ortu') }}</span>
            </span>
            @endif
            <input type="text" class="" name="tempat_lahir" placeholder="Tempat Lahir" value="{{ old('tempat_lahir') }}" required>
            @if($errors->has('tempat_lahir'))
            <span class="help-block">
                <span>{{ $errors->first('tempat_lahir') }}</span>
            </span>
            @endif
            <input type="date" class="" name="tanggal_lahir" placeholder="Tanggal Lahir" value="{{ old('tanggal_lahir') }}" required>
            @if($errors->has('tanggal_lahir'))
            <span class="help-block">
                <span>{{ $errors->first('tanggal_lahir') }}</span>
            </span>
            @endif
            <input type="text" class="" name="alamat" placeholder="ALAMAT" value="{{ old('alamat') }}" required>
            @if($errors->has('alamat'))
            <span class="help-block">
                <span>{{ $errors->first('alamat') }}</span>
            </span>
            @endif
            <select class="" id="inputProvinsi" name="id_provinsi" required style="height: 50px;">
                <option value="">-- Pilih Provinsi --</option>
                @foreach($provinsi as $data)
                <option value="{{ $data->id }}">{{ $data->name }}</option>
                @endforeach
            </select>
            <select class="" id="inputKota" name="id_kota" required style="height: 50px;">
            </select>
            <select class="" id="inputTingkatSekolah" name="id_kota" disabled required style="height: 50px;">
                <option value="">-- Pilih Tingkat Sekolah --</option>
                <option value="1301" >SD</option>
                <option value="1302" >SMP</option>
                <option value="1303" >SMA</option>
            </select>
            <select class="" id="inputSekolah" name="id_sekolah" disabled required style="height: 50px;">
            </select>
            @if ($errors->has('id_sekolah'))
            <span class="help-block">
                <span>{{ $errors->first('id_sekolah') }}</span>
            </span>
            @endif
            <select class="" id="inputKelas" name="id_kelas" disabled required style="height: 50px;">
            </select>
            @if ($errors->has('id_kelas'))
            <span class="help-block">
                <span>{{ $errors->first('id_kelas') }}</span>
            </span>
            @endif
            <hr>
            <div class="padd">
                Username dan Password digunakan untuk melakukan login ke Sanedu. Silahkan diingat untuk username dan password.
            </div>
            <input type="text" class="" name="username" placeholder="Username" value="{{ old('username') }}" required>
            <small class="label">Username: Gunakan huruf, angka tanpa spasi</small>
            @if($errors->has('username'))
            <span class="help-block">
                <span>{{ $errors->first('username') }}</span>
            </span>
            @endif
            <input type="password" class="" name="password" placeholder="Password" required>
            @if($errors->has('password'))
            <span class="help-block">
                <span>{{ $errors->first('password') }}</span>
            </span>
            @endif
            <input type="password" class="" name="password_confirmation" placeholder="Password" required>
            <input type="submit" class="" value="Daftar" required>
        </form>
        @endif

        <!-- Remind Passowrd -->
        <div id="formFooter">
            Sudah punya akun ? <a class="underlineHover" href="{{ route('auth.login') }}">LOGIN</a>
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