<ul class="nav">
    <li class="{{ active(['admin.member']) }}">
        <a href="{{ route('admin.member') }}">
            <i class="icon mdi mdi-accounts"></i>
            Member Sanedu
        </a>
    </li>
    <li class="{{ active(['admin.member.provinsi']) }}">
        <a href="{{ route('admin.member.provinsi') }}">
            <i class="icon mdi mdi-city"></i>
            Provinsi
        </a>
    </li>
</ul>
