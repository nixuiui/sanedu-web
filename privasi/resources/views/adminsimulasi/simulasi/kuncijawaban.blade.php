@extends('layouts.admin')

@section('title')
Kunci Jawaban
@endsection

@section('content')
<a href="{{ route('adminsimulasi.simulasi.kelola', $simulasi->id) }}" class="btn btn-md btn-default btn-space btn-icon"><i class="mdi mdi-arrow-left"></i>Kembali</a>
<div class="row">
    <div class="col-md-6">
        <form action="{{ route('adminsimulasi.simulasi.kelola.kunci.jawaban.post', $simulasi->id) }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="input-group input-group-sm xs-mb-15" style="width: 300px;">
                        <span class="input-group-addon">Jumlah Soal</span>
                        <input type="text" name="jumlahSoal" placeholder="0" class="form-control" v-model="jumlahSoal">
                    </div>
                </div>
                <div class="col-md-4 text-right">
                    <button type="submit" class="btn btn-md btn-primary" v-if="isFinish && isMounted">Simpan Kunci Jawaban</button>
                    <button type="button" class="btn btn-md btn-primary disabled" v-if="!isFinish || !isMounted">Loading</button>
                </div>
            </div>
            <div class="panel panel-table">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="20px">NO</th>
                            <th width="150px">INPUT</th>
                            <th class="text-center">A</th>
                            <th class="text-center">B</th>
                            <th class="text-center">C</th>
                            <th class="text-center">D</th>
                            <th class="text-center">E</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(no, index) in intSoal">
                            <td>@{{ no }}</td>
                            <td><input type="text" pattern="[a-eA-E]{1}" class="form-control input-xs" name="jawaban[]" v-model="jawaban[index]" required/></td>
                            <td class="text-center"><i class="mdi mdi-check-circle text-16" v-bind:class="{'text-success': jawaban[index] == 'a' || jawaban[index] == 'A', 'text-muted': jawaban[index] != 'a' && jawaban[index] != 'A'}"></i></td>
                            <td class="text-center"><i class="mdi mdi-check-circle text-16" v-bind:class="{'text-success': jawaban[index] == 'b' || jawaban[index] == 'B', 'text-muted': jawaban[index] != 'b' && jawaban[index] != 'B'}"></i></td>
                            <td class="text-center"><i class="mdi mdi-check-circle text-16" v-bind:class="{'text-success': jawaban[index] == 'c' || jawaban[index] == 'C', 'text-muted': jawaban[index] != 'c' && jawaban[index] != 'C'}"></i></td>
                            <td class="text-center"><i class="mdi mdi-check-circle text-16" v-bind:class="{'text-success': jawaban[index] == 'd' || jawaban[index] == 'D', 'text-muted': jawaban[index] != 'd' && jawaban[index] != 'D'}"></i></td>
                            <td class="text-center"><i class="mdi mdi-check-circle text-16" v-bind:class="{'text-success': jawaban[index] == 'e' || jawaban[index] == 'E', 'text-muted': jawaban[index] != 'e' && jawaban[index] != 'E'}"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div> <!-- end row -->
@endsection

@section('script')
<script type="text/javascript">
var idSimulasi = "{{ $simulasi->id }}";
var linkReqKunciJawaban = "{{ route('adminsimulasi.simulasi.kelola.req.kunci.jawaban', ':id') }}";
linkReqKunciJawaban = linkReqKunciJawaban.replace(':id', idSimulasi);
var app = new Vue({
    el: "#app",
    data: {
        isMounted: false,
        isFinish: true,
        isErrorExist: false,
        errorMessage: null,
        jumlahSoal: null,
        jawaban: []
    },
    computed: {
        intSoal: function () {
            if(!this.jumlahSoal)
                return 0;
            return parseInt(this.jumlahSoal)
        }
    },
    methods: {
        save: function() {
            this.jawaban[0] = 'e';
        },
        reqKunci: function() {
            var self = this;
            var url = linkReqKunciJawaban;
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
        this.reqKunci();
    }
});
</script>
@endsection
