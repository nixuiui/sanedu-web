<div class="left-sidebar-spacer">
    <div class="left-sidebar-scroll">
        <div class="left-sidebar-content">
            <ul class="sidebar-elements">
                <li class="#">
                    <a href="#">
                        <i class="icon mdi mdi-money-box"></i><span>Saldo <strong class="text-success ml-3">{{ formatUang(Auth::user()->saldo) }}</strong></span>

                    </a>
                </li>
                <li class="divider">Menu</li>
                <li class="{{ active(['member']) }}" title="Beranda">
                    <a href="{{ route('member') }}"><i class="icon mdi mdi-home"></i><span>Beranda</span></a>
                </li>
                <li class="parent" title="Ujian">
                    <a href="#"><i class="icon mdi mdi-desktop-mac"></i><span>Ujian</span></a>
                    <ul class="sub-menu">
                        <li class="{{ active(['member.ujian.soal', 'member.ujian.soal.*']) }}"><a href="{{ route('member.ujian.soal') }}">Soal</a></li>
                        <li class="{{ active(['member.ujian.soal.list.dibeli', 'member.ujian.soal.list.dibeli*']) }}"><a href="{{ route('member.ujian.soal.list.dibeli') }}">Soal Yang Anda Beli</a></li>
                        <li class="{{ active(['member.ujian.soal.history', 'member.ujian.soal.history.*']) }}"><a href="{{ route('member.ujian.soal.history') }}">History</a></li>
                    </ul>
                </li>
                <li class="parent {{ active(['member.informasi', 'member.informasi.*'], "active open") }}" title="Informasi">
                    <a href="#"><i class="icon mdi mdi-info-outline"></i><span>Informasi</span></a>
                    <ul class="sub-menu">
                        <li class=""><a href="{{ route('member.informasi') }}">Semua Informasi</a></li>
                        <li class=""><a href="{{ route('member.informasi', ['kategori' => 1701]) }}">Beasiswa</a></li>
                        <li class=""><a href="{{ route('member.informasi', ['kategori' => 1702]) }}">Universitas</a></li>
                        <li class=""><a href="{{ route('member.informasi', ['kategori' => 1703]) }}">Peluang Kerja</a></li>
                        <li class=""><a href="{{ route('member.passgrade') }}">Passing Grade</a></li>
                    </ul>
                </li>
                <li class="" title="Simulasi">
                    <a href="#"><i class="icon mdi mdi-file-text"></i><span>Simulasi</span></a>
                </li>
                <li class="" title="Privat">
                    <a href="#"><i class="icon mdi mdi-accounts-alt"></i><span>Privat</span></a>
                </li>
                <li class="{{ active(['member.grupchat', 'member.grupchat.*']) }}" title="Join Grup Chat">
                    <a href="{{ route('member.grupchat') }}"><i class="icon mdi mdi-accounts-add"></i><span>Join Grup Chat</span></a>
                </li>
                <li class="" title="Poin">
                    <a href="#"><i class="icon mdi mdi-dot-circle"></i><span>Poin</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="progress-widget">
</div>
