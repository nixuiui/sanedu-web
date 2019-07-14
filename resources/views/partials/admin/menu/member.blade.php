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
                <li class="{{ active(['guest.home']) }}" title="Beranda">
                    <a href="{{ route('guest.home') }}"><i class="icon mdi mdi-home"></i><span>Beranda</span></a>
                </li>
                <li class="{{ active(['member.ujian.*']) }}" title="Ujian">
                    <a href="{{ route('member.ujian.soal') }}"><i class="icon mdi mdi-desktop-mac"></i><span>Ujian</span></a>
                </li>
                <li class="{{ active(['member.informasi', 'member.informasi.*']) }}" title="Informasi">
                    <a href="{{ route('member.informasi') }}"><i class="icon mdi mdi-info-outline"></i><span>Informasi</span></a>
                </li>
                <li class="{{ active(['member.passgrade', 'member.passgrade.*']) }}" title="Informasi">
                    <a href="#"><i class="icon mdi mdi-graduation-cap"></i><span>Passing Grade</span></a>
                </li>
                <li class="{{ active(['member.simulasi', 'member.simulasi.*']) }}" title="Informasi">
                    <a href="{{ route('member.simulasi') }}"><i class="icon mdi mdi-file-text"></i><span>Simulasi</span></a>
                </li>
                <li class="{{ active(['member.grupchat', 'member.grupchat.*']) }}" title="Join Grup Chat">
                    <a href="{{ route('member.grupchat') }}"><i class="icon mdi mdi-whatsapp"></i><span>Join Grup Chat</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="progress-widget">
</div>
