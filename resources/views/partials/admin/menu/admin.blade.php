<div class="left-sidebar-spacer">
    <div class="left-sidebar-scroll">
        <div class="left-sidebar-content">
            <ul class="sidebar-elements">
                <li class="divider">Menu</li>
                <li class="{{ active(['admin']) }}">
                    <a href="{{ route('admin') }}"><i class="icon mdi mdi-home"></i><span>Beranda</span></a>
                </li>
                <li class="{{ active(['admin.grupchat']) }}">
                    <a href="{{ route('admin.grupchat') }}"><i class="icon mdi mdi-whatsapp"></i><span>Grup Chat</span></a>
                </li>
                <li class="{{ active(['admin.informasi', 'admin.informasi.*']) }}">
                    <a href="{{ route('admin.informasi') }}"><i class="icon mdi mdi-info-outline"></i><span>Informasi</span></a>
                </li>
                <li class="{{ active(['admin.passgrade', 'admin.passgrade.*']) }}">
                    <a href="{{ route('admin.passgrade') }}"><i class="icon mdi mdi-graduation-cap"></i><span>Passing Grade</span></a>
                </li>
                <li class="{{ active(['admin.sekolah', 'admin.sekolah.*']) }}">
                    <a href="{{ route('admin.sekolah') }}"><i class="icon mdi mdi-balance"></i><span>Data Sekolah</span></a>
                </li>
                <li class="{{ active(['admin.ujian.soal', 'admin.ujian.soal.*']) }}">
                    <a href="{{ route('admin.ujian.soal') }}"><i class="icon mdi mdi-desktop-mac"></i><span>Ujian</span></a>
                </li>
                <li class="{{ active(['adminsimulasi.simulasi', 'adminsimulasi.simulasi.*']) }}">
                    <a href="{{ route('adminsimulasi.simulasi') }}"><i class="icon mdi mdi-assignment"></i><span>Simulasi</span></a>
                </li>
                <li class="{{ active(['admin.member', 'admin.member.*']) }}">
                    <a href="{{ route('admin.member') }}"><i class="icon mdi mdi-accounts"></i><span>Member</span></a>
                </li>
                <li class="{{ active(['admin.setting', 'admin.setting.*']) }}">
                    <a href="{{ route('admin.setting') }}"><i class="icon mdi mdi-settings"></i><span>Member</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
