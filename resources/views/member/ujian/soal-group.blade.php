@extends('layouts.adminaside')

@section('title')
{{ $ujian->judul }}
@endsection

@section('content')
<div class="page-loader"></div>
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
            <h3>Apakah Anda ingin menyelesaikan ujian @{{ group.nama }}?</h3>
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
            <button id="btnNextGroup" class="btn btn-primary next-group" v-if="(indexGroup+1) < groups.length">Lanjutkan ke Ujian @{{ groups[indexGroup+1].nama }}</button>
            @if(isset($simulasi))
            <a href="{{ route('member.simulasi.ujian.finish', ['id' => $simulasi->id, 'idAttempt' => $attempt->id])}}" class="btn btn-success selesai-ujian" v-if="(indexGroup+1) >= groups.length">SELESAIKAN SEKARANG</a>
            @else
            <a href="{{ route('member.ujian.soal.finish', $attempt->id)}}" class="btn btn-success selesai-ujian" v-if="(indexGroup+1) >= groups.length">SELESAIKAN SEKARANG</a>
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
    <div class="col-md-12 mb-3" v-if="isMounted">
        <div v-for="group in groups" class="mb-4">
            <div class="breadcrumb mb-2" v-bind:class="[{'text-success': group.id_attempt_group == groups[indexGroup].id_attempt_group}]">
                @{{ group.nama }}
                <span class="pull-right">@{{ group.waktu }}</span>
            </div>
            <div class="nosoal-wrap">
                <div class="nosoal">
                    <button class="btn btn-sm btn-soal" v-for="(soal, index) in group.soal.length" v-bind:class="[{'btn-select': (group.no_start+index == noSoal) && !isFinish && (group.id_attempt_group == groups[indexGroup].id_attempt_group)}, group.soal[index].jawaban == null ? 'btn-default' : 'btn-warning btn-filled', {'no-clickable disabled': group.id_attempt_group != groups[indexGroup].id_attempt_group}]">
                        <span class="flex" @click="changeSoal(index)"><span>@{{ group.no_start+index }}</span></span>
                    </button>
                </div>
            </div>
            <div class="text-sm-left text-md-center">
                <button id="btnNextGroup" class="btn btn-default btn-rounded next-group" style="margin-top: 10px; padding: 0 15px;" v-if="(group.id_attempt_group == groups[indexGroup].id_attempt_group) && ((indexGroup+1) < groups.length)">Lanjut ke Soal Berikutnya</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/id.js"></script>
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
        noSoalLoop: 0,
        indexSoal: 0,
        groups: [],
        group: {},
        indexGroup: 0,
        jumlahBarisNomor: 0,
        jumlahSoal: 0,
        jawaban: null,
        isErrorExist: false,
        errorMessage: null,
        isFinish: false,
        isMounted: false,
        interval: null
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
                self.noSoal = self.group.no_start+index;
                self.indexSoal = index;
                self.jawaban = self.soal.jawaban;
            }
            $("#btnNext").attr("disabled", false);
            $("#btnHapus").attr("disabled", false);
        },
        nextGroup: function() {
            var self = this;
            if(self.soal.jawaban != null)
                self.sendJawaban();
            var url = "{{ route('member.ujian.attempt.next.group') }}";
            $("#btnNextGroup").attr("disabled", true);
            axios({
                method: 'post',
                url: url,
                data: {
                    "idAttempt": attemptId,
                    "idAttemptGroupNow": self.group.id_attempt_group,
                    "idAttemptGroupNext": self.groups[self.indexGroup+1].id_attempt_group
                },
                headers: {}
            })
            .then(function(response) {
                var data = response.data;
                if(data.success) {
                    console.log(data.data);
                    self.indexGroup += 1;
                    self.group = self.groups[self.indexGroup];
                    self.group.end_attempt = data.data.end_attempt;
                    self.soals = self.group.soal;
                    self.jumlahSoal = self.soals.length;
                    self.indexSoal = 0;
                    self.soal = self.soals[0];
                    self.noSoal = self.group.no_start;
                    self.isFinish = false;
                    clearInterval(self.interval);
                    self.setTimer();
                }
                else {
                    self.isErrorExist = true;
                    self.errorMessage = data.message;
                }
                $("#btnNextGroup").attr("disabled", false);
            })
            .catch(function(error) {
                console.log(error);
            });
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
        setTimer: function() {
            var self = this;
            self.interval = setInterval(function() {
                var countDownDate = moment(self.group.end_attempt, 'YYYY-MM-DD HH:mm:ss').toDate();
                var now = new Date().getTime();
                var distance = countDownDate - now;
                console.log(countDownDate);
                var days    = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours   = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                document.getElementById("timer").innerHTML = "WAKTU " +  hours + ":" + minutes + ":" + seconds;
                if (distance < 0) {
                    clearInterval(self.interval);
                    if((self.indexGroup+1) < self.groups.length){
                        self.indexGroup += 1;
                        self.group = self.groups[self.indexGroup];
                        self.soals = self.group.soal;
                        self.jumlahSoal = self.soals.length;
                        self.indexSoal = 0;
                        self.soal = self.soals[0];
                        self.noSoal = self.group.no_start;
                        self.isFinish = false;
                        self.setTimer();
                    }
                    else {
                        window.location = linkFinish;
                        document.getElementById("timer").innerHTML = "EXPIRED";
                    }
                }
            }, 1000);
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
                    self.groups = response.data.data;
                    for(var i=0; i<self.groups.length; i++){
                        if(self.groups[i].is_finished == 0){
                            self.group = self.groups[i];
                            self.indexGroup = i;
                            self.soals = self.groups[i].soal;
                            self.jumlahSoal = self.soals.length;
                            self.soal = self.soals[0];
                            self.noSoal = self.group.no_start;
                            break;
                        }
                    }
                    self.indexSoal = 0;
                    self.jawaban = self.soal.jawaban;
                    self.jumlahBarisNomor = self.soals.length%5 == 0 ? Math.floor(self.soals.length/5) : (Math.floor(self.soals.length/5)) + 1;
                    self.setTimer();
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
$(document).on("click", ".next-group", function(e) {
    e.preventDefault();
    swal({
        title: "Ingin ke Soal Berikutnya?",
        text: "Anda yakin ingin melanjutkan ke soal berikutnya? Anda tidak bisa lagi mengubah jawaban pada soal yang sekarang",
        type: "success",
        showCancelButton: true,
        confirmButtonClass: "btn btn-danger btn-fill",
        confirmButtonText: "Ya!",
        cancelButtonClass: "btn btn-danger btn-fill",
        cancelButtonText: "Tidak!"
    }).then((result) => {
        if (result.value) {
            app.nextGroup();
        }
    });
});
</script>
@endsection
