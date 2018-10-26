<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title></title>
    <style>
    @page {
        margin: 1.5cm;
    }
    body { font-size: 14px; }
    h1 { font-size: 30px; margin-bottom: 1cm; }
    .page-break {
        page-break-after: always;
    }
    .text-center { text-align: center; }
    .text-right { text-align: right; }
    table.borang td { padding: 5px; }
    .box { border: 1px solid #333; padding: 3px; }
</style>
</head>
<body>
    @foreach($peserta as $data)
    <h1 class="text-center">BORANG LAPORAN REKOMENDASI</h1>
    <table class="borang" width="17cm">
        <tr>
            <td width="170px">Nama</td>
            <td width="5px">:</td>
            <td>{{ $data->profil->nama }}</td>
            <td></td>
        </tr>
        <tr>
            <td width="170px">No Ujian</td>
            <td>:</td>
            <td>{{ $data->profil->no_peserta }}</td>
        </tr>
        <tr>
            <td width="170px">Asal Sekolah</td>
            <td>:</td>
            <td>{{ $data->profil->asal_sekolah }}</td>
        </tr>
        <tr>
            <td width="170px">Jurusan Ujian</td>
            <td>:</td>
            <td>{{ $data->mapel->nama }}</td>
        </tr>
        <tr>
            <td width="170px">Hasil Ujian</td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td colspan="3">
                <div class="box">
                    <table width="100%">
                        <tr>
                            <td class="50%">B: </td>
                            <td class="50%">S: </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
        <tr>
            <td width="170px">Soal Sulit</td>
            <td></td>
            <td><div class="box"> &nbsp;</div></td>
        </tr>
        <tr>
            <td width="170px">Soal Sedang</td>
            <td></td>
            <td><div class="box"> &nbsp;</div></td>
        </tr>
        <tr>
            <td width="170px">Soal Mudah</td>
            <td></td>
            <td><div class="box"> &nbsp;</div></td>
        </tr>
        <tr>
            <td width="170px">Pilihan Saat Simulasi</td>
            <td></td>
            <td>Pilihan 1</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td><div class="box"> &nbsp;</div></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td><div class="box"> &nbsp;</div></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td>Pilihan 2</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td><div class="box"> &nbsp;</div></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td><div class="box"> &nbsp;</div></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td>Pilihan 3</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td><div class="box"> &nbsp;</div></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td><div class="box"> &nbsp;</div></td>
        </tr>
        <tr valign="top">
            <td width="170px">Keterangan</td>
            <td></td>
            <td colspan="2"><textarea class="box"></textarea></td>
        </tr>
        <tr valign="top">
            <td width="170px">Rekomendasi Konsultasi</td>
            <td></td>
            <td colspan="2"><textarea class="box"></textarea></td>
        </tr>
        <tr valign="top">
            <td colspan="2"></td>
            <td colspan="2" class="text-right">Bandar Lampung ....................................</td>
        </tr>
        <tr valign="top">
            <td colspan="2"></td>
            <td colspan="2"></td>
        </tr>
        <tr valign="top">
            <td colspan="2"></td>
            <td colspan="2" class="text-right">
                <div class="" style="margin-top: 2cm">
                    (________________________________)
                </div>
            </td>
        </tr>
    </table>
    <div class="page-break"></div>
    @endforeach
</body>
</html>
