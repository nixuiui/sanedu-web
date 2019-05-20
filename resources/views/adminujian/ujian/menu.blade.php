<ul class="nav">
    <li class="{{ active(['admin.ujian.soal.kelola']) }}">
        <a href="{{ route('admin.ujian.soal.kelola', $ujian->id) }}">
            <span class="label label-primary">{{ $jumlahSoal }}</span><i class="icon mdi mdi-layers"></i>
            Soal
        </a>
    </li>
    <li class="{{ active(['admin.ujian.soal.peserta']) }}">
        <a href="{{ route('admin.ujian.soal.peserta', $ujian->id) }}">
            <span class="label label-primary">{{ $jumlahPeserta }}</span><i class="icon mdi mdi-accounts-alt"></i>
            Peserta Ujian
        </a>
    </li>
    <li class="{{ active(['admin.ujian.soal.history']) }}">
        <a href="{{ route('admin.ujian.soal.history', $ujian->id) }}">
            <span class="label label-primary">{{ $jumlahRiwayat }}</span><i class="icon mdi mdi-assignment"></i>
            Riwayat Pengerjaan
        </a>
    </li>
    <li class="{{ active(['admin.ujian.soal.analitik']) }}">
        <a href="{{ route('admin.ujian.soal.analitik', $ujian->id) }}">
            <span class="label label-primary"></span><i class="icon mdi mdi-trending-up"></i>
            Analitik Soal
        </a>
    </li>
    <li class="{{ active(['admin.ujian.form.peraturan']) }}">
        <a href="{{ route('admin.ujian.form.peraturan', $ujian->id) }}">
            <i class="icon mdi mdi-grain"></i>
            Peraturan Ujian
        </a>
    </li>
    <li class="{{ active(['admin.ujian.soal.setting']) }}">
        <a href="{{ route('admin.ujian.soal.setting', $ujian->id) }}">
            <i class="icon mdi mdi-settings"></i>
            Pengaturan
        </a>
    </li>
</ul>
@if(!$ujian->is_published)
<div class="aside-compose"><a href="{{ route("admin.ujian.soal.publish", $ujian->id) }}" class="btn btn-lg btn-primary btn-block btn-rounded">PUBLISH UJIAN<i class="mdi mdi-mail-send ml-4"></i></a></div>
@endif
