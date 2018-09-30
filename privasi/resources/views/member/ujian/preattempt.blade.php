@extends('layouts.admin')

@section('title')
Ujian
@endsection

@section('content')
<div class="row">
    <div class="col-md-5">
        <div class="panel panel-preattempt">
            <div class="heading">
                {{ $ujian->judul }}
            </div>
            <div class="panel-section">
                <div class="text-20 text-bold item">{{ $ujian->jenisUjian->nama }}</div>
            </div>
            <div class="panel-section">
                <div class="text-20 text-bold item">{{ $ujian->tingkatSekolah->nama }}{{ $ujian->id_tingkat_kelas != null ? " - " . $ujian->tingkatKelas->nama : "" }} - {{ $ujian->mataPelajaran->nama}}</div>
            </div>
            <div class="panel-section">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <div class="text-muted">JUMLAH SOAL</div>
                        <div>{{ $ujian->soal->count() }} Butir</div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <div class="text-muted">DURASI</div>
                        <div>{{ $ujian->durasi }} menit</div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-muted">PEMBAHASAN</div>
                        <div><a href="{{ $ujian->link_pembahasan }}"><i class="mdi mdi-download mr-2"></i>{{ $ujian->link_pembahasan }} Download</a></div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="text-muted">PERCOBAAN PERTAMA</div>
                        <div>Nilai: {{ $ujian->attempt->count() > 0 ? round(($ujian->attempt->first()->jumlah_benar / $ujian->soal->count())*100, 2) : "-" }}</div>
                    </div>
                </div>
            </div>
            <div class="panel-section">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <div class="text-muted">HARGA</div>
                        <div class="text-success text-20 text-bold">Rp. 150.000</div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <div class="text-muted">KETERANGAN</div>
                        <div>
                            @if($ujian->diBeliOleh->where('id', Auth::id())->first() == null)
                                Belum dibeli
                            @else
                                Sudah dibeli
                            @endif
                        </div>
                    </div>
                    @if($attempt)
                    <div class="col-md-6">
                        <div class="text-muted">ANDA SEDANG UJIAN</div>
                        <div class="">Berakhir pada <br> <strong>{{ hariTanggalWaktu($attempt->end_attempt) }}</strong></div>
                    </div>
                    @endif
                </div>
            </div>
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

    @if($ujian->attempt->count() > 0)
    <div class="col-md-7">
        <div class="panel panel-default panel-table">
            <div class="panel-heading">
                Riwayat Pengerjaan {{ $ujian->judul }}
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Ujian</th>
                            <th>Soal</th>
                            <th class="text-center">Nilai</th>
                            <th>Waktu</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Ujian</th>
                            <th>Soal</th>
                            <th class="text-center">Nilai</th>
                            <th>Waktu</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($ujian->attempt as $i => $data)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $data->ujian->jenisUjian->nama }}</td>
                            <td>{{ $data->ujian->judul }}</td>
                            <td class="text-center">{{ $data->jumlah_benar }}</td>
                            <td>{{ hariTanggalWaktu($data->start_attempt) }}</td>
                            <td><a href="{{ route('member.ujian.history', $data->id) }}" target="_blank"><i class="mdi mdi-open-in-new"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    @endif
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
