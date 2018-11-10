@extends('layouts.admin')
@section('title')
Proses Perhitungan Nilai Akhir
@endsection
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="">
            <strong>Peserta Saintek (@{{ prosesSaintek.length }}/@{{ jumlahSaintek }})</strong>
        </div>
        <div v-for="(proses, index) in prosesSaintek">
            @{{ proses.no }} - @{{ proses.nama }} - Nilai: @{{ proses.nilai }} - @{{ proses.message }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="">
            <strong>Peserta Saintek (@{{ prosesSoshum.length }}/@{{ jumlahSoshum }})</strong>
        </div>
        <div v-for="(proses, index) in prosesSoshum">
            @{{ proses.no }} - @{{ proses.nama }} - Nilai: @{{ proses.nilai }} - @{{ proses.message }}
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
            hitungPesertaSaintek: function(){
                var self = this;
                var peserta = this.pesertaSaintek[this.indexSaintek];
                var linkRequest = "{{ route('adminsimulasi.simulasi.kelola.hitung.nilai.akhir.proses', ['id' => ':id', 'idPeserta' => ':idPeserta']) }}";
                linkRequest = linkRequest.replace(":id", "{{ $simulasi->id }}");
                linkRequest = linkRequest.replace(":idPeserta", peserta.id);
                this.prosesSaintek.push({
                    no: peserta.no_peserta,
                    nama: peserta.nama,
                    nilai: null,
                    message: "Sedang Dihitung"
                });
                axios({
                    method: 'get',
                    url: linkRequest,
                    headers: {}
                })
                .then(function(response) {
                    if(response.data.success){
                        self.prosesSaintek[self.indexSaintek].nilai = response.data.nilai;
                        self.prosesSaintek[self.indexSaintek].message = response.data.message;
                    }
                    else {
                        self.prosesSaintek[self.indexSaintek].nilai = response.data.nilai;
                        self.prosesSaintek[self.indexSaintek].message = response.data.message;
                    }
                    self.indexSaintek += 1;
                    if(self.indexSaintek <= self.pesertaSaintek.length) {
                        self.hitungPesertaSaintek();
                    }
                })
                .catch(function(error) {
                    console.log(error);
                });
            },
            hitungPesertaSoshum: function(){
                var self = this;
                var peserta = this.pesertaSoshum[this.indexSoshum];
                var linkRequest = "{{ route('adminsimulasi.simulasi.kelola.hitung.nilai.akhir.proses', ['id' => ':id', 'idPeserta' => ':idPeserta']) }}";
                linkRequest = linkRequest.replace(":id", "{{ $simulasi->id }}");
                linkRequest = linkRequest.replace(":idPeserta", peserta.id);
                this.prosesSoshum.push({
                    no: peserta.no_peserta,
                    nama: peserta.nama,
                    nilai: null,
                    message: "Sedang Dihitung"
                });
                axios({
                    method: 'get',
                    url: linkRequest,
                    headers: {}
                })
                .then(function(response) {
                    if(response.data.success){
                        self.prosesSoshum[self.indexSoshum].nilai = response.data.nilai;
                        self.prosesSoshum[self.indexSoshum].message = response.data.message;
                    }
                    else {
                        self.prosesSoshum[self.indexSoshum].nilai = response.data.nilai;
                        self.prosesSoshum[self.indexSoshum].message = response.data.message;
                    }
                    self.indexSoshum += 1;
                    if(self.indexSoshum <= self.pesertaSoshum.length) {
                        self.hitungPesertaSoshum();
                    }
                })
                .catch(function(error) {
                    console.log(error);
                });
            }
        },
        mounted: function() {
            this.hitungPesertaSaintek();
            this.hitungPesertaSoshum();
        }
    });
</script>
@endsection
