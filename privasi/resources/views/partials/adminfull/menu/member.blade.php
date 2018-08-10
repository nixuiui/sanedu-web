<div class="left-sidebar-spacer">
    <div class="left-sidebar-scroll">
        <div class="left-sidebar-content">
            <ul class="sidebar-elements">
                <li class="#">
                    <a href="#">
                        <i class="icon mdi mdi-money-box"></i><span>Saldo</span>
                        <strong class="pull-right text-success">Rp. 100.000</strong>
                    </a>
                </li>
                <li class="divider">Menu</li>
                <li class="{{ active(['member']) }}">
                    <a href="{{ route('member') }}"><i class="icon mdi mdi-home"></i><span>Beranda</span></a>
                </li>
                <li class="parent">
                    <a href="#"><i class="icon mdi mdi-desktop-mac"></i><span>Ujian</span></a>
                    <ul class="sub-menu">
                        <li class=""><a href="#">Soal</a></li>
                        <li class=""><a href="#">History</a></li>
                    </ul>
                </li>
                <li class="parent">
                    <a href="#"><i class="icon mdi mdi-info-outline"></i><span>Informasi</span></a>
                    <ul class="sub-menu">
                        <li class=""><a href="#">Passing Grade</a></li>
                        <li class=""><a href="#">Beasiswa</a></li>
                        <li class=""><a href="#">Universitas</a></li>
                        <li class=""><a href="#">Peluang Kerja</a></li>
                    </ul>
                </li>
                <li class="">
                    <a href="#"><i class="icon mdi mdi-file-text"></i><span>Simulasi</span></a>
                </li>
                <li class="">
                    <a href="#"><i class="icon mdi mdi-accounts-alt"></i><span>Privat</span></a>
                </li>
                <li class="{{ active(['member.grupchat', 'member.grupchat.*']) }}">
                    <a href="#"><i class="icon mdi mdi-accounts-add"></i><span>Join Grup Chat</span></a>
                </li>
                <li class="">
                    <a href="#"><i class="icon mdi mdi-dot-circle"></i><span>Poin</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="progress-widget">
    <span class="text-muted" style="font-size: 11px;">Powered by Capung Technology</span>
</div>
