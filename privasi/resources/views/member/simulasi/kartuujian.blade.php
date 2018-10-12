<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>TANDA BUKTI PEMBAYARAN</title>
    <style media="screen">
    @page {
        margin: 0;
    }
    body {
        font-family: helvetica;
        margin: 0;
        padding: 0;
    }
    .col {
        width: 100%;
    }
    .wrapper {
        border: 2px dashed #BBB;
        box-sizing: border-box;
        margin: 10px;
        padding: 10px;
        overflow: hidden;
    }
    header {
        border: 1px solid #AAA;
        padding: 7px;
        overflow: hidden;
        margin-bottom: 10px;
        clear: both;
    }
    header * {
        display: inline-block;
    }
    header img {
        width: 50px;
        margin-left: 10px;
        box-sizing: border-box;
    }
    header h1 {
        width: 400px;
        box-sizing: border-box;
        padding: 5px;
        font-size: 22px;
        text-align: center;
        margin: 0;
        color: #333;
        font-family: helvetica;
        font-weight: 600;
    }

    .box {
        border: 1px solid #AAA;
        padding: 10px;
        margin-bottom: 10px;
    }

    .pengumuman {
        font-size: 14px;
    }

    .text-center {
        text-align: center;
    }
    .text-red {
        color: red;
    }

    table.alamat td, table.alamat th {
        vertical-align: top;
        text-align: left;
        font-family: helvetica;
        font-size: 16px;
    }

    table.lokasi-ujian td, table.alamat th {
        vertical-align: top;
        text-align: left;
        font-family: helvetica;
        font-size: 13px;
        font-weight: bold;
    }

    .qrcode {
        margin: 0 auto;
        text-align: center;
    }
    .qrcode img {
        height: 93px;
    }
    .text {
        font-weight: 400;
        font-size: 12px;
        margin: 5px 0 0 10px;
    }
    table.jadwal {
        width: 100%;
        box-sizing: border-box;
        border-spacing: 0;
    }
    table.jadwal td, table.jadwal th {
        border: 1px solid #EFEFEF;
        margin: 0;
        padding: 5px;
        font-size: 12px;
    }
    table.jadwal td {
        text-align: left;
    }
    table.jadwal td.text-center {
        text-align: center;
    }
    table.ttd {
        width: 100%;
        margin-top: 15px;
    }
    table.ttd th {
        text-align: left;
        font-weight: bold;
        font-size: 12px;
    }
    table.ttd td {
        border-bottom: 1px dashed #AAA;
    }


    .perlengkapan {
        font-weight: bold;
    }
    .title-box {
        font-weight: bold;
        font-size: 14px;
        margin: 0;
    }
    .perlengkapan ul {
        font-size: 14px;
        margin: 5px 0;
    }
    .perlengkapan ul li {
        list-style: square;
    }

    table.isi-alamat {
        font-size: 14px;
        margin: 10px;
        width: 100%;
        box-sizing: border-box;
    }
    table.isi-alamat tr td ~ td {
        border-bottom: 1px solid #AAA;
        padding: 5px;
        height: 16px;
    }

    ul.prodi {
        font-weight: bold;
        margin: 5px;
    }
    ul.prodi li {
        list-style: none;
        margin: 0;
    }
    ul.prodi strong {
        display: block;
    }
    ul.prodi span {
        font-weight: normal;
        display: block;
        box-sizing: border-box;
        margin-left: 10px;
    }

    #table-main {
        width: 1120px;
    }
    #table-main tr td.column {
        width: 50%;
        vertical-align: top;
    }
    </style>
</head>
<body>
    <div class="body">
        <table id="table-main">
            <tr>
                <td class="column">
                    <div class="col">
                        <div class="wrapper">
                            <header style="padding-top: 25px">
                                <img src="{{ asset('asset-beagle/img/logo-san.png')}}" alt="">
                                <h1>TANDA BUKTI PENDAFTARAN SIMULASI SBMPTN</h1>
                            </header>
                            <div class="box">
                                <table class="alamat">
                                    <tr>
                                        <th>NOMOR PESERTA </th>
                                        <th> : {{ $peserta->no_peserta }}</th>
                                    </tr>
                                    <tr>
                                        <th>NAMA PESERTA </th>
                                        <th> : {{ $peserta->profil->nama }}</th>
                                    </tr>
                                    <tr>
                                        <th>KELOMPOK UJIAN </th>
                                        <th> : {{ $peserta->mapel->nama }}</th>
                                    </tr>
                                </table>
                            </div>
                            <div class="box">
                                <table class="alamat">
                                    <tr>
                                        <td>ALAMAT : </td>
                                        <td>
                                            {{ $peserta->profil->alamat }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="box text-center pengumuman" style="font-size: 19px;">
                                TRY OUT SIMULASI SBMPTN SANEDU AKAN DILAKSANKAN <br>
                                <strong class="text-red">{{ strtoupper(tanggal($peserta->simulasi->tanggal_pelaksanaan)) }}</strong>
                            </div>
                            <div class="box text-center pengumuman" style="font-size: 16px;">
                                PENGUMUMAN DILIHAT MELALUI WEBSITE PENDAFTARAN SANEDU.ID <br>
                                <strong class="text-red">{{ strtoupper(tanggal($peserta->simulasi->tanggal_pelaksanaan)) }}</strong>
                            </div>
                            <div class="box text-center">
                                <table class="jadwal">
                                    <tr>
                                        <th width="100px">Waktu</th>
                                        <th>Tempat</th>
                                        <th>Kegiatan</th>
                                    </tr>
                                    @foreach($peserta->simulasi->agenda as $agenda)
                                    <tr>
                                        <td class="text-center">{{ jamMenit($agenda->waktu_mulai) }} - {{ jamMenit($agenda->waktu_selesai) }}</td>
                                        <td>{{ $agenda->tempat }}</td>
                                        <td>{{ $agenda->nama_agenda }}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="column">
                    <div class="col">
                        <div class="wrapper">
                            <div class="box">
                                <p class="title-box">ALAMAT PADA SAAT MENGIKUTI UJIAN (HARUS DIISI)</p>
                                <table class="isi-alamat">
                                    <tr>
                                        <th width="20px;">ALAMAT</th>
                                        <td width="2px;">:</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>TELPON</th>
                                        <td>:</td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="box perlengkapan">
                                <p class="title-box">PILIHAN PROGRAM STUDI : </p>
                                <ul class="prodi">
                                    <li>
                                        <strong>{{ $peserta->passingGrade->pilihan1->universitas->nama }}</strong>
                                        <span>{{ $peserta->passingGrade->pilihan1->jurusan }}</span>
                                    </li>
                                    <li>
                                        <strong>{{ $peserta->passingGrade->pilihan2->universitas->nama }}</strong>
                                        <span>{{ $peserta->passingGrade->pilihan2->jurusan }}</span>
                                    </li>
                                    <li>
                                        <strong>{{ $peserta->passingGrade->pilihan3->universitas->nama }}</strong>
                                        <span>{{ $peserta->passingGrade->pilihan3->jurusan }}</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="box">
                                <p class="title-box">LOKASI UJIAN</p>
                                <table class="lokasi-ujian">
                                    <tr>
                                        <td>ALAMAT: {{ $peserta->ruang->nama }} - {{ $peserta->ruang->alamat }}</td>
                                    </tr>
                                </table>
                                <div class="qrcode">
                                    <img src="{{ asset('assets/img/qrcode.jpg') }}">
                                </div>
                                <p class="title-box" style="font-size: 12px;">LOKASI UJIAN TULIS BISA DILIHAT SATU HARI SEBELUM PELAKSANAAN UJIAN</p>
                            </div>
                            <div class="box perlengkapan">
                                <p class="title-box">PERNYATAAN</p>
                                <p class="text">DENGAN INI SAYA MENYATAKAN BAHWA DATA YANG SAYA ISIKAN DALAM BORANG PENDAFTARAN ONLINE SNMPTN JALUR UJIAN TERTULIS 2018 ADALAH BENAR. SAYA BERSEDIA MENERIMA SANKSI PEMBATALAN PENERIMAAN DI PTN YANG SAYA PILIH APABILA MELANGGAR PERNYATAAN INI.</p>
                                <table class="ttd">
                                    <tr>
                                        <th width="230px">TANDA TANGAN DAN NAMA TERANG : </th>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="box perlengkapan">
                                <p class="title-box">PERLENGKAPAN YANG HARUS DIBAWA PADA  SAAT UJIAN :</p>
                                <ul>
                                    <li>Kartu bukti pendaftaran ini</li>
                                    <li>Kartu identitas asli (KTP, SIM, dll.)</li>
                                    <li>Pensil 2B secukupnya, karet penghapus, peraturan pensil (jika diperlukan)</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <!-- <div class="body">
        <div class="page-container">
            <div class="col">
                <div class="wrapper">
                    <header>
                        <img src="{{ asset('asset-beagle/img/logo-san.png')}}" alt="">
                        <h1>TANDA BUKTI PENDAFTARAN SIMULASI SBMPTN</h1>
                    </header>
                    <div class="box">
                        <table class="alamat">
                            <tr>
                                <th>NOMOR PESERTA </th>
                                <th> : {{ $peserta->no_peserta }}</th>
                            </tr>
                            <tr>
                                <th>NAMA PESERTA </th>
                                <th> : {{ $peserta->profil->nama }}</th>
                            </tr>
                            <tr>
                                <th>KELOMPOK UJIAN </th>
                                <th> : {{ $peserta->mapel->nama }}</th>
                            </tr>
                        </table>
                    </div>
                    <div class="box">
                        <table class="alamat">
                            <tr>
                                <td>ALAMAT : </td>
                                <td>
                                    {{ $peserta->profil->alamat }}
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="box text-center pengumuman" style="font-size: 19px;">
                        TRY OUT SIMULASI SBMPTN SANEDU AKAN DILAKSANKAN <br>
                        <strong class="text-red">{{ strtoupper(tanggal($peserta->simulasi->tanggal_pelaksanaan)) }}</strong>
                    </div>
                    <div class="box text-center pengumuman" style="font-size: 16px;">
                        PENGUMUMAN DILIHAT MELALUI WEBSITE PENDAFTARAN SANEDU.ID <br>
                        <strong class="text-red">{{ strtoupper(tanggal($peserta->simulasi->tanggal_pelaksanaan)) }}</strong>
                    </div>
                    <div class="box text-center">
                        <table class="jadwal">
                            <tr>
                                <th width="100px">Waktu</th>
                                <th>Tempat</th>
                                <th>Kegiatan</th>
                            </tr>
                            @foreach($peserta->simulasi->agenda as $agenda)
                            <tr>
                                <td class="text-center">{{ jamMenit($agenda->waktu_mulai) }} - {{ jamMenit($agenda->waktu_selesai) }}</td>
                                <td>{{ $agenda->tempat }}</td>
                                <td>{{ $agenda->nama_agenda }}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="wrapper">
                    <div class="box">
                        <p class="title-box">ALAMAT PADA SAAT MENGIKUTI UJIAN (HARUS DIISI)</p>
                        <table class="isi-alamat">
                            <tr>
                                <th width="20px;">ALAMAT</th>
                                <td width="2px;">:</td>
                                <td></td>
                            </tr>
                            <tr>
                                <th></th>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>TELPON</th>
                                <td>:</td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                    <div class="box perlengkapan">
                        <p class="title-box">PILIHAN PROGRAM STUDI : </p>
                        <ul class="prodi">
                            <li>
                                <strong>{{ $peserta->passingGrade->pilihan1->universitas->nama }}</strong>
                                <span>{{ $peserta->passingGrade->pilihan1->jurusan }}</span>
                            </li>
                            <li>
                                <strong>{{ $peserta->passingGrade->pilihan2->universitas->nama }}</strong>
                                <span>{{ $peserta->passingGrade->pilihan2->jurusan }}</span>
                            </li>
                            <li>
                                <strong>{{ $peserta->passingGrade->pilihan3->universitas->nama }}</strong>
                                <span>{{ $peserta->passingGrade->pilihan3->jurusan }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="box">
                        <p class="title-box">LOKASI UJIAN</p>
                        <table class="lokasi-ujian">
                            <tr>
                                <td>ALAMAT: {{ $peserta->ruang->nama }} - {{ $peserta->ruang->alamat }}</td>
                            </tr>
                        </table>
                        <div class="qrcode">
                            <img src="{{ asset('assets/img/qrcode.jpg') }}">
                        </div>
                        <p class="title-box" style="font-size: 12px;">LOKASI UJIAN TULIS BISA DILIHAT SATU HARI SEBELUM PELAKSANAAN UJIAN</p>
                    </div>
                    <div class="box perlengkapan">
                        <p class="title-box">PERNYATAAN</p>
                        <p class="text">DENGAN INI SAYA MENYATAKAN BAHWA DATA YANG SAYA ISIKAN DALAM BORANG PENDAFTARAN ONLINE SNMPTN JALUR UJIAN TERTULIS 2018 ADALAH BENAR. SAYA BERSEDIA MENERIMA SANKSI PEMBATALAN PENERIMAAN DI PTN YANG SAYA PILIH APABILA MELANGGAR PERNYATAAN INI.</p>
                        <table class="ttd">
                            <tr>
                                <th width="230px">TANDA TANGAN DAN NAMA TERANG : </th>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                    <div class="box perlengkapan">
                        <p class="title-box">PERLENGKAPAN YANG HARUS DIBAWA PADA  SAAT UJIAN :</p>
                        <ul>
                            <li>Kartu bukti pendaftaran ini</li>
                            <li>Kartu identitas asli (KTP, SIM, dll.)</li>
                            <li>Pensil 2B secukupnya, karet penghapus, peraturan pensil (jika diperlukan)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</body>
</html>
