<div class="left-sidebar-spacer">
    <div class="left-sidebar-scroll">
        <div class="left-sidebar-content">
            <ul class="sidebar-elements">
                <li class="divider">Menu</li>
                <li class="{{ active(['superadmin']) }}">
                    <a href="{{ route('superadmin') }}"><i class="icon mdi mdi-home"></i><span>Beranda</span></a>
                </li>
                <li class="{{ active(['superadmin.user', 'superadmin.user.*']) }}">
                    <a href="{{ route('superadmin.user') }}"><i class="icon mdi mdi-accounts-list-alt"></i><span>Kelola Pengguna</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
