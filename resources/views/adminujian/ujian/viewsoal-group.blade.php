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
    <span v-if="isMounted">SOAL NO: @{{ noSoal }}</span>
    <span v-if="!isMounted">Loading Soal...</span>
</span>
<btn class="btn btn-default btn-md pull-right font-soal btn-icon text-success" data-toggle="modal" data-target="#modalPeraturan"><i class="mdi mdi-settings"></i>Peraturan</btn>
<div class="" v-show="isMounted">
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
    </div>
</div>
<div class="modal fade" id="modalPeraturan" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
                <h4 class="modal-title">Peraturan {{ $ujian->judul }}</h4>
            </div>
            <div class="modal-body">
                {!! $ujian->peraturan !!}
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
        <div v-for="group in groups" class="mb-4">
            <div class="breadcrumb mb-2">
                @{{ group.nama }}
            <span class="pull-right">@{{ group.waktu }}</span>
            </div>
            <button class="btn btn-default btn-sm btn-soal" v-for="(soal, index) in group.soal.length" v-bind:class="[{'btn-select': (group.no_start+index == noSoal)}]">
                <span class="flex" @click="changeSoal(group.no_start+index-1)"><span>@{{ group.no_start+index }}</span></span>
            </button>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
var ujianId = "{{ $ujian->id }}";
var linkRequestSoal = "{{ route('admin.ujian.soal.req.soal', ':id') }}";
linkRequestSoal = linkRequestSoal.replace(':id', ujianId);
var app = new Vue({
    el: '#app',
    data: {
        message: ujianId,
        soals: [],
        soal: {},
        noSoal: 0,
        indexSoal: 0,
        groups: [],
        group: {},
        jumlahBarisNomor: 0,
        jumlahSoal: 0,
        isErrorExist: false,
        errorMessage: null,
        isMounted: false
    },
    methods: {
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
            }
            $("#btnNext").attr("disabled", false);
            $("#btnHapus").attr("disabled", false);
        },
        nextSoal: function() {
            this.changeSoal(this.indexSoal+1);
        },
        changeSoal: function(index) {
            this.getSoal(index);
        },
        reqSoal: function() {
            var self = this;
            var url = linkRequestSoal;
            axios({
                method: 'get',
                url: url,
                headers: {}
            })
            .then(function(response) {
                if(response.data.success){
                    self.isMounted = true;
                    self.groups = response.data.data;
                    for(var i=0; i<self.groups.length; i++){
                        self.soals = self.soals.concat(self.groups[i].soal);
                        if(self.groups[i].is_finished == 0){
                            self.group = self.groups[i];
                            self.jumlahSoal = self.soals.length;
                            break;
                        }
                    }
                    self.soal = self.soals[0];
                    self.noSoal = 1;
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
</script>
@endsection
