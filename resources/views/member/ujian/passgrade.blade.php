@extends('layouts.admin')

@section('title')
Ujian
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Pilihan Ujian SBMPTN
            </div>
            <div class="panel-body">
                <form class="form-horizontal" action="{{ route('member.ujian.soal.sbmptn.passgrade.post', $ujian->id)}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="col-sm-3 control-label">JURUSAN</label>
                        <div class="col-sm-9">
                            <div class="be-radio inline">
                                <input type="radio" name="jurusan" id="ipa" value="1504" checked>
                                <label for="ipa">IPA</label>
                            </div>
                            <div class="be-radio inline">
                                <input type="radio" name="jurusan" id="ips" value="1505">
                                <label for="ips">IPS</label>
                            </div>
                            <div class="be-radio inline">
                                <input type="radio" name="jurusan" id="ipc" value="1506">
                                <label for="ipc">IPC</label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h6><strong>PILIHAN 1</strong></h6>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">UNIVERSITAS</label>
                        <div class="col-sm-9">
                            <select id="univ1" class="select2 input-univ input-sm" name="univ_1" data-parseto="jurusan_1">
                                <option value="">Pilih Universitas</option>
                                @foreach($universitas as $data)
                                <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">JURUSAN</label>
                        <div class="col-sm-9">
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
                        <label class="col-sm-3 control-label">UNIVERSITAS</label>
                        <div class="col-sm-9">
                            <select id="univ2" class="select2 input-univ input-sm" data-parseto="jurusan_2">
                                <option value="">Pilih Universitas</option>
                                @foreach($universitas as $data)
                                <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">JURUSAN</label>
                        <div class="col-sm-9">
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
                        <label class="col-sm-3 control-label">UNIVERSITAS</label>
                        <div class="col-sm-9">
                            <select id="univ3" class="select2 input-univ input-sm" data-parseto="jurusan_3">
                                <option value="">Pilih Universitas</option>
                                @foreach($universitas as $data)
                                <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">JURUSAN</label>
                        <div class="col-sm-9">
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
                    <button type="submit" class="btn btn-sm btn-primary">Mulai Ujian</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
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
@endsection
