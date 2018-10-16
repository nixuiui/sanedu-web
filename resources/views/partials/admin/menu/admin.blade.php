<div class="left-sidebar-spacer">
    <div class="left-sidebar-scroll">
        <div class="left-sidebar-content">
            <ul class="sidebar-elements">
                <li class="divider">Menu</li>
                <li class="{{ active(['admin']) }}">
                    <a href="{{ route('admin') }}"><i class="icon mdi mdi-home"></i><span>Beranda</span></a>
                </li>
                <li class="parent">
                    <a href="#"><i class="icon mdi mdi-ticket-star"></i><span>Tiket</span></a>
                    <ul class="sub-menu">
                        <li class="{{ active(['admintiket.tiket.member', 'admintiket.tiket.member.*']) }}"><a href="{{ route('admintiket.tiket.member') }}">Member</a></li>
                        <li class=""><a href="{{ route('admintiket') }}">User</a></li>
                        <li class=""><a href="{{ route('admintiket') }}">Partisipan</a></li>
                    </ul>
                </li>
                <li class="{{ active(['admin.grupchat']) }}">
                    <a href="{{ route('admin.grupchat') }}"><i class="icon mdi mdi-comments"></i><span>Grup Chat</span></a>
                </li>
                <li class="{{ active(['admin.informasi', 'admin.informasi.*']) }}">
                    <a href="{{ route('admin.informasi') }}"><i class="icon mdi mdi-info-outline"></i><span>Informasi</span></a>
                </li>
                <li class="{{ active(['admin.passgrade', 'admin.passgrade.*']) }}">
                    <a href="{{ route('admin.passgrade') }}"><i class="icon mdi mdi-graduation-cap"></i><span>Passing Grade</span></a>
                </li>
                <li class="{{ active(['admin.ujian.soal', 'admin.ujian.soal.*']) }}">
                    <a href="{{ route('admin.ujian.soal') }}"><i class="icon mdi mdi-desktop-mac"></i><span>Ujian</span></a>
                </li>
                <li class="{{ active(['adminsimulasi.simulasi', 'adminsimulasi.simulasi.*']) }}">
                    <a href="{{ route('adminsimulasi.simulasi') }}"><i class="icon mdi mdi-assignment"></i><span>Simulasi</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
