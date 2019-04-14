<ul class="nav">
    <li class="{{ active(['admin.sekolah']) }}">
        <a href="{{ route('admin.sekolah') }}">
            <i class="icon mdi mdi-balance"></i>
            Data Sekolah
        </a>
    </li>
    <li class="{{ active(['admin.sekolah.unchecked']) }}">
        <a href="{{ route('admin.sekolah.unchecked') }}">
            <span class="label label-primary">{{ $jumlahSekolahBaru }}</span><i class="icon mdi mdi-check-all"></i>
            Data Baru Masuk
        </a>
    </li>
    <li class="{{ active(['admin.sekolah.tambah']) }}">
        <a href="{{ route('admin.sekolah.tambah') }}">
            <i class="icon mdi mdi-plus"></i>
            Tambah Sekolah
        </a>
    </li>
</ul>
