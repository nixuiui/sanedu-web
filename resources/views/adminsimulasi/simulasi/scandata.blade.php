@extends('layouts.admin')
@section('title')
Scan Jawaban Peserta - {{ $simulasi->judul }}
@endsection
@section('content')
<div class="row" id="scan">
    <div class="col-md-6">
        <a href="{{ route('adminsimulasi.simulasi.kelola', $simulasi->id) }}" class="btn btn-md btn-default btn-space"><i class="mdi mdi-arrow-left mr-3"></i> Kembali</a>
        <button class="btn btn-md btn-primary btn-space" @click="scan(0)">Koreksi Jawaban</button>
        <div class="panel panel-default panel-table">
            <div class="panel-heading">
                Upload Hasil Scan
            </div>
            <div class="panel-body">
                <table class="table table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No. Peserta</th>
                            <th>Nama</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in data">
                            <td>@{{ index+1 }}</td>
                            <td>@{{ item.no_peserta }}</td>
                            <td>@{{ item.nama }}</td>
                            <td>@{{ item.status }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
var app = new Vue({
    el: "#scan",
    data: {
        data: {!! $data !!},
        idMapel: {!! $idMapel !!},
        idSimulasi: "{!! $simulasi->id !!}",
        index: null
    },
    methods: {
        scan: function(index) {
            this.index = index;
            this.$set(this.data[index], 'status', 'Sedang dihitung');
            var self = this;
            url = "{{ route('adminsimulasi.simulasi.kelola.scan.process', ':id') }}";
            url = url.replace(':id', this.idSimulasi);
            axios({
                method: 'post',
                url: url,
                data: {
                    id_mapel: this.idMapel,
                    data: this.data[index]
                }
            }).then(function (response) {
                console.log(response.data.data.peserta);
                if(response.data.success) {
                    self.data[self.index].status = response.data.data.status;
                }
                else {
                    self.data[self.index].status = response.data.data.status;
                }
                if((self.index+1) < self.data.length)
                    self.scan(self.index+1);
            })
            .catch(function (error) {
                console.log(error);
            })
        }
    }
});
</script>
@endsection