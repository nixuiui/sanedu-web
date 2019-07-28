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
</ul>
