@section('menu-title')
    Pengaturan
@endsection
<ul class="nav">
    <li class="{{ active(['admin.setting.metode.pembayaran']) }}">
        <a href="{{ route('admin.setting.metode.pembayaran') }}">
            <i class="icon mdi mdi-card"></i>
            Metode Pembayaran
        </a>
    </li>
</ul>
