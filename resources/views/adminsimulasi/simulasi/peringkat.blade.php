@extends('layouts.admin')
@section('title')
Proses Penentuan Peringkat Peserta
@endsection
@section('content')
<a href="{{ route('adminsimulasi.simulasi.kelola', $simulasi->id) }}" class="btn btn-default btn-icon btn-space"><i class="mdi mdi-arrow-back"></i>Kembali</a>
<button class="btn btn-primary btn-space" v-on:click="runFunction">Generate</button>
<div class="row">
    <div class="col-md-6">
        <div class="">
            <strong>Peserta Saintek (@{{ prosesSaintek.length }}/@{{ jumlahSaintek }})</strong>
        </div>
        <div v-for="(proses, index) in prosesSaintek">
            @{{ proses.no }} - @{{ proses.nama }} - Nilai: @{{ proses.nilai }} - Peringkat: @{{ proses.peringkat }}  - @{{ proses.message }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="">
            <strong>Peserta Soshum (@{{ prosesSoshum.length }}/@{{ jumlahSoshum }})</strong>
        </div>
        <div v-for="(proses, index) in prosesSoshum">
            @{{ proses.no }} - @{{ proses.nama }} - Nilai: @{{ proses.nilai }} - Peringkat: @{{ proses.peringkat }}  - @{{ proses.message }}
        </div>
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    var app = new Vue({
        el: "#app",
        data: {
            message: "Hello",
            pesertaSaintek: {!! $saintek !!},
            indexSaintek: 0,
            jumlahSaintek: {{ $saintek->count() }},
            prosesSaintek: [],
            pesertaSoshum: {!! $soshum !!},
            indexSoshum: 0,
            jumlahSoshum: {{ $soshum->count() }},
            prosesSoshum: []
        },
        methods: {
            peringkatSaintek: function(){
                var self = this;
                var peserta = this.pesertaSaintek[this.indexSaintek];
                var linkRequest = "{{ route('adminsimulasi.simulasi.kelola.generate.peringkat.proses', ['id' => ':id', 'idPeserta' => ':idPeserta']) }}?peringkat=" + (this.indexSaintek+1);
                linkRequest = linkRequest.replace(":id", "{{ $simulasi->id }}");
                linkRequest = linkRequest.replace(":idPeserta", peserta.id);
                this.prosesSaintek.push({
                    no: peserta.no_peserta,
                    nama: peserta.nama,
                    nilai: peserta.nilai_akhir,
                    peringkat: null,
                    message: "Sedang Dihitung"
                });
                axios({
                    method: 'get',
                    url: linkRequest,
                    headers: {}
                })
                .then(function(response) {
                    if(response.data.success){
                        self.prosesSaintek[self.indexSaintek].peringkat = response.data.peringkat;
                        self.prosesSaintek[self.indexSaintek].message = response.data.message;
                    }
                    else {
                        self.prosesSaintek[self.indexSaintek].peringkat = response.data.peringkat;
                        self.prosesSaintek[self.indexSaintek].message = response.data.message;
                    }
                    self.indexSaintek += 1;
                    if(self.indexSaintek <= self.pesertaSaintek.length) {
                        self.peringkatSaintek();
                    }
                })
                .catch(function(error) {
                    console.log(error);
                });
            },
            peringkatSoshum: function(){
                var self = this;
                var peserta = this.pesertaSoshum[this.indexSoshum];
                var linkRequest = "{{ route('adminsimulasi.simulasi.kelola.generate.peringkat.proses', ['id' => ':id', 'idPeserta' => ':idPeserta']) }}?peringkat=" + (this.indexSaintek+1);
                linkRequest = linkRequest.replace(":id", "{{ $simulasi->id }}");
                linkRequest = linkRequest.replace(":idPeserta", peserta.id);
                this.prosesSoshum.push({
                    no: peserta.no_peserta,
                    nama: peserta.nama,
                    nilai: peserta.nilai_akhir,
                    peringkat: null,
                    message: "Sedang Proses..."
                });
                axios({
                    method: 'get',
                    url: linkRequest,
                    headers: {}
                })
                .then(function(response) {
                    if(response.data.success){
                        self.prosesSoshum[self.indexSoshum].peringkat = response.data.peringkat;
                        self.prosesSoshum[self.indexSoshum].message = response.data.message;
                    }
                    else {
                        self.prosesSoshum[self.indexSoshum].peringkat = response.data.peringkat;
                        self.prosesSoshum[self.indexSoshum].message = response.data.message;
                    }
                    self.indexSoshum += 1;
                    if(self.indexSoshum <= self.pesertaSoshum.length) {
                        self.peringkatSoshum();
                    }
                })
                .catch(function(error) {
                    console.log(error);
                });
            },
            runFunction: function() {
                this.peringkatSoshum();
                this.peringkatSaintek();
            }
        },
        mounted: function() {
        }
    });
</script>
@endsection
