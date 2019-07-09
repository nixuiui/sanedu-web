@extends('layouts.adminnopadding')

@section('title')
Kelompok Ujian
@endsection

@section('description')
{{ $ujian->judul }}
@endsection

@section('navigation')
    @include('adminujian.ujian.menu', ['jumlahSoal' => $ujian->soal->count(), 'jumlahPeserta' => $ujian->diBeliOleh->count(), 'jumlahRiwayat' => $ujian->attempt->count()])
@endsection

@section('content')
<div class="email-inbox-header">
    <div class="row">
        <div class="col-md-12">
            <div class="email-title">
                <span class="icon mdi mdi-inbox mr-3"></span> Kelompok Soal Ujian
            </div>
            <div>
                @if($ujian->is_grouped)
                Ujian ini memiliki model soal yang berkelompok.
                @else
                Ujian ini memiliki model soal biasa.
                @endif
            </div>
        </div>
    </div>
</div>
@if(isset($group))
<form class="panel panel-default no-border no-radius" action="{{ route('admin.ujian.soal.form.kelompok.soal.post', ['id' => $ujian->id, 'idKelompokSoal' => $group->id]) }}" method="post">
@else
<form class="panel panel-default no-border no-radius" action="{{ route('admin.ujian.soal.form.kelompok.soal.post', $ujian->id) }}" method="post">
@endif
    <div class="panel-body pb-5">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nama Kelompok Soal Ujian</label>
                            <input type="text" class="form-control input-md" placeholder="Matematika" name="nama"  value="{{ $group ? $group->nama : old('judul') }}" required>
                            @if($errors->has('nama'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nama') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>(DURASI) Menit</label>
                            <input type="number" id="durasiMenit" class="form-control input-md" placeholder="60" name="menit"  value="{{ $group ? floor($group->durasi/60) : (old('menit') | 0) }}" required>
                            @if($errors->has('menit'))
                            <span class="help-block">
                                <strong>{{ $errors->first('menit') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>Detik</label>
                            <input type="number" id="durasiDetik" class="form-control input-md" placeholder="60" name="detik"  value="{{ $group ? $group->durasi%60 : (old('detik') | 0) }}" required>
                            @if($errors->has('detik'))
                            <span class="help-block">
                                <strong>{{ $errors->first('detik') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <button type="submit"  class="btn btn-primary btn-fill btn-lg btn-rounded">Simpan</button>
            </div>
        </div>
    </div>
</form>
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
