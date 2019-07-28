@section('menu-title')
    Passing Grde
@endsection
<ul class="nav">
    <li class="{{ active(['admin.passgrade', 'admin.passgrade.form.univ', 'admin.passgrade.open.univ', 'admin.passgrade.form.jurusan']) }}">
        <a href="{{ route('admin.passgrade') }}">
            <i class="icon mdi mdi-graduation-cap"></i>
            Passing Grade
        </a>
    </li>
    <li class="{{ active(['admin.passgrade.tiket', 'admin.passgrade.tiket.*']) }}">
        <a href="{{ route('admin.passgrade.tiket') }}">
            <i class="icon mdi mdi-ticket-star"></i>
            Voucher
        </a>
    </li>
</ul>