<div class="left-sidebar-spacer">
    <div class="left-sidebar-scroll">
        <div class="left-sidebar-content">
            <ul class="sidebar-elements">
                <li class="divider">Menu</li>
                <li class="{{ active(['pengawas']) }}">
                    <a href="{{ route('pengawas') }}"><i class="icon mdi mdi-home"></i><span>Beranda</span></a>
                </li>
                <li class="{{ active(['pengawas.simulasi', 'pengawas.simulasi.*']) }}">
                    <a href="{{ route('pengawas.simulasi') }}"><i class="icon mdi mdi-assignment"></i><span>Simulasi</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
