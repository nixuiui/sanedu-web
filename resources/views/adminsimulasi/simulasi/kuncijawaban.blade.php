@extends('layouts.admin')

@section('title')
Kunci Jawaban Simulasi
@endsection

@section('content')
<a href="{{ route('adminsimulasi.simulasi.kelola', $simulasi->id) }}" class="btn btn-md btn-default btn-space btn-icon"><i class="mdi mdi-arrow-left"></i>Kembali</a>
<div class="btn-group btn-space">
    <button type="button" data-toggle="dropdown" class="btn btn-md btn-default dropdown-toggle">
        {{ isset($ujianSelected) ? $ujianSelected->mapel->nama : "Pilih Mata Pelajaran" }}
        <span class="icon-dropdown mdi mdi-chevron-down"></span>
    </button>
    <ul role="menu" class="dropdown-menu">
        @foreach($simulasiUjian as $data)
            <li><a href="{{ route('adminsimulasi.simulasi.kelola.kunci.jawaban', ['id' => $simulasi->id, 'idMapel' => $data->id_mapel]) }}">{{ $data->mapel->nama }}</a></li>
        @endforeach
    </ul>
</div>
@if(isset($ujianSelected))
<div class="alert alert-warning alert-icon alert-icon-border alert-dismissible" role="alert">
    <div class="icon"><span class="mdi mdi-mail-send"></span></div>
    <div class="message">
        <p>
            Perhatikan jumlah <strong>Soal Online</strong> dan <strong>Kunci Jawaban Soal Offline</strong> yang diinput HARUS SAMA
        </p>
    </div>
</div>

    @if($ujianSelected->id_ujian)
        @if($ujianSelected->ujian->soal->count() != $simulasi->kunciJawaban->where('id_mapel', $ujianSelected->id_mapel)->count())
        <div class="alert alert-danger alert-icon alert-icon-border alert-dismissible" role="alert">
            <div class="icon"><span class="mdi mdi-mail-send"></span></div>
            <div class="message">
                <p>
                    Mohon maaf tolong cocokan kunci jawaban untuk soal offline dan online. <br>
                    Saat ini jumlah Soal Online <strong>{{ $ujianSelected->ujian->soal->count() }} soal</strong> dan jumlah Kunci Jawaban untuk Soal Offline <strong>{{ $simulasi->kunciJawaban->where('id_mapel', $ujianSelected->id_mapel)->count() }} soal</strong>
                </p>
            </div>
        </div>
        @endif
    @endif

<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">Soal dan Pembahasan</div>
            <div class="panel-body">
                <form class="mb-3" action="{{ route('adminsimulasi.simulasi.kelola.link.soal.post', ['id' => $simulasi->id, 'idMapel' => $ujianSelected->id_mapel]) }}" method="post">
                    @csrf
                    <input type="hidden" name="id_mapel" value="{{ $ujianSelected->id_mapel }}">
                    <div class="form-group">
                        <label>Link Soal</label>
                        <input type="url" class="form-control input-sm" placeholder="http://www.linksoal.com" name="link_soal"  value="{{ $ujianSelected->link_soal }}">
                        @if($errors->has('link_soal'))
                        <span class="help-block">
                            <strong>{{ $errors->first('link_soal') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Link Pembahasan</label>
                        <input type="url" class="form-control input-sm" placeholder="http://www.linkpembahasan.com" name="link_pembahasan"  value="{{ $ujianSelected->link_pembahasan }}">
                        @if($errors->has('link_pembahasan'))
                        <span class="help-block">
                            <strong>{{ $errors->first('link_pembahasan') }}</strong>
                        </span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary btn-md mt-3" v-if="isFinish && isMounted">Simpan</button>
                </form>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Soal Ujian Online</div>
            <div class="panel-body">
                <form class="mb-3" action="{{ route('adminsimulasi.simulasi.kelola.taut.soal', $simulasi->id) }}" method="post">
                    @csrf
                    <input type="hidden" name="id_mapel" value="{{ $ujianSelected->id_mapel }}">
                    <select class="form-control input-sm select2" name="id_ujian">
                        <option value="">-- Pilih Soal Untuk Ditautkan --</option>
                        @foreach($ujian as $data)
                        <option value="{{ $data->id }}" {{ $ujianSelected != null ? ($data->id == $ujianSelected->id_ujian ? "selected" : "") : "" }}>{{ strtoupper($data->judul) }} [<strong>{{ $data->soal->count() }} soal</strong>]</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-md btn-primary btn-block mt-3" v-if="isFinish && isMounted">TAUTKAN SOAL UNTUK {{ $ujianSelected->mapel->nama }}</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <a href="{{ route('adminsimulasi.simulasi.kelola.koreksi', ['id' => $simulasi->id, 'idMapel' => $ujianSelected->id_mapel]) }}" class="btn btn-vspace btn-block btn-sm btn-success mb-3"><i class="icon icon-left mdi mdi-assignment-check mr-3"></i>Koreksi</a>
        <form action="{{ route('adminsimulasi.simulasi.kelola.kunci.jawaban.post', $simulasi->id) }}" method="post">
            @csrf
            <input type="hidden" name="id_mapel" value="{{ $ujianSelected->id_mapel }}">
            <div class="input-group input-group-sm xs-mb-15">
                <span class="input-group-addon">Jumlah Soal</span>
                <input type="text" name="jumlahSoal" placeholder="0" class="form-control" v-model="jumlahSoal">
            </div>
            <div class="panel panel-table">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th colspan="7" class="text-center">
                                {{ $ujianSelected->mapel->nama }}
                            </th>
                        </tr>
                        <tr>
                            <th width="20px">NO</th>
                            <th width="70px">INPUT</th>
                            <th class="text-center">A</th>
                            <th class="text-center">B</th>
                            <th class="text-center">C</th>
                            <th class="text-center">D</th>
                            <th class="text-center">E</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if="jumlahSoal > 0">
                            <td colspan="7">
                                <button type="submit" class="btn btn-md btn-primary btn-block" v-if="isFinish && isMounted">SIMPAN KUNCI JAWABAN SOAL OFFLINE</button>
                                <button type="button" class="btn btn-md btn-primary btn-block disabled" v-if="!isFinish || !isMounted">Loading</button>
                            </td>
                        </tr>
                        <tr v-for="(no, index) in intSoal">
                            <td>@{{ no }}</td>
                            <td><input type="text" pattern="[a-eA-E]{1}" class="form-control input-xs text-center" name="jawaban[]" v-model="jawaban[index]" required/></td>
                            <td class="text-center"><i class="mdi mdi-check-circle text-16" v-bind:class="{'text-success': jawaban[index] == 'a' || jawaban[index] == 'A', 'text-muted': jawaban[index] != 'a' && jawaban[index] != 'A'}"></i></td>
                            <td class="text-center"><i class="mdi mdi-check-circle text-16" v-bind:class="{'text-success': jawaban[index] == 'b' || jawaban[index] == 'B', 'text-muted': jawaban[index] != 'b' && jawaban[index] != 'B'}"></i></td>
                            <td class="text-center"><i class="mdi mdi-check-circle text-16" v-bind:class="{'text-success': jawaban[index] == 'c' || jawaban[index] == 'C', 'text-muted': jawaban[index] != 'c' && jawaban[index] != 'C'}"></i></td>
                            <td class="text-center"><i class="mdi mdi-check-circle text-16" v-bind:class="{'text-success': jawaban[index] == 'd' || jawaban[index] == 'D', 'text-muted': jawaban[index] != 'd' && jawaban[index] != 'D'}"></i></td>
                            <td class="text-center"><i class="mdi mdi-check-circle text-16" v-bind:class="{'text-success': jawaban[index] == 'e' || jawaban[index] == 'E', 'text-muted': jawaban[index] != 'e' && jawaban[index] != 'E'}"></i></td>
                        </tr>
                        <tr v-if="jumlahSoal > 0">
                            <td colspan="7">
                                <button type="submit" class="btn btn-md btn-primary btn-block" v-if="isFinish && isMounted">SIMPAN KUNCI JAWABAN SOAL OFFLINE</button>
                                <button type="button" class="btn btn-md btn-primary btn-block disabled" v-if="!isFinish || !isMounted">Loading</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <div class="col-md-4">
        <div class="panel panel-table">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th colspan="7" class="text-center">
                            Karakteristik Soal
                        </th>
                    </tr>
                    <tr>
                        <th width="20px">NO</th>
                        <th width="80px">SOAL</th>
                        <th colspan="5">Jumlah Benar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kunciJawaban as $key => $data)
                    <?php
                    $percent = $data->jumlah_benar == 0 ? 0 : (($data->jumlah_benar/$kunciJawaban->max("jumlah_benar")) * 100);
                    $classKriteria = null;
                    if($data->kriteria == 'mudah') {
                        $classKriteria = 'primary';
                    }
                    else if($data->kriteria == 'sedang') {
                        $classKriteria = 'warning';
                    }
                    else {
                        $classKriteria = 'danger';
                    }
                    ?>
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $data->no }}</td>
                        <td class="milestone" colspan="5">
                            <span class="completed">{{ $data->kriteria }}</span>
                            <span class="version">{{ $data->jumlah_benar }}</span>
                            <div class="progress">
                                <div style="width: {{ $percent }}%" class="progress-bar progress-bar-{{ $classKriteria }}"></div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <script>
            $(document).ready(function() {
                $(".bar-soal").css("width", function() {
                    return $(this).data('percent');
                });
            });
            </script>
        </div>
    </div>
</div> <!-- end row -->
@endif
@endsection

@section('script')

@if(isset($ujianSelected))
<script type="text/javascript">
var idSimulasi = "{{ $simulasi->id }}";
var linkReqKunciJawaban = "{{ route('adminsimulasi.simulasi.kelola.req.kunci.jawaban', ['id' => ':id', 'idMapel' => ':idMapel']) }}";
linkReqKunciJawaban = linkReqKunciJawaban.replace(':id', idSimulasi);
var app = new Vue({
el: "#app",
data: {
    isMounted: false,
    isFinish: true,
    isErrorExist: false,
    errorMessage: null,
    jumlahSoal: null,
    jawaban: [],
},
computed: {
    intSoal: function () {
        if(!this.jumlahSoal)
            return 0;
        return parseInt(this.jumlahSoal)
    }
},
methods: {
    reqKunciJawaban: function() {
        var self = this;
        var url = linkReqKunciJawaban;
        url = url.replace(':idMapel', '{{ $ujianSelected->id_mapel }}');
        axios({
            method: 'get',
            url: url,
            headers: {}
        })
        .then(function(response) {
            if(response.data.success){
                self.isMounted = true;
                response.data.data.forEach(function(val, index, arr) {
                    self.jawaban.push(val.jawaban);
                });
                self.jumlahSoal = response.data.data.length;
            }
            else {
                self.isMounted = true;
                self.isErrorExist = true;
                self.errorMessage = response.data.message;
            }
        })
        .catch(function(error) {
            console.log(error);
        });
    }
},
mounted: function() {
    this.reqKunciJawaban();
}
});
</script>
@endif
@endsection
