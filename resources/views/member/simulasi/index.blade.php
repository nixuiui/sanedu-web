@extends('layouts.admin')

@section('title')
Simulasi
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
    @include('member.simulasi.tombolatas')
    </div>
</div>
@if(isset($_GET['sekolah']) || isset($simulasi))
<div class="row">
    @foreach($simulasi as $data)
    <div class="col-md-4 col-sm-6 col-simulasi mb-3">
        <div class="card">
            <div class="card-image">
                <img class="card-img-top fix-height" src="{{ $data->image_url }}" alt="Placeholder">
            </div>
            <div class="card-body text-14">
                <small class="text-muted text-danger">
                    SIMULASI 
                    @if($data->is_online)
                    ONLINE
                    @endif
                    @if($data->is_offline)
                    OFFLINE
                    @endif
                </small>
                <div class="text-16 text-ellipsis mb-3 text-bold">{{ $data->judul }}</div>
                <div><i class="mdi mdi-calendar mr-4 mb-2"></i>{{ hariTanggal($data->tanggal_pelaksanaan) }}</div>
                <div><i class="mdi mdi-pin mr-4 mb-2"></i>{{ $data->tempat_pelaksanaan }}</div>
                <div class="mb-3"><i class="mdi mdi-circle mr-4"></i>{{ $data->harga > 0 ? formatUang($data->harga) : "GRATIS"}}</div>
                @if($data->peserta->where('id_user', Auth::id())->first() == null)
                <a href="{{ route('member.simulasi.register', $data->id) }}" class="btn btn-lg btn-block btn-success" data-judul="{{ $data->judul }}" data-hargaori="{{ $data->harga }}" data-harga="{{ formatUang($data->harga) }}" data-saldo="{{ Auth::user()->saldo}}">IKUTI SIMULASI</a>
                {{-- <a data-href="{{ route('member.simulasi.register', $data->id) }}" class="btn btn-lg btn-block btn-success beli-simulasi" data-judul="{{ $data->judul }}" data-hargaori="{{ $data->harga }}" data-harga="{{ formatUang($data->harga) }}" data-saldo="{{ Auth::user()->saldo}}">IKUTI SIMULASI</a> --}}
                @else
                <a href="{{ route('member.simulasi.open', $data->id) }}" class="btn btn-lg btn-block btn-primary">BUKA SIMULASI</a>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="row">
    <div class="col-md-4 col-sm-4 col-simulasi mb-3">
        <div class="card">
            <a href="{{ route('member.simulasi', ['sekolah' => '1301']) }}">
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
            <a href="{{ route('member.simulasi', ['sekolah' => '1302']) }}">
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
            <a href="{{ route('member.simulasi', ['sekolah' => '1303']) }}">
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
    e.preventDefault();
    swal({
        title: "Yakin Ingin Mengikuti Simulasi?",
        text: hargaori > 0  ? "Anda Akan membeli simulasi 	" + judul + " degnan harga " + harga : "",
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
});
</script>
@endsection
