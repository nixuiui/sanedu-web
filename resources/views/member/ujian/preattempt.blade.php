@extends('layouts.admin')

@section('title')
Contoh Soal
@endsection

@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
        <div class="panel panel-preattempt">
            <div class="heading">
                Contoh Soal
            </div>
            <div class="panel-section">
                <div class="text-20 text-bold item">{{ $ujian->jenisUjian->nama }} - {{ $ujian->judul }}</div>
            </div>
            <div class="panel-section">
                <div class="text-20 text-bold item">{{ $ujian->tingkatSekolah->nama }}{{ $ujian->id_tingkat_kelas != null ? " - " . $ujian->tingkatKelas->nama : "" }} - {{ $ujian->mataPelajaran->nama}}</div>
            </div>
            <div class="panel-section">
                <div class="row">
                    <div class="col-md-3 col-xs-6 mb-3">
                        <div class="text-muted">PEMBAHASAN</div>
                        <div><a href="{{ $ujian->link_pembahasan }}"><i class="mdi mdi-download mr-2"></i>{{ $ujian->link_pembahasan }} Download</a></div>
                    </div>
                    <div class="col-md-4 col-xs-6 mb-3">
                        <div class="text-muted">PERCOBAAN PERTAMA</div>
                        <div>Nilai: {{ $ujian->attempt->count() > 0 ? round(($ujian->attempt->first()->jumlah_benar / $ujian->soal->count())*100, 2) : "-" }}</div>
                    </div>
                    <div class="col-md-3 col-xs-6 mb-3">
                        <div class="text-muted">HARGA</div>
                        <div class="text-success text-20 text-bold">{{ formatUang($ujian->harga) }}</div>
                    </div>
                    <div class="col-md-2 col-xs-6 mb-3">
                        <div class="text-muted">KETERANGAN</div>
                        <div>
                            @if($ujian->diBeliOleh->where('id', Auth::id())->first() == null)
                                Belum dibeli
                            @else
                                Sudah dibeli
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-section">
                <div class="row">
                    @if($ujian->is_grouped)
                        @foreach($ujian->group as $group)
                            <div class="col-md-3 col-sm-4 col-xs-6 mb-3">
                                <strong>{{ strtoupper($group->nama) }}</strong>
                            </div>
                            <div class="col-md-9 col-sm-8 col-xs-6 mb-3">
                                <div class="col-md-4 col-sm-6 col-xs-12 mb-3">
                                    <div class="text-muted">JUMLAH SOAL</div>
                                    <div>{{ $group->jumlah_soal }} Butir</div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12 mb-3">
                                    <div class="text-muted">DURASI</div>
                                    <div>{{ gmdate("H:i:s", $group->durasi) }}</div>
                                </div>
                            </div>
                        @endforeach
                    @else
                    <div class="col-md-3 col-xs-6 mb-3">
                        <div class="text-muted">JUMLAH SOAL</div>
                        <div>{{ $ujian->jumlah_soal }} Butir</div>
                    </div>
                    <div class="col-md-2 col-xs-6 mb-3">
                        <div class="text-muted">DURASI</div>
                        <div>{{ gmdate("H:i:s", $ujian->durasi) }}</div>
                    </div>
                    @endif
                </div>
            </div>
            @if($attempt)
            <div class="panel-section">
                <div class="row">
                    <div class="col-md-6">
                        <div class="text-muted">ANDA SEDANG UJIAN</div>
                        <div class="">Berakhir pada <br> <strong>{{ hariTanggalWaktu($attempt->end_attempt) }}</strong></div>
                    </div>
                </div>
            </div>
            @endif
            <div class="panel-section">
                @if($ujian->diBeliOleh->where('id', Auth::id())->first() == null)
                <span data-href="{{ route('member.ujian.soal.beli', $ujian->id) }}" class="btn btn-lg btn-success btn-ujian btn-block beli-ujian" data-harga="{{ formatUang($ujian->harga) }}" data-hargaori="{{ $ujian->harga }}" data-saldo="{{ Auth::user()->saldo }}" data-judul="{{ $ujian->judul }}">Beli Ujian</span>
                @else
                    @if($attempt)
                    <a href="{{ route('member.ujian.soal.open', $attempt->id) }}" class="btn btn-lg btn-ujian btn-block btn-primary">Lanjut Ujian</a>
                    @else
                    <a href="{{ route('member.ujian.soal.attempt', $ujian->id) }}" class="btn btn-lg btn-ujian btn-block btn-primary mulai-ujian">Mulai Ujian</a>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
$(document).on("click", ".beli-ujian", function(e) {
    var link = $(this).data("href");
    var harga = $(this).data("harga");
    var hargaori = $(this).data("hargaori");
    var saldo = $(this).data("saldo");
    var judul = $(this).data("judul");
    if(hargaori > saldo) {
        swal(
            'Saldo Tidak Cukup',
            "Maaf Saldo Anda tidak mencukupi untuk membeli ujian ini",
            'warning'
        );
    }
    else {
        e.preventDefault();
        swal({
            title: "Yakin Ingin Beli?",
            text: "Anda Akan membeli ujian 	" + judul + " degnan harga " + harga,
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
$(document).on("click", ".mulai-ujian", function(e) {
    var link = $(this).attr("href");
    e.preventDefault();
    swal({
        title: "Ingin Ujian?",
        text: "Anda yakin ingin mulai ujian sekarang?",
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
