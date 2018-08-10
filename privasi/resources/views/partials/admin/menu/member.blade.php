<div class="left-sidebar-spacer">
    <div class="left-sidebar-scroll">
        <div class="left-sidebar-content">
            <ul class="sidebar-elements">
                <li class="#">
                    <a href="#">
                        <i class="icon mdi mdi-money-box"></i><span>Saldo</span>
                        <strong class="pull-right text-success">{{ formatUang(Auth::user()->saldo) }}</strong>
                    </a>
                </li>
                <li class="divider">Menu</li>
                <li class="{{ active(['member']) }}">
                    <a href="{{ route('member') }}"><i class="icon mdi mdi-home"></i><span>Beranda</span></a>
                </li>
                <li class="parent">
                    <a href="#"><i class="icon mdi mdi-desktop-mac"></i><span>Ujian</span></a>
                    <ul class="sub-menu">
                        <li class="{{ active(['member.ujian.soal', 'member.ujian.soal.*']) }}"><a href="{{ route('member.ujian.soal') }}">Soal</a></li>
                        <li class=""><a href="#">History</a></li>
                    </ul>
                </li>
                <li class="parent {{ active(['member.informasi', 'member.informasi.*'], "active open") }}">
                    <a href="#"><i class="icon mdi mdi-info-outline"></i><span>Informasi</span></a>
                    <ul class="sub-menu">
                        <li class=""><a href="{{ route('member.informasi') }}">Semua Informasi</a></li>
                        <li class=""><a href="{{ route('member.informasi', ['kategori' => 1701]) }}">Beasiswa</a></li>
                        <li class=""><a href="{{ route('member.informasi', ['kategori' => 1702]) }}">Universitas</a></li>
                        <li class=""><a href="{{ route('member.informasi', ['kategori' => 1703]) }}">Peluang Kerja</a></li>
                        <li class=""><a href="{{ route('member.passgrade') }}">Passing Grade</a></li>
                    </ul>
                </li>
                <li class="">
                    <a href="#"><i class="icon mdi mdi-file-text"></i><span>Simulasi</span></a>
                </li>
                <li class="">
                    <a href="#"><i class="icon mdi mdi-accounts-alt"></i><span>Privat</span></a>
                </li>
                <li class="{{ active(['member.grupchat', 'member.grupchat.*']) }}">
                    <a href="{{ route('member.grupchat') }}"><i class="icon mdi mdi-accounts-add"></i><span>Join Grup Chat</span></a>
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
