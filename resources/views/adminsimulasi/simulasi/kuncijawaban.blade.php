@extends('layouts.admin')

@section('title')
Kunci Jawaban Simulasi
@endsection

@section('content')
<a href="{{ route('adminsimulasi.simulasi.kelola', $simulasi->id) }}" class="btn btn-md btn-default btn-space btn-icon"><i class="mdi mdi-arrow-left"></i>Kembali</a>
<div class="row">
    <div class="col-md-4">
        <form action="{{ route('adminsimulasi.simulasi.kelola.kunci.jawaban.post', $simulasi->id) }}" method="post">
            @csrf
            <input type="hidden" name="id_mapel" value="1516">
            <div class="input-group input-group-sm xs-mb-15" style="width: 300px;">
                <span class="input-group-addon">Jumlah Soal</span>
                <input type="text" name="jumlahSoal" placeholder="0" class="form-control" v-model="jumlahSoalSaintek">
            </div>
            <div class="panel panel-table">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th colspan="7" class="text-center">
                                SAINTEK
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
                        <tr v-if="jumlahSoalSaintek > 0">
                            <td colspan="7">
                                <button type="submit" class="btn btn-md btn-primary btn-block" v-if="isFinish && isMounted">SIMPAN KUNCI JAWABAN</button>
                                <button type="button" class="btn btn-md btn-primary btn-block disabled" v-if="!isFinish || !isMounted">Loading</button>
                            </td>
                        </tr>
                        <tr v-for="(no, index) in intSoalSaintek">
                            <td>@{{ no }}</td>
                            <td><input type="text" pattern="[a-eA-E]{1}" class="form-control input-xs text-center" name="jawaban[]" v-model="jawabanSaintek[index]" required/></td>
                            <td class="text-center"><i class="mdi mdi-check-circle text-16" v-bind:class="{'text-success': jawabanSaintek[index] == 'a' || jawabanSaintek[index] == 'A', 'text-muted': jawabanSaintek[index] != 'a' && jawabanSaintek[index] != 'A'}"></i></td>
                            <td class="text-center"><i class="mdi mdi-check-circle text-16" v-bind:class="{'text-success': jawabanSaintek[index] == 'b' || jawabanSaintek[index] == 'B', 'text-muted': jawabanSaintek[index] != 'b' && jawabanSaintek[index] != 'B'}"></i></td>
                            <td class="text-center"><i class="mdi mdi-check-circle text-16" v-bind:class="{'text-success': jawabanSaintek[index] == 'c' || jawabanSaintek[index] == 'C', 'text-muted': jawabanSaintek[index] != 'c' && jawabanSaintek[index] != 'C'}"></i></td>
                            <td class="text-center"><i class="mdi mdi-check-circle text-16" v-bind:class="{'text-success': jawabanSaintek[index] == 'd' || jawabanSaintek[index] == 'D', 'text-muted': jawabanSaintek[index] != 'd' && jawabanSaintek[index] != 'D'}"></i></td>
                            <td class="text-center"><i class="mdi mdi-check-circle text-16" v-bind:class="{'text-success': jawabanSaintek[index] == 'e' || jawabanSaintek[index] == 'E', 'text-muted': jawabanSaintek[index] != 'e' && jawabanSaintek[index] != 'E'}"></i></td>
                        </tr>
                        <tr v-if="jumlahSoalSaintek > 0">
                            <td colspan="7">
                                <button type="submit" class="btn btn-md btn-primary btn-block" v-if="isFinish && isMounted">SIMPAN KUNCI JAWABAN</button>
                                <button type="button" class="btn btn-md btn-primary btn-block disabled" v-if="!isFinish || !isMounted">Loading</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <div class="col-md-4">
        <form action="{{ route('adminsimulasi.simulasi.kelola.kunci.jawaban.post', $simulasi->id) }}" method="post">
            @csrf
            <input type="hidden" name="id_mapel" value="1517">
            <div class="input-group input-group-sm xs-mb-15" style="width: 300px;">
                <span class="input-group-addon">Jumlah Soal</span>
                <input type="text" name="jumlahSoal" placeholder="0" class="form-control" v-model="jumlahSoalSoshum">
            </div>
            <div class="panel panel-table">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th colspan="7" class="text-center">
                                SOSHUM
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
                        <tr v-if="jumlahSoalSoshum > 0">
                            <td colspan="7">
                                <button type="submit" class="btn btn-md btn-primary btn-block" v-if="isFinish && isMounted">SIMPAN KUNCI JAWABAN</button>
                                <button type="button" class="btn btn-md btn-primary btn-block disabled" v-if="!isFinish || !isMounted">Loading</button>
                            </td>
                        </tr>
                        <tr v-for="(no, index) in intSoalSoshum">
                            <td>@{{ no }}</td>
                            <td><input type="text" pattern="[a-eA-E]{1}" class="form-control input-xs text-center" name="jawaban[]" v-model="jawabanSoshum[index]" required/></td>
                            <td class="text-center"><i class="mdi mdi-check-circle text-16" v-bind:class="{'text-success': jawabanSoshum[index] == 'a' || jawabanSoshum[index] == 'A', 'text-muted': jawabanSoshum[index] != 'a' && jawabanSoshum[index] != 'A'}"></i></td>
                            <td class="text-center"><i class="mdi mdi-check-circle text-16" v-bind:class="{'text-success': jawabanSoshum[index] == 'b' || jawabanSoshum[index] == 'B', 'text-muted': jawabanSoshum[index] != 'b' && jawabanSoshum[index] != 'B'}"></i></td>
                            <td class="text-center"><i class="mdi mdi-check-circle text-16" v-bind:class="{'text-success': jawabanSoshum[index] == 'c' || jawabanSoshum[index] == 'C', 'text-muted': jawabanSoshum[index] != 'c' && jawabanSoshum[index] != 'C'}"></i></td>
                            <td class="text-center"><i class="mdi mdi-check-circle text-16" v-bind:class="{'text-success': jawabanSoshum[index] == 'd' || jawabanSoshum[index] == 'D', 'text-muted': jawabanSoshum[index] != 'd' && jawabanSoshum[index] != 'D'}"></i></td>
                            <td class="text-center"><i class="mdi mdi-check-circle text-16" v-bind:class="{'text-success': jawabanSoshum[index] == 'e' || jawabanSoshum[index] == 'E', 'text-muted': jawabanSoshum[index] != 'e' && jawabanSoshum[index] != 'E'}"></i></td>
                        </tr>
                        <tr v-if="jumlahSoalSoshum > 0">
                            <td colspan="7">
                                <button type="submit" class="btn btn-md btn-primary btn-block" v-if="isFinish && isMounted">SIMPAN KUNCI JAWABAN</button>
                                <button type="button" class="btn btn-md btn-primary btn-block disabled" v-if="!isFinish || !isMounted">Loading</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <div class="col-md-4">
        <form action="{{ route('adminsimulasi.simulasi.kelola.kunci.jawaban.post', $simulasi->id) }}" method="post">
            @csrf
            <input type="hidden" name="id_mapel" value="1518">
            <div class="input-group input-group-sm xs-mb-15" style="width: 300px;">
                <span class="input-group-addon">Jumlah Soal</span>
                <input type="text" name="jumlahSoal" placeholder="0" class="form-control" v-model="jumlahSoalCampuran">
            </div>
            <div class="panel panel-table">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th colspan="7" class="text-center">
                                SOSHUM
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
                        <tr v-if="jumlahSoalCampuran > 0">
                            <td colspan="7">
                                <button type="submit" class="btn btn-md btn-primary btn-block" v-if="isFinish && isMounted">SIMPAN KUNCI JAWABAN</button>
                                <button type="button" class="btn btn-md btn-primary btn-block disabled" v-if="!isFinish || !isMounted">Loading</button>
                            </td>
                        </tr>
                        <tr v-for="(no, index) in intSoalCampuran">
                            <td>@{{ no }}</td>
                            <td><input type="text" pattern="[a-eA-E]{1}" class="form-control input-xs text-center" name="jawaban[]" v-model="jawabanCampuran[index]" required/></td>
                            <td class="text-center"><i class="mdi mdi-check-circle text-16" v-bind:class="{'text-success': jawabanCampuran[index] == 'a' || jawabanCampuran[index] == 'A', 'text-muted': jawabanCampuran[index] != 'a' && jawabanCampuran[index] != 'A'}"></i></td>
                            <td class="text-center"><i class="mdi mdi-check-circle text-16" v-bind:class="{'text-success': jawabanCampuran[index] == 'b' || jawabanCampuran[index] == 'B', 'text-muted': jawabanCampuran[index] != 'b' && jawabanCampuran[index] != 'B'}"></i></td>
                            <td class="text-center"><i class="mdi mdi-check-circle text-16" v-bind:class="{'text-success': jawabanCampuran[index] == 'c' || jawabanCampuran[index] == 'C', 'text-muted': jawabanCampuran[index] != 'c' && jawabanCampuran[index] != 'C'}"></i></td>
                            <td class="text-center"><i class="mdi mdi-check-circle text-16" v-bind:class="{'text-success': jawabanCampuran[index] == 'd' || jawabanCampuran[index] == 'D', 'text-muted': jawabanCampuran[index] != 'd' && jawabanCampuran[index] != 'D'}"></i></td>
                            <td class="text-center"><i class="mdi mdi-check-circle text-16" v-bind:class="{'text-success': jawabanCampuran[index] == 'e' || jawabanCampuran[index] == 'E', 'text-muted': jawabanCampuran[index] != 'e' && jawabanCampuran[index] != 'E'}"></i></td>
                        </tr>
                        <tr v-if="jumlahSoalCampuran > 0">
                            <td colspan="7">
                                <button type="submit" class="btn btn-md btn-primary btn-block" v-if="isFinish && isMounted">SIMPAN KUNCI JAWABAN</button>
                                <button type="button" class="btn btn-md btn-primary btn-block disabled" v-if="!isFinish || !isMounted">Loading</button>
                            </td>
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
var linkReqKunciJawaban = "{{ route('adminsimulasi.simulasi.kelola.req.kunci.jawaban', ['id' => ':id', 'idMapel' => ':idMapel']) }}";
linkReqKunciJawaban = linkReqKunciJawaban.replace(':id', idSimulasi);
var app = new Vue({
    el: "#app",
    data: {
        isMounted: false,
        isFinish: true,
        isErrorExist: false,
        errorMessage: null,
        jumlahSoalSaintek: null,
        jumlahSoalSoshum: null,
        jumlahSoalCampuran: null,
        jawabanSaintek: [],
        jawabanSoshum: [],
        jawabanCampuran: []
    },
    computed: {
        intSoalSaintek: function () {
            if(!this.jumlahSoalSaintek)
                return 0;
            return parseInt(this.jumlahSoalSaintek)
        },
        intSoalSoshum: function () {
            if(!this.jumlahSoalSoshum)
                return 0;
            return parseInt(this.jumlahSoalSoshum)
        },
        intSoalCampuran: function () {
            if(!this.jumlahSoalCampuran)
                return 0;
            return parseInt(this.jumlahSoalCampuran)
        }
    },
    methods: {
        reqKunciSaintek: function() {
            var self = this;
            var url = linkReqKunciJawaban;
            url = url.replace(':idMapel', '1516');
            axios({
                method: 'get',
                url: url,
                headers: {}
            })
            .then(function(response) {
                if(response.data.success){
                    self.isMounted = true;
                    response.data.data.forEach(function(val, index, arr) {
                        self.jawabanSaintek.push(val.jawaban);
                    });
                    self.jumlahSoalSaintek = response.data.data.length;
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
        },
        reqKunciSoshum: function() {
            var self = this;
            var url = linkReqKunciJawaban;
            url = url.replace(':idMapel', '1517');
            axios({
                method: 'get',
                url: url,
                headers: {}
            })
            .then(function(response) {
                if(response.data.success){
                    self.isMounted = true;
                    response.data.data.forEach(function(val, index, arr) {
                        self.jawabanSoshum.push(val.jawaban);
                    });
                    self.jumlahSoalSoshum = response.data.data.length;
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
        },
        reqKunciCampuran: function() {
            var self = this;
            var url = linkReqKunciJawaban;
            url = url.replace(':idMapel', '1518');
            axios({
                method: 'get',
                url: url,
                headers: {}
            })
            .then(function(response) {
                if(response.data.success){
                    self.isMounted = true;
                    response.data.data.forEach(function(val, index, arr) {
                        self.jawabanCampuran.push(val.jawaban);
                    });
                    self.jumlahSoalCampuran = response.data.data.length;
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
        this.reqKunciSaintek();
        this.reqKunciSoshum();
        this.reqKunciCampuran();
    }
});
</script>
@endsection
