@extends('layouts.admin')

@section('title')
Ujian
@endsection

@section('content')
<div class="row">
    <div class="col-md-5">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{ $ujian->judul }}
            </div>
            <div class="panel-body">
                <table class="table table-condensed table-hover table-bordered table-striped">
                    <tr>
                        <th>Ujian</th>
                        <td>{{ $ujian->jenisUjian->nama }}</td>
                    </tr>
                    <tr>
                        <th>Soal</th>
                        <td>{{ $ujian->judul }}</td>
                    </tr>
                    @if($ujian->id_mata_pelajaran != null)
                    <tr>
                        <th>Mate Pelajaran</th>
                        <td>{{ $ujian->mataPelajaran->nama }}</td>
                    </tr>
                    @endif
                    <tr>
                        <th>Tingkat Sekolah</th>
                        <td>{{ $ujian->tingkatSekolah->nama }}</td>
                    </tr>
                    @if($ujian->id_tingkat_kelas != null)
                    <tr>
                        <th>Mate Pelajaran</th>
                        <td>{{ $ujian->tingkatKelas->nama }}</td>
                    </tr>
                    @endif
                    <tr>
                        <th>Durasi</th>
                        <td>{{ $ujian->durasi }} menit</td>
                    </tr>
                    <tr>
                        <th>Jumlah Soal</th>
                        <td>{{ $ujian->jumlah_soal }} butir</td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td class="text-success text-bold">{{ formatUang($ujian->harga) }}</td>
                    </tr>
                    <tr>
                        <th>Nilai Percobaan Pertama</th>
                        <td class="text-success text-bold">{{ $ujian->attempt->count() > 0 ? round(($ujian->attempt->first()->jumlah_benar / $ujian->soal->count())*100, 2) : "-" }}</td>
                    </tr>
                    <tr>
                        <th>Pembahasan</th>
                        <td><a href="{{ $ujian->link_pembahasan }}"><i class="mdi mdi-download mr-2"></i>{{ $ujian->link_pembahasan }} Download</a></td>
                    </tr>
                    @if($ujian->diBeliOleh->where('id', Auth::id())->first() == null)
                    <tr>
                        <th>Keterangan</th>
                        <td>Soal belum dibeli</td>
                    </tr>
                    <tr>
                        <td colspan="2"><span data-href="{{ route('member.ujian.soal.beli', $ujian->id) }}" class="btn btn-md btn-success beli-ujian" data-harga="{{ formatUang($ujian->harga) }}" data-hargaori="{{ $ujian->harga }}" data-saldo="{{ Auth::user()->saldo }}" data-judul="{{ $ujian->judul }}">Beli Ujian</span></td>
                    </tr>
                    @else
                    <tr>
                        <th>Keterangan</th>
                        <td>Soal sudah dibeli</td>
                    </tr>
                    @if($attempt)
                    <tr>
                        <th colspan="2" class="text-info">ANDA SEDANG UJIAN</th>
                    </tr>
                    <tr>
                        <th>Berakhir Pada</th>
                        <td>{{ hariTanggalWaktu($attempt->end_attempt) }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <a href="{{ route('member.ujian.soal.open', $attempt->id) }}" class="btn btn-md btn-primary">Lanjut Ujian</a>
                        </td>
                    </tr>
                    @else
                    <tr>
                        <td colspan="2">
                            @if($ujian->id_jenis_ujian == 1404)
                            <a href="{{ route('member.ujian.soal.sbmptn.passgrade', $ujian->id) }}" class="btn btn-md btn-primary mulai-ujian">Mulai Ujian</a>
                            @else
                            <a href="{{ route('member.ujian.soal.attempt', $ujian->id) }}" class="btn btn-md btn-primary mulai-ujian">Mulai Ujian</a>
                            @endif
                        </td>
                    </tr>
                    @endif
                    @endif
                </table>
            </div>
        </div>
    </div>

    @if($ujian->attempt->count() > 0)
    <div class="col-md-7">
        <div class="panel panel-default panel-table">
            <div class="panel-heading">
                History
            </div>
            <div class="panel-body">
                <table id="datatables" class="table datatables table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Ujian</th>
                            <th>Soal</th>
                            <th class="text-center">Benar</th>
                            <th class="text-center">Salah</th>
                            <th>Waktu</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Ujian</th>
                            <th>Soal</th>
                            <th class="text-center">Benar</th>
                            <th class="text-center">Salah</th>
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
                            <td>{{ round(($data->jumlah_benar / $data->ujian->soal->count())*100, 2) }}</td>
                            <td class="text-center">{{ $data->jumlah_benar }}</td>
                            <td class="text-center">{{ $data->jumlah_salah }}</td>
                            <td>{{ hariTanggalWaktu($data->start_attempt) }}</td>
                            <td><a href="{{ route('member.ujian.soal.history', $data->id) }}" target="_blank"><i class="mdi mdi-open-in-new"></i></a></td>
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
