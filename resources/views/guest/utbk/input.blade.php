@extends("layouts.auth")

@section("title")
Login
@endsection

@section("desc")
Kami disini akan membantu menganalisis nilai UTBK Anda...
@endsection

@section("content")
<div class="form-holder">
    <div class="form-content">
        <div class="form-items">
            <h3>Input Nilai UTBK</h3>
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show with-icon" role="alert">
                {!! session('success') !!}
            </div>
            @elseif(session('danger'))
            <div class="alert alert-danger alert-dismissible fade show with-icon" role="alert">
                {!! session('danger') !!}
            </div>
            @endif

            @if(!isset($enrolled) || !$enrolled)
            <form action="" method="GET">
                <input class="form-control" type="number" name="enroll" placeholder="Masukan Kode Enroll" required>
                <div class="form-button full-width">
                    <button id="submit" type="submit" class="ibtn mb-2">Lanjutkan</button>
                </div>
            </form>
            @elseif(isset($enrolled) && $enrolled)
            <form action="{{ route('guest.utbk.input.post') }}" method="POST">
                @csrf
                <input class="form-control" type="text" name="nama" placeholder="Nama Lengkap" required>
                <input class="form-control" type="text" name="asal_sekolah" placeholder="Asal Sekolah" required>
                <input class="form-control" type="number" name="no_utbk" placeholder="No. UTBK" required>
                <select class="form-control mb-3" id="inputProvinsi" name="id_provinsi" required>
                    <option value="">-- Pilih Provinsi --</option>
                    @foreach($provinsi as $data)
                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                    @endforeach
                </select>
                <select class="form-control mb-3" id="inputKota" name="id_kota" required>
                </select>
                <input class="form-control" type="number" name="no_utbk" placeholder="No. Telp/Whatsapp" required>
                <div class="form-group">
                    <input type="radio" name="jenis_utbk" value="saintek"> Saintek
                    <input class="ml-5" type="radio" name="jenis_utbk" value="soshum"> Soshum
                </div>
                <div id="nilai" class="d-none">
                    Nilai
                    <hr>
                    <div class="form-group">
                        <label for="">Kemampuan Penalaran Umum</label>
                        <input class="form-control" type="number" name="nilai_1" placeholder="0" value="0" required>                    
                    </div>
                    <div class="form-group">
                        <label for="">Pengetahuan Kuantitatif</label>
                        <input class="form-control" type="number" name="nilai_2" placeholder="0" value="0" required>                    
                    </div>
                    <div class="form-group">
                        <label for="">Pengetahuan dan Pemahaman Umum</label>
                        <input class="form-control" type="number" name="nilai_3" placeholder="0" value="0" required>                    
                    </div>
                    <div class="form-group">
                        <label for="">Kemampuan Memahami Bacaan dan Menulis</label>
                        <input class="form-control" type="number" name="nilai_4" placeholder="0" value="0" required>                    
                    </div>
                </div>
                <div id="nilaiSaintek" class="d-none">
                    Matematika Saintek
                    <hr>
                    <div class="form-group">
                        <label for="">Fisika</label>
                        <input class="form-control" type="number" name="nilai_5" placeholder="0" value="0" required>                    
                    </div>
                    <div class="form-group">
                        <label for="">Biologi</label>
                        <input class="form-control" type="number" name="nilai_6" placeholder="0" value="0" required>                    
                    </div>
                    <div class="form-group">
                        <label for="">Kimia</label>
                        <input class="form-control" type="number" name="nilai_7" placeholder="0" value="0" required>                    
                    </div>
                </div>
                <div id="nilaiSoshum" class="d-none">
                    Matematika Soshum
                    <hr>
                    <div class="form-group">
                        <label for="">Geografi</label>
                        <input class="form-control" type="number" name="nilai_8" placeholder="0" value="0" required>                    
                    </div>
                    <div class="form-group">
                        <label for="">Sejarah</label>
                        <input class="form-control" type="number" name="nilai_9" placeholder="0" value="0" required>                    
                    </div>
                    <div class="form-group">
                        <label for="">Sosiologi</label>
                        <input class="form-control" type="number" name="nilai_10" placeholder="0" value="0" required>                    
                    </div>
                    <div class="form-group">
                        <label for="">Ekonomi</label>
                        <input class="form-control" type="number" name="nilai_11" placeholder="0" value="0" required>                    
                    </div>
                </div>
                <div class="form-button full-width">
                    <button id="submit" type="submit" class="ibtn mb-2">Kirim</button>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>

<script>
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
				}
				else {
					inputKota.html("");
					inputKota.append("<option>" + json.message + "</option>");
				}
			},
		});
	}
});

$(document).ready(function(){
    $("input[name='jenis_utbk']").click(function(){
        $("#nilai").removeClass('d-none');

        var radioValue = $(this).val();
        var saintek = $("#nilaiSaintek");
        var soshum = $("#nilaiSoshum");
        if(radioValue == "saintek"){
            saintek.removeClass('d-none');
            soshum.addClass('d-none');
        }
        else {
            saintek.addClass('d-none');
            soshum.removeClass('d-none');
        }
    });
});
</script>
@endsection