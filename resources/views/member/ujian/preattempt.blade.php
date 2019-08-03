@extends('layouts.admin') 
@section('title') Contoh Soal
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
                <div class="text-20 text-bold item">{{ $ujian->tingkatSekolah->nama }}{{ $ujian->id_tingkat_kelas != null ? " - " . $ujian->tingkatKelas->nama
                    : "" }} - {{ $ujian->mataPelajaran->nama}}</div>
            </div>
            <div class="panel-section">
                <div class="row">
                    <div class="col-md-3 col-xs-6 mb-3">
                        <div class="text-muted">PEMBAHASAN</div>
                        <div>
                            @if($history->count() > 0)
                            <a href="{{ $ujian->link_pembahasan }}"><i class="mdi mdi-download mr-2"></i> Download</a>
                            @else
                            <span class="text-info">Anda harus mengerjakan ujian dulu.</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-6 mb-3">
                        <div class="text-muted">PERCOBAAN PERTAMA</div>
                        <div>Nilai: {{ $ujian->attempt->count() > 0 ? round(($ujian->attempt->first()->jumlah_benar / $ujian->soal->count())*100,
                            2) : "-" }}</div>
                    </div>
                    <div class="col-md-3 col-xs-6 mb-3">
                        <div class="text-muted">HARGA</div>
                        <div class="text-success text-20 text-bold">{{ $ujian->harga > 0 ? formatUang($ujian->harga) : "Gratis" }}</div>
                    </div>
                    <div class="col-md-2 col-xs-6 mb-3">
                        <div class="text-muted">KETERANGAN</div>
                        <div>
                            @if($ujian->diBeliOleh->where('id', Auth::id())->first() == null) Belum dimiliki @else Sudah dimiliki @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-section">
                <div class="row">
                    @if($ujian->is_grouped) @foreach($ujian->group as $group)
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
                            <div>{{ durasi($group->durasi) }}</div>
                        </div>
                    </div>
                    @endforeach @else
                    <div class="col-md-3 col-xs-6 mb-3">
                        <div class="text-muted">JUMLAH SOAL</div>
                        <div>{{ $ujian->jumlah_soal }} Butir</div>
                    </div>
                    <div class="col-md-2 col-xs-6 mb-3">
                        <div class="text-muted">DURASI</div>
                        <div>{{ durasi($ujian->durasi) }}</div>
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
                <a href="{{ route('member.ujian.soal.beli', $ujian->id) }}" class="btn btn-lg btn-success btn-ujian btn-block">{{ $ujian->harga > 0 ? "Beli Soal" : "Dapatkan Soal"}}</a> 
                {{-- <span data-href="{{ route('member.ujian.soal.beli', $ujian->id) }}" class="btn btn-lg btn-success btn-ujian btn-block beli-ujian"
                    data-harga="{{ formatUang($ujian->harga) }}" data-hargaori="{{ $ujian->harga }}" data-saldo="{{ Auth::user()->saldo }}"
                    data-judul="{{ $ujian->judul }}">{{ $ujian->harga > 0 ? "Beli Soal" : "Dapatkan Soal"}}</span>  --}}
                @else @if($attempt)
                <a href="{{ route('member.ujian.soal.open', $attempt->id) }}" class="btn btn-lg btn-ujian btn-block btn-primary">Lanjut Ujian</a>                
                @else
                <a href="{{ route('member.ujian.soal.attempt', $ujian->id) }}" class="btn btn-lg btn-ujian btn-block btn-primary mulai-ujian">Mulai Ujian</a>                @endif @endif
            </div>
        </div>
        @if($history->count() > 0)
        <div class="panel panel-default panel-table">
            <div class="panel-heading">Riwayat Pengerjaan</div>
            <div class="panel-body table-responsive">
                <table id="datatables" class="table table-striped table-borderless">
                    <thead>
                        <tr>
                            <th style="width:25px">No</th>
                            <th style="min-width:300px">Waktu</th>
                            <th class="text-left">Nilai</th>
                            <th class="text-center">Benar</th>
                            <th class="text-center">Salah</th>
                        </tr>
                    </thead>
                    <tbody class="no-border-x">
                        @foreach($history as $i => $data)
                        <tr class="clickable-row" data-href="{{ route('member.ujian.history', $data->id) }}">
                            <td>{{ $i+1 }}</td>
                            <td>{{ hariTanggalWaktu($data->start_attempt) }}</td>
                            <td class="milestone">
                                <span class="completed"><strong>{{ $data->jumlah_benar }}</strong>/{{ $ujian->jumlah_soal }}</span>
                                <span class="version">{{ round($data->nilai, 2) }}</span>
                                <div class="progress">
                                    <div style="width: {{ ($data->jumlah_benar/$ujian->jumlah_soal)*100 }}%" class="progress-bar progress-bar-primary"></div>
                                </div>
                            </td>
                            <td class="text-center">{{ $data->jumlah_benar }}</td>
                            <td class="text-center">{{ $data->jumlah_salah }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
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
        title: "Anda yakin ingin mulai ujian sekarang?",
        text: "Waktu ujian {{ durasi($ujian->durasi) }} tidak dapat dijeda. Pastikan Anda memiliki waktu yang cukup untuk menyelesaikan ujian ini.",
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