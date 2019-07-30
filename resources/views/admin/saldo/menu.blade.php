@section('menu-title')
    Saldo
@endsection
<ul class="nav">
    <li class="{{ active(['admin.saldo']) }}">
        <a href="{{ route('admin.saldo') }}">
            <i class="icon mdi mdi-upload"></i>
            Request Top-up
        </a>
    </li>
    <li class="{{ active(['admin.saldo.topup']) }}">
        <a href="{{ route('admin.saldo.topup') }}">
            <i class="icon mdi mdi-assignment"></i>
            Riwayat Top-up
        </a>
    </li>
</ul>
