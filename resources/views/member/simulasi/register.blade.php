@extends('layouts.admin')

@section('title')
Simulasi {{ $simulasi->judul }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-4">
        @if(!isset($_GET['pin']) && !isset($_GET['kap']))
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
        @else
        <div class="panel panel-default">
            <div class="panel-heading">
                Pilihan Passing Grade
            </div>
            <div class="panel-body">
                <form class="form-horizontal" action="{{ route('member.simulasi.register.post', $simulasi->id)}}" method="post">
                    @csrf
                    <input type="hidden" name="pin" value="{{ $tiket->pin }}">
                    <input type="hidden" name="kap" value="{{ $tiket->kap }}">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">PILIHAN SIMULASI</label>
                        <div class="col-sm-9">
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
                        <label class="col-sm-3 control-label">JURUSAN</label>
                        <div class="col-sm-9">
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
                    <button type="submit" class="btn btn-sm btn-primary btn-block">Daftar</button>
                </form>
            </div>
        </div>
        @endif
    </div>
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
@endsection
