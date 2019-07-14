@extends('layouts.admin')

@section('title')
Passing Grade
@endsection

@section('style')
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
@endsection

@section('content')
<div class="row" id="passgrade">
    @if(!isset($jurusan))
    <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offser-2">
        <div class="panel panel-preattempt">
            <div class="panel-heading">PASSING GRADE</div>
            <div class="panel-section">
                <input type="text" class="form-control input-md" placeholder="Cari Universitas" v-model="search">
            </div>
            <div class="panel-section" v-for="(data, index) in filteredUniversitas">
                <div class="row">
                    <div class="col-xs-8">
                        <strong>@{{ data.nama }}</strong>
                        <div>Akreditasi: @{{ data.akreditasi }}</div>
                    </div>
                    <div class="col-xs-4 text-center">
                        <div class="mb-2"></div>
                        <a :href="data.url_detail" class="btn btn-sm btn-block btn-success">@{{ data.format_harga }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="col-md-6 col-md-offset-3 col-sm-12 col-sm-offser-2">
        <div class="panel panel-preattempt">
            <div class="panel-heading">Universitas {{ $universitas->nama }}</div>
            <div class="panel-section">
                <input type="text" class="form-control input-md" placeholder="Cari Nama Jurusan" v-model="search">
            </div>
            <div class="panel-section" v-for="(data, index) in filteredJurusan">
                <div class="row">
                    <div class="col-xs-8">
                        <div class="row">
                            <div class="col-sm-6">
                                <div>Jurusan: <strong>@{{ data.jurusan }}</strong></div>
                                <div>Akreditasi: <strong>@{{ data.akreditasi }}</strong></div>
                            </div>
                            <div class="col-sm-6">
                                <div>Passing Grade: <strong>@{{ data.passing_grade }}%</strong></div>
                                <div>Kuota: <strong>@{{ data.kuota }}</strong></div>
                                <div>Peminat: <strong>@{{ data.peminat }}</strong></div>
                            </div>
                        </div>
                        <div>
                            <span class='label label-primary mr-1' v-if="data.saintek">Saintek@{{data.saintek}}</span>
                            <span class='label label-primary mr-1' v-if="data.soshum">Soshum@{{data.soshum}}</span>
                        </div>
                    </div>
                    <div class="col-xs-4 text-center">
                        <div class="mb-2"></div>
                        <a class="btn btn-sm btn-block" @click="setJurusan(data)" data-toggle="modal" data-target="#modalTambahCetakTiket" v-bind:class="data.harga > 0 ? 'btn-success' : 'btn-default'">NILAI UTBK</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="modal fade" id="modalTambahCetakTiket" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" style="display: none;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalFormLabel">Detail Passing Grade Jurusan @{{ jurusanSelected.jurusan }}</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 col-xs-6 mb-5">
                            <div class="text-muted">Jurusan</div>
                            <div>@{{jurusanSelected.jurusan}}</div>
                        </div>
                        <div class="col-md-4 col-xs-6 mb-5">
                            <div class="text-muted">Akreditasi</div>
                            <div>@{{jurusanSelected.akreditasi}}</div>
                        </div>
                        <div class="col-md-4 col-xs-6 mb-5">
                            <div class="text-muted">Kelompok</div>
                            <div>@{{jurusanSelected.jurusan}}</div>
                        </div>
                        <div class="col-md-4 col-xs-6 mb-5">
                            <div class="text-muted">Passing Grade</div>
                            <div>@{{jurusanSelected.passing_grade}}%</div>
                        </div>
                        <div class="col-md-4 col-xs-6 mb-5">
                            <div class="text-muted">Kuota</div>
                            <div>@{{jurusanSelected.kuota}}</div>
                        </div>
                        <div class="col-md-4 col-xs-6 mb-5">
                            <div class="text-muted">Peminat</div>
                            <div>@{{jurusanSelected.peminat}}</div>
                        </div>
                    </div>
                </div>
                <div class="modal-header">
                    <h4 class="modal-title" id="modalFormLabel">Nilai Minimum UTBK</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 col-xs-6 mb-5">
                            <div class="text-muted">Penalaran Umum</div>
                            <div>@{{jurusanSelected.s_penalaran_umum}}</div>
                        </div>
                        <div class="col-md-4 col-xs-6 mb-5">
                            <div class="text-muted">Kuantitatif</div>
                            <div>@{{jurusanSelected.s_kuantitatif}}</div>
                        </div>
                        <div class="col-md-4 col-xs-6 mb-5">
                            <div class="text-muted">Pemahaman Umum</div>
                            <div>@{{jurusanSelected.s_pemahaman_umum}}</div>
                        </div>
                        <div class="col-md-4 col-xs-6 mb-5">
                            <div class="text-muted">Baca Tulis</div>
                            <div>@{{jurusanSelected.s_baca_menulis}}</div>
                        </div>
                        <div class="col-md-4 col-xs-6 mb-5" v-if="jurusanSelected.saintek">
                            <div class="text-muted">Matematika</div>
                            <div>@{{jurusanSelected.ipa_matematika}}</div>
                        </div>
                        <div class="col-md-4 col-xs-6 mb-5" v-if="jurusanSelected.saintek">
                            <div class="text-muted">Fisika</div>
                            <div>@{{jurusanSelected.ipa_fisika}}</div>
                        </div>
                        <div class="col-md-4 col-xs-6 mb-5" v-if="jurusanSelected.saintek">
                            <div class="text-muted">Kimia</div>
                            <div>@{{jurusanSelected.ipa_kimia}}</div>
                        </div>
                        <div class="col-md-4 col-xs-6 mb-5" v-if="jurusanSelected.saintek">
                            <div class="text-muted">Biologi</div>
                            <div>@{{jurusanSelected.ipa_biologi}}</div>
                        </div>
                        <div class="col-md-4 col-xs-6 mb-5" v-if="jurusanSelected.soshum">
                            <div class="text-muted">Matematika Soshum</div>
                            <div>@{{jurusanSelected.ips_matematika}}</div>
                        </div>
                        <div class="col-md-4 col-xs-6 mb-5" v-if="jurusanSelected.soshum">
                            <div class="text-muted">Geografi</div>
                            <div>@{{jurusanSelected.ips_geografi}}</div>
                        </div>
                        <div class="col-md-4 col-xs-6 mb-5" v-if="jurusanSelected.soshum">
                            <div class="text-muted">Sejarah</div>
                            <div>@{{jurusanSelected.ips_sejarah}}</div>
                        </div>
                        <div class="col-md-4 col-xs-6 mb-5" v-if="jurusanSelected.soshum">
                            <div class="text-muted">Sosiologi</div>
                            <div>@{{jurusanSelected.ips_sosiologi}}</div>
                        </div>
                        <div class="col-md-4 col-xs-6 mb-5" v-if="jurusanSelected.soshum">
                            <div class="text-muted">Ekonomi</div>
                            <div>@{{jurusanSelected.ips_ekonomi}}</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default btn-fill btn-md" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
    $('.main-gallery').slick({
        autoplay: true,
        autoplayspeed: 5000
    });
});
</script>
<script type="text/javascript">
    var app = new Vue({
    el: '#passgrade',
    data: {
        search: '',
        universitas: {!! $universitas !!},
        jurusan: {!! isset($jurusan) ? $jurusan : "[]" !!},
        jurusanSelected: {},
        test: "ASDSA"
    },
    methods: {
        setJurusan: function(data){
            this.jurusanSelected = data;
        }
    },
    computed: {
        filteredUniversitas() {
            return this.universitas.filter(data => {
                return data.nama.toLowerCase().indexOf(this.search.toLowerCase()) > -1
            })
        },
        filteredJurusan() {
            return this.jurusan.filter(data => {
                return data.jurusan.toLowerCase().indexOf(this.search.toLowerCase()) > -1
            })
        }
    },
    watch: {
        harga: function() {
            return 0;
        }
    }
});
</script>
@endsection