@extends('layouts.adminaside')

@section('title')
Ujian Matematika
@endsection

@section('content')
<div role="alert" class="alert alert-danger alert-icon alert-icon-border alert-dismissible" v-bind:class="{'hide': !isErrorExist}">
    <div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
    <div class="message">
        <button type="button" @click="clearError" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button>
        @{{ errorMessage }}
    </div>
</div>
<span class="label label-default label-md label-space font-soal">SOAL NO: @{{ noSoal }}</span>
<span class="label label-default label-md pull-right label-icon font-soal"><i class="mdi mdi-time-countdown"></i><span id="timer"></span></span>
<btn class="btn btn-default btn-md pull-right font-soal btn-space btn-icon text-success" data-toggle="modal" data-target="#modalPeraturan"><i class="mdi mdi-settings"></i>Peraturan</btn>
<div class="panel panel-default">
    <div class="panel-body font-soal" v-html="soal.soal"></div>
</div>
<div class="panel panel-default">
    <div class="panel-body font-soal">
        <div class="jawaban mb-5">
            <input id="jawabanA" type="radio" value="a" name="jawaban" v-model="soal.jawaban">
            <label for="jawabanA"><strong>A.</strong> @{{ soal.a }}</label>
            <input id="jawabanB" type="radio" value="b" name="jawaban" v-model="soal.jawaban">
            <label for="jawabanB"><strong>B.</strong> @{{ soal.b }}</label>
            <input id="jawabanC" type="radio" value="c" name="jawaban" v-model="soal.jawaban">
            <label for="jawabanC"><strong>C.</strong> @{{ soal.c }}</label>
            <input id="jawabanD" type="radio" value="d" name="jawaban" v-model="soal.jawaban">
            <label for="jawabanD"><strong>D.</strong> @{{ soal.d }}</label>
            <input id="jawabanE" type="radio" value="e" name="jawaban" v-model="soal.jawaban">
            <label for="jawabanE"><strong>E.</strong> @{{ soal.e }}</label>
        </div>
        <button type="button" id="btnNext" @click="nextSoal" class="btn btn-primary btn-sm btn-icon" name="button"><i class="mdi mdi-arrow-right"></i>Lanjutkan</button>
        <button type="button" @click="hapusJawaban" class="btn btn-default btn-sm btn-icon pull-right" v-bind:class="{'disabled': soal.jawaban == null}" name="button"><i class="mdi mdi-close"></i>Hapus Jawaban</button>
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
    <div class="col-md-12 mb-3">
        <a href="{{ route('member.ujian.soal.finish', $attempt->id)}}" class="btn btn-success btn-block">SELESAI</a>
    </div>
    <div class="col-md-12 mb-3">
        <div class="btn-soal-group" v-for="(baris, index) in jumlahBarisNomor" :key="index">
            <button href="#" class="btn btn-sm btn-soal" v-bind:class="[{'btn-select': (index*5)+no == noSoal-1}, soals[(index*5)+no].jawaban == null ? 'btn-default' : 'btn-warning']" v-bind:class="" v-for="(soal, no) in soals.slice(index, index == jumlahBarisNomor-1 ? index+(jumlahSoal%5) : index+5)">
                <span class="flex" @click="changeSoal((index*5)+no)"><span>@{{ (index*5)+no+1 }}</span></span>
            </button>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
var ujianId = "{{ $soal->id }}";
var attemptId = "{{ $attempt->id }}";
var linkRequestSoal = "{{ route('member.ujian.attempt.request.soal', ':id') }}";
linkRequestSoal = linkRequestSoal.replace(':id', ujianId);
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
        errorMessage: null
    },
    methods: {
        clearError: function(){
            this.isErrorExist = false;
            this.errorMessage = null;
        },
        getSoal: function(index) {
            if(index < this.soals.length) {
                var self = this;
                self.soal = self.soals[index];
                self.noSoal = index+1;
                self.indexSoal = index;
                self.jawaban = self.soal.jawaban;
            }
        },
        nextSoal: function() {
            if(this.soal.jawaban != null) {
                this.sendJawaban();
            }
            else {
                this.changeSoal(this.indexSoal+1);
            }
        },
        hapusJawaban: function() {
            if(this.jawaban == null)
                this.changeSoal(this.indexSoal+1);
            else {
                this.soal.jawaban = null;
                this.sendJawaban();
            }
        },
        changeSoal: function(index) {
            this.soal.jawaban = this.jawaban;
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
    document.getElementById("timer").innerHTML = "WAKTU TERSISA " +  hours + ":" + minutes + ":" + seconds;
    if (distance < 0) {
        location.reload();
        clearInterval(x);
        document.getElementById("timer").innerHTML = "EXPIRED";
    }
}, 1000);
</script>
@endsection
