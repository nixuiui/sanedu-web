@section('menu-title')
    Ujian
@endsection
<ul class="nav">
    <li class="{{ active(['admin.ujian.soal']) }}">
        <a href="{{ route('admin.ujian.soal') }}">
            <i class="icon mdi mdi-desktop-mac"></i>
            Semua Ujian
        </a>
    </li>
    <li class="{{ active(['admin.ujian.soal.tambah']) }}">
        <a href="{{ route('admin.ujian.soal.tambah') }}">
            <i class="icon mdi mdi-plus"></i>
            Tambah Ujian
        </a>
    </li>
    <li class="{{ active(['admin.ujian.soal.unpublish']) }}">
        <a href="{{ route('admin.ujian.soal.unpublish', ['publish' => 0]) }}">
            <i class="icon mdi mdi-airplane-off"></i>
            Unpublish Semua
        </a>
    </li>
</ul>
