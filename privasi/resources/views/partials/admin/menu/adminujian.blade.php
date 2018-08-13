<div class="left-sidebar-spacer">
    <div class="left-sidebar-scroll">
        <div class="left-sidebar-content">
            <ul class="sidebar-elements">
                <li class="divider">Menu</li>
                <li class="{{ active(['admin']) }}">
                    <a href="{{ route('admin') }}"><i class="icon mdi mdi-home"></i><span>Beranda</span></a>
                </li>
                <li class="{{ active(['admin.ujian.soal', 'admin.ujian.soal.*']) }}">
                    <a href="{{ route('admin.ujian.soal') }}"><i class="icon mdi mdi-desktop-mac"></i><span>Ujian</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
