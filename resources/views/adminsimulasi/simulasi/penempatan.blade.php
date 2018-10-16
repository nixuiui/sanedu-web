@extends('layouts.admin')
@section('title')
Penempatan Peserta Simulasi
@endsection
@section('content')
<div role="alert" class="alert alert-danger alert-icon alert-icon-border alert-dismissible" v-bind:class="{'hide': !isErrorExist}">
    <div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
    <div class="message">
        <button type="button" @click="clearError" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button>
        @{{ errorMessage }}
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <button type="button" @click="reqPenempatan" v-if="isFinishGenerate && isMounted" class="btn btn-md btn-fill btn-primary btn-space btn-icon">Generate Penempatan</button>
        <button type="button" v-if="!isFinishGenerate || !isMounted" class="btn btn-md btn-fill btn-primary btn-space btn-icon disabled">Loading</button>

        <div class="panel panel-default panel-table">
            <div class="panel-body table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Ruang</th>
                            <th>Kursi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(ruang, i) in ruangs" v-bind:class="{'bg-warning': !isFinishGenerate && index == i}">
                            <td v-bind:class="{'text-bold': !isFinishGenerate && index == i}">@{{ ruang.nama }}</td>
                            <td v-bind:class="{'text-bold': !isFinishGenerate && index == i}">@{{ ruang.jumlah_peserta }}/@{{ ruang.kapasitas }} orang</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col-md-12 -->
</div> <!-- end row -->

@endsection

@section('script')
<script type="text/javascript">
var idSimulasi = "{{ $simulasi->id }}";
var linkRequestRuang = "{{ route('adminsimulasi.simulasi.kelola.request.ruang', ':id') }}";
linkRequestRuang = linkRequestRuang.replace(':id', idSimulasi);
var app = new Vue({
    el: "#app",
    data: {
        tes: "TES",
        ruangs: [],
        jumlahRuang: 0,
        isMounted: false,
        isFinishGenerate: true,
        isErrorExist: false,
        errorMessage: null,
        index: 0
    },
    methods: {
        clearError: function(){
            this.isErrorExist = false;
            this.errorMessage = null;
        },
        reqPenempatan: function() {
            this.isFinishGenerate = false;
            var self = this;
            var ruang = this.ruangs[this.index];
            var linkRequestPenempatan = "{{ route('adminsimulasi.simulasi.kelola.penempatan.proses', ['id' => ':id', 'idRuang' => ':idRuang', 'i' => ':i']) }}";
            linkRequestPenempatan = linkRequestPenempatan.replace(':id', idSimulasi);
            linkRequestPenempatan = linkRequestPenempatan.replace(':idRuang', ruang.id);
            linkRequestPenempatan = linkRequestPenempatan.replace(':i', this.index);
            axios({
                method: 'get',
                url: linkRequestPenempatan,
                headers: {}
            })
            .then(function(response) {
                if(response.data.success){
                    self.ruangs[response.data.data.index].jumlah_peserta = response.data.data.jumlah_peserta;
                    self.index += 1;
                    if(self.index < self.jumlahRuang)
                        self.reqPenempatan();
                    else {
                        self.isFinishGenerate = true;
                        self.index = 0;
                    }
                }
                else {
                    self.isErrorExist = true;
                    self.errorMessage = response.data.message;
                }
            })
            .catch(function(error) {
                console.log(error);
            });
        },
        reqRuang: function() {
            var self = this;
            var url = linkRequestRuang;
            axios({
                method: 'get',
                url: url,
                headers: {}
            })
            .then(function(response) {
                if(response.data.success){
                    self.isMounted = true;
                    self.ruangs = response.data.data;
                    self.jumlahRuang = self.ruangs.length;
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
        this.reqRuang();
    }
});
</script>
@endsection
