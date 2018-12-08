<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title></title>
    <style>
    @page {
        margin: 1.5cm;
    }
    body { font-size: 13px; }
    h1 { font-size: 30px; margin-bottom: 1cm; }
    .page-break {
        page-break-after: always;
    }
    .text-center { text-align: center; }
    .text-right { text-align: right; }
    table.borang td { padding: 5px; }
    .box { border: 1px solid #333; padding: 3px; }
    .box.peringkat { width: 100px; height: 100px; float: right; text-align: center; }
    .text-peringkat { font-size: 50px; font-weight: bold; margin-top: 10px; display: block;}
</style>
</head>
<body>
    @foreach($peserta as $index => $data)
    <h1 class="text-center">BORANG LAPORAN REKOMENDASI</h1>
    <table class="borang" width="17cm">
        <tr>
            <td width="170px">Nama</td>
            <td width="5px">:</td>
            <td colspan="2">{{ $data->profil->nama }}</td>
            <td rowspan="4" class="text-center">
                <div class="box peringkat">
                    PERINGKAT <br>
                    <span class="text-peringkat">{{ $data->peringkat }}</span>
                </div>
            </td>
        </tr>
        <tr>
            <td width="170px">No Ujian</td>
            <td>:</td>
            <td colspan="2">{{ $data->no_peserta }}</td>
        </tr>
        <tr>
            <td width="170px">Asal Sekolah</td>
            <td>:</td>
            <td colspan="2">{{ $data->profil->id_sekolah != null ? $data->profil->sekolah->nama : "-"  }}</td>
        </tr>
        <tr>
            <td width="170px">Jurusan Ujian</td>
            <td>:</td>
            <td colspan="2">{{ $data->mapel->nama }}</td>
        </tr>
        <tr>
            <td width="170px">Hasil Ujian</td>
            <td>:</td>
            <td>{{ $data->nilai_akhir }}</td>
        </tr>
        <tr>
            <td colspan="3">
                <div class="box">
                    <table width="100%">
                        <tr>
                            <td class="50%">BENAR: {{ $data->jumlah_benar }}</td>
                            <td class="50%">SALAH/KOSONG: {{ $data->jumlah_salah + $data->jumlah_tidak_jawab }}</td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
        <tr>
            <td width="170px">Soal Sulit</td>
            <td></td>
            <td colspan="3">
                <div class="box">
                    <?php $no =0; ?>
                    @foreach($data->koreksi->where("kriteria", "sulit") as $soal)
                        {{ $no == 0 ? $soal->no_soal : ", " . $soal->no_soal}}
                        <?php $no++; ?>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td width="170px">Soal Sedang</td>
            <td></td>
            <td colspan="3">
                <div class="box">
                    <?php $no =0; ?>
                    @foreach($data->koreksi->where("kriteria", "sedang") as $soal)
                        {{ $no == 0 ? $soal->no_soal : ", " . $soal->no_soal}}
                        <?php $no++; ?>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td width="170px">Soal Mudah</td>
            <td></td>
            <td colspan="3">
                <div class="box">
                    <?php $no =0; ?>
                    @foreach($data->koreksi->where("kriteria", "mudah") as $soal)
                        {{ $no == 0 ? $soal->no_soal : ", " . $soal->no_soal}}
                        <?php $no++; ?>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td width="170px">Pilihan Saat Simulasi</td>
            <td></td>
            <td>Pilihan 1</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td colspan="2"><div class="box">{{ $data->passingGrade->pilihan1->universitas != null ? $data->passingGrade->pilihan1->universitas->nama : "-" }}</div></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td colspan="2"><div class="box">{{ $data->passingGrade->pilihan1->universitas != null ? $data->passingGrade->pilihan1->jurusan : "-" }}</div></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td>Pilihan 2</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td colspan="2"><div class="box">{{ $data->passingGrade->pilihan2->universitas != null ? $data->passingGrade->pilihan2->universitas->nama : "-" }}</div></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td colspan="2"><div class="box">{{ $data->passingGrade->pilihan2->universitas != null ? $data->passingGrade->pilihan2->jurusan : "-" }}</div></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td>Pilihan 3</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td colspan="2"><div class="box">{{ $data->passingGrade->pilihan3->universitas != null ? $data->passingGrade->pilihan3->universitas->nama : "-" }}</div></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td colspan="2"><div class="box">{{ $data->passingGrade->pilihan3->universitas != null ? $data->passingGrade->pilihan3->jurusan : "-" }}</div></td>
        </tr>
        <tr valign="top">
            <td width="170px">Keterangan</td>
            <td></td>
            <td colspan="3"><div class="box">{{ $data->id_passing_grade_lolos == null ? "Anda Tidak Lulus" : "Lulus di " . strtoupper($data->passingGradeLolos->jurusan) . " " . strtoupper($data->passingGradeLolos->universitas->nama) }}</div></td>
        </tr>
        <tr valign="top">
            <td width="170px">Rekomendasi Konsultasi</td>
            <td></td>
            <td colspan="3"><textarea class="box" style="height: 60px"></textarea></td>
        </tr>
        <tr valign="top">
            <td colspan="2"></td>
            <td colspan="3" class="text-right">Bandar Lampung, {{ tanggal(date("Y-m-d")) }}</td>
        </tr>
        <tr valign="top">
            <td colspan="2"></td>
            <td colspan="2"></td>
        </tr>
        <tr valign="top">
            <td colspan="2"></td>
            <td colspan="3" class="text-right">
                <div class="" style="margin-top: 2cm">
                    (________________________________)
                </div>
            </td>
        </tr>
    </table>
    @if($index+1 < $peserta->count())
    <div class="page-break"></div>
    @endif
    @endforeach
</body>
</html>
