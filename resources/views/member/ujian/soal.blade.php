@extends('layouts.adminaside')

@section('title')
{{ $ujian->judul }}
@endsection

@section('content')
<div role="alert" class="alert alert-danger alert-icon alert-icon-border alert-dismissible" v-bind:class="{'hide': !isErrorExist}">
    <div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
    <div class="message">
        <button type="button" @click="clearError" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button>
        @{{ errorMessage }}
    </div>
</div>
<span class="label label-default label-md label-space font-soal">
    <span v-if="!isFinish && isMounted">SOAL NO: @{{ noSoal }}</span>
    <span v-if="isFinish && isMounted">SELESAI UJIAN</span>
    <span v-if="!isMounted">Loading Soal...</span>
</span>
<span class="label label-default label-md pull-right label-icon font-soal"><i class="mdi mdi-time-countdown"></i><span id="timer"></span></span>
<btn class="btn btn-default btn-md pull-right font-soal btn-space btn-icon text-success" data-toggle="modal" data-target="#modalPeraturan"><i class="mdi mdi-settings mr-0"></i><span class="ml-3 hidden-xs">Peraturan</span></btn>
<div class="" v-show="!isFinish && isMounted">
    <div class="panel panel-default">
        <div class="panel-body font-soal" v-html="soal.soal"></div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body font-soal">
            <div class="jawaban mb-5">
                <input id="jawabanA" type="radio" value="a" name="jawaban" v-model="soal.jawaban">
                <label for="jawabanA"><strong class="label-pilihan">A.</strong> <div v-html="soal.a"> </div></label>
                <input id="jawabanB" type="radio" value="b" name="jawaban" v-model="soal.jawaban">
                <label for="jawabanB"><strong class="label-pilihan">B.</strong> <div v-html="soal.b"> </div></label>
                <input id="jawabanC" type="radio" value="c" name="jawaban" v-model="soal.jawaban">
                <label for="jawabanC"><strong class="label-pilihan">C.</strong> <div v-html="soal.c"> </div></label>
                <input id="jawabanD" type="radio" value="d" name="jawaban" v-model="soal.jawaban">
                <label for="jawabanD"><strong class="label-pilihan">D.</strong> <div v-html="soal.d"> </div></label>
                <input id="jawabanE" type="radio" value="e" name="jawaban" v-model="soal.jawaban">
                <label for="jawabanE"><strong class="label-pilihan">E.</strong> <div v-html="soal.e"> </div></label>
            </div>
            <button type="button" id="btnNext" @click="nextSoal" class="btn btn-primary btn-sm btn-icon" name="button"><i class="mdi mdi-arrow-right"></i>Lanjutkan</button>
            <button type="button" id="btnHapus" @click="hapusJawaban" class="btn btn-default btn-sm btn-icon pull-right" v-bind:class="{'disabled': soal.jawaban == null}" name="button"><i class="mdi mdi-close"></i>Hapus Jawaban</button>
        </div>
    </div>
</div>
<div class="" v-show="isFinish && isMounted">
    <div class="panel panel-default">
        <div class="panel-body text-center">
            <h3>Apakah Anda ingin menyelesaikan ujian?</h3>
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <table class="table table-condensed table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="5px" class="text-center">No</th>
                                <th class="text-center">Jawaban</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(soal, index) in soals">
                                <td>@{{ index+1 }}</td>
                                <td>@{{ soal.jawaban == null ? "-" : soal.jawaban }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @if(isset($simulasi))
            <a href="{{ route('member.simulasi.ujian.finish', ['id' => $simulasi->id, 'idAttempt' => $attempt->id])}}" class="btn btn-success">SELESAIKAN SEKARANG</a>
            @else
            <a href="{{ route('member.ujian.soal.finish', $attempt->id)}}" class="btn btn-success">SELESAIKAN SEKARANG</a>
            @endif
        </div>
    </div>
</div>
<div class="modal fade" id="modalPeraturan" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
                <h4 class="modal-title">Peraturan {{ $attempt->ujian->judul }}</h4>
            </div>
            <div class="modal-body">
                {!! $attempt->ujian->peraturan !!}
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-default btn-fill btn-sm" data-dismiss="modal">Keluar</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content-side')
<div class="row">
    <div class="col-md-12">
        <p class="text" v-if="!isMounted">Sedang Load Soal...</p>
    </div>
    <div class="col-md-12 mb-3" v-if="isMounted">
        @if(isset($simulasi))
        <a href="{{ route('member.simulasi.ujian.finish', ['id' => $simulasi->id, 'idAttempt' => $attempt->id])}}" class="btn btn-success btn-block selesai-ujian">SELESAIKAN SEKARANG</a>
        @else
        <a href="{{ route('member.ujian.soal.finish', $attempt->id)}}" class="btn btn-success btn-block selesai-ujian">SELESAIKAN SEKARANG</a>
        @endif
    </div>
    <div class="col-md-12 mb-3 nosoal-wrap" v-if="isMounted">
        <div class="nosoal">
            <button href="#" class="btn btn-sm btn-soal" v-for="(soal, no) in (jumlahSoal)" v-bind:class="[{'btn-select': (no == noSoal-1) && !isFinish}, soals[no].jawaban == null ? 'btn-default' : 'btn-warning btn-filled']" v-bind:class="">
                <span class="flex" @click="changeSoal(no)"><span>@{{ no+1 }}</span></span>
            </button>
        </div>
        {{-- <div class="btn-soal-group" v-for="(baris, index) in jumlahBarisNomor" :key="index">
            <button href="#" class="btn btn-sm btn-soal" v-for="(soal, no) in (index+1 < jumlahBarisNomor ? 5 : (jumlahSoal%5 == 0 ? 5 : jumlahSoal%5))" v-bind:class="[{'btn-select': ((index*5)+no == noSoal-1) && !isFinish}, soals[(index*5)+no].jawaban == null ? 'btn-default' : 'btn-warning btn-filled']" v-bind:class="">
                <span class="flex" @click="changeSoal((index*5)+no)"><span>@{{ (index*5)+no+1 }}</span></span>
            </button>
        </div> --}}
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
var ujianId = "{{ $ujian->id }}";
var attemptId = "{{ $attempt->id }}";
var linkRequestSoal = "{{ route('member.ujian.attempt.request.soal', ':id') }}";
linkRequestSoal = linkRequestSoal.replace(':id', ujianId);
@if(isset($simulasi))
var simulasiId = "{{ $simulasi->id }}";
var linkFinish = "{{ route('member.simulasi.ujian.finish', ['id' => ':id', 'idAttempt' => ':idAttempt'])}}";
linkFinish = linkFinish.replace(':id', simulasiId);
linkFinish = linkFinish.replace(':idAttempt', attemptId);
@else
var linkFinish = "{{ route('member.ujian.soal.finish', ':id') }}";
linkFinish = linkFinish.replace(':id', attemptId);
@endif
var app = new Vue({
    el: '#app',
    data: {
        message: ujianId,
        soals: [],
        soal: {},
        noSoal: 0,
        indexSoal: 0,
        jumlahBarisNomor: 0,
        jumlahSoal: 0,
        jawaban: null,
        isErrorExist: false,
        errorMessage: null,
        isFinish: false,
        isMounted: false
    },
    methods: {
        finish: function() {
            this.isFinish = true;
        },
        clearError: function(){
            this.isErrorExist = false;
            this.errorMessage = null;
        },
        getSoal: function(index) {
            window.scrollTo(0, 0);
            if(index < this.soals.length) {
                var self = this;
                self.soal = self.soals[index];
                self.noSoal = index+1;
                self.indexSoal = index;
                self.jawaban = self.soal.jawaban;
            }
            $("#btnNext").attr("disabled", false);
            $("#btnHapus").attr("disabled", false);
        },
        nextSoal: function() {
            $("#btnNext").attr("disabled", true);
            if(this.indexSoal+1 == this.jumlahSoal){
                this.isFinish = true;
            }
            if(this.soal.jawaban != null) {
                this.sendJawaban();
            }
            else {
                this.changeSoal(this.indexSoal+1);
            }
        },
        hapusJawaban: function() {
            $("#btnHapus").attr("disabled", true);
            var index = this.indexSoal+1;
            if(this.indexSoal+1 == this.jumlahSoal) index = 0;
            if(this.jawaban == null)
                this.changeSoal(index);
            else {
                this.soal.jawaban = null;
                this.sendJawaban();
            }
        },
        changeSoal: function(index) {
            if(!this.isFinish) this.soal.jawaban = this.jawaban;
            this.isFinish = false;
            this.getSoal(index);
        },
        sendJawaban: function(){
            var self = this;
            var url = "{{ route('member.ujian.attempt.sendJawaban') }}";
            axios({
                method: 'post',
                url: url,
                data: {
                    "idAttempt": attemptId,
                    "idUjian": ujianId,
                    "idSoal": self.soal.id,
                    "jawaban": self.soal.jawaban
                },
                headers: {}
            })
            .then(function(response) {
                var data = response.data;
                if(data.success) {
                    self.getSoal(self.indexSoal+1);
                }
                else {
                    self.isErrorExist = true;
                    self.errorMessage = data.message;
                    $("#btnNext").attr("disabled", false);
                    $("#btnHapus").attr("disabled", false);
                }
            })
            .catch(function(error) {
                console.log(error);
            });
        },
        reqSoal: function() {
            var self = this;
            var url = linkRequestSoal + "?attempt=" + attemptId;
            axios({
                method: 'get',
                url: url,
                data: {
                    "idAttempt": attemptId
                },
                headers: {}
            })
            .then(function(response) {
                if(response.data.success){
                    self.isMounted = true;
                    self.soals = response.data.data;
                    self.soal = self.soals[0];
                    self.noSoal = 1;
                    self.indexSoal = 0;
                    self.jawaban = self.soal.jawaban;
                    self.jumlahSoal = self.soals.length;
                    self.jumlahBarisNomor = self.soals.length%5 == 0 ? Math.floor(self.soals.length/5) : (Math.floor(self.soals.length/5)) + 1;
                }
                else {
                    self.isErrorExist = true;
                    self.errorMessage = response.data.message;
                }
            })
            .catch(function(error) {
                console.log(error);
            });
        }
    },
    mounted: function () {
        this.reqSoal();
    }
});


var countDownDate = new Date('{{ date("Y-m-d H:i:s", strtotime($attempt->end_attempt)) }}').getTime();
var x = setInterval(function() {
    var now = new Date().getTime();
    var distance = countDownDate - now;
    var days    = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours   = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    document.getElementById("timer").innerHTML = "WAKTU " +  hours + ":" + minutes + ":" + seconds;
    if (distance < 0) {
        window.location = linkFinish;
        clearInterval(x);
        document.getElementById("timer").innerHTML = "EXPIRED";
    }
}, 1000);

$(document).on("click", ".selesai-ujian", function(e) {
    var link = $(this).attr("href");
    e.preventDefault();
    swal({
        title: "Ingin Selesaikan Ujian?",
        text: "Anda yakin ingin menyelesaikan ujian sekarang?",
        type: "success",
        showCancelButton: true,
        confirmButtonClass: "btn btn-danger btn-fill",
        confirmButtonText: "Ya!",
        cancelButtonClass: "btn btn-danger btn-fill",
        cancelButtonText: "Tidak!"
    }).then((result) => {
        if (result.value) {
            document.location.href = link;
        }
    });
});
</script>
@endsection
