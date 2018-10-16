<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>TANDA BUKTI PEMBAYARAN</title>
        <style media="screen">
        body {
            font-family: helvetica;
        }
        .page-container {
            background: #FFF;
            width: 347mm;
            overflow: hidden;
        }
        .col:nth-child(1){
            border-right: 1px solid #AAA;
            box-sizing: border-box;
        }
        .col {
            width: 50%;
            float: left;
        }
        .wrapper {
            border: 2px dashed #BBB;
            box-sizing: border-box;
            margin: 15px;
            padding: 10px;
            height: calc(210mm - 30px);
        }
        header {
            border: 1px solid #AAA;
            padding: 7px;
            overflow: hidden;
            margin-bottom: 10px;
        }
        header * {
            float: left;
        }
        header img {
            width: 70px;
            box-sizing: border-box;
        }
        header h1 {
            width: 500px;
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
            width: 570px;
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
        </style>
    </head>
    <body>
        <div class="body">
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
                                <th> : {{ $peserta->user->nama }}</th>
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
                                    {{ $peserta->user->alamat }}
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
        </div>
    </body>
</html>
