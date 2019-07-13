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
    <div class="col-md-4 col-sm-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <input type="text" class="form-control input-md mb-5" placeholder="Cari Universitas" v-model="search">
                <div v-for="(data, index) in filteredItems">
                    <div class="row mb-3">
                        <div class="col-xs-8">
                            <strong>@{{ data.nama }}</strong>
                            <div>Akreditasi: @{{ data.akreditasi }}</div>
                        </div>
                        <div class="col-xs-4 text-center">
                            <div class="mb-2"></div>
                            <a :href="data.url_detail" class="btn btn-xs btn-block" v-bind:class="data.harga > 0 ? 'btn-success' : 'btn-default'">@{{ data.format_harga }}</a>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="col-md-12">
        <div class="panel panel-default panel-table">
            <div class="panel-heading">
            </div>
            <div class="panel-body table-responsive noSwipe">
                <table id="datatables" class="table table-striped">
                    <thead>
                        <tr>
                            <th width="20">No</th>
                            <th>Jurusan</th>
                            <th>Jenis</th>
                            <th>Kuota</th>
                            <th>Peminat</th>
                            <th>Pass Grade</th>
                            <th>Akreditasi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th width="20">No</th>
                            <th>Jurusan</th>
                            <th>Jenis</th>
                            <th>Kuota</th>
                            <th>Peminat</th>
                            <th>Pass Grade</th>
                            <th>Akreditasi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($jurusan as $no => $w)
                        <tr>
                            <td>{{ $no+1 }}</td>
                            <td>{{ $w->jurusan }}</td>
                            <td>
                                {!! $w->saintek ? "<span class='badge badge-primary'>Saintek</span>" : "" !!}
                                {!! $w->soshum ? "<span class='badge badge-success'>Soshum</span>" : "" !!}
                            </td>
                            <td>{{ $w->kuota }}</td>
                            <td>{{ $w->peminat }}</td>
                            <td>{{ $w->passing_grade }}</td>
                            <td>{{ $w->akreditasi }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
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
        test: "ASDSA"
    },
    computed: {
        filteredItems() {
            return this.universitas.filter(data => {
                return data.nama.toLowerCase().indexOf(this.search.toLowerCase()) > -1
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