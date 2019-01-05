@extends('layouts.admin')

@section('title')
Simulasi
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
    @include('user.simulasi.tombolatas')
    </div>
</div>
@if(!isset($_GET['sekolah']))
<div class="row">
    <div class="col-md-4 col-sm-4 col-simulasi mb-3">
        <div class="card">
            <a href="{{ route('user.simulasi', ['sekolah' => '1301']) }}">
                <div class="card-image">
                    <img class="card-img-top" src="{{ asset('image/ujian_nasional.png') }}" alt="Placeholder">
                    <div class="flex-center sd">
                        <div class="text-school">
                            SD
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-md-4 col-sm-4 col-simulasi mb-3">
        <div class="card">
            <a href="{{ route('user.simulasi', ['sekolah' => '1302']) }}">
                <div class="card-image">
                    <img class="card-img-top" src="{{ asset('image/ujian_nasional.png') }}" alt="Placeholder">
                    <div class="flex-center smp">
                        <div class="text-school">
                            SMP
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-md-4 col-sm-4 col-simulasi mb-3">
        <div class="card">
            <a href="{{ route('user.simulasi', ['sekolah' => '1303']) }}">
                <div class="card-image">
                    <img class="card-img-top" src="{{ asset('image/ujian_nasional.png') }}" alt="Placeholder">
                    <div class="flex-center sma">
                        <div class="text-school">
                            SMA
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@else
<div class="row">
    @foreach($simulasi as $data)
    <div class="col-md-3 col-sm-4 col-simulasi mb-3">
        <div class="card">
            <div class="card-image">
                <img class="card-img-top fix-height" src="{{ $data->image_url }}" alt="Placeholder">
            </div>
            <div class="card-body text-14">
                <div class="text-16 text-ellipsis mb-3 text-bold">{{ $data->judul }}</div>
                <div><i class="mdi mdi-calendar mr-4 mb-2"></i>{{ hariTanggal($data->tanggal_pelaksanaan) }}</div>
                <div><i class="mdi mdi-pin mr-4 mb-2"></i>{{ $data->tempat_pelaksanaan }}</div>
                <div class="text-success text-bold mb-3"><i class="mdi mdi-circle mr-4"></i>{{ formatUang($data->harga) }}</div>
                @if($data->peserta->where('id_user', Auth::id())->first() == null)
                <a data-href="{{ route('user.simulasi.register', $data->id) }}" class="btn btn-lg btn-block btn-success beli-simulasi" data-judul="{{ $data->judul }}" data-hargaori="{{ $data->harga }}" data-harga="{{ formatUang($data->harga) }}" data-saldo="{{ Auth::user()->saldo}}">BELI TIKET</a>
                @else
                <a href="{{ route('user.simulasi.open', $data->id) }}" class="btn btn-lg btn-block btn-primary">BUKA SIMULASI</a>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif
@endsection


@section('script')
<script type="text/javascript">
$(document).on("click", ".beli-simulasi", function(e) {
    var link = $(this).data("href");
    var harga = $(this).data("harga");
    var hargaori = $(this).data("hargaori");
    var saldo = $(this).data("saldo");
    var judul = $(this).data("judul");
    if(hargaori > saldo) {
        swal(
            'Saldo Tidak Cukup',
            "Maaf Saldo Anda tidak mencukupi untuk membeli tiket simulasi ini",
            'warning'
        );
    }
    else {
        e.preventDefault();
        swal({
            title: "Yakin Ingin Beli?",
            text: "Anda Akan membeli simulasi 	" + judul + " degnan harga " + harga,
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
    }
});
</script>
@endsection
