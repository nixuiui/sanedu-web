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
                <li class="{{ active(['user']) }}" title="Beranda">
                    <a href="{{ route('user') }}"><i class="icon mdi mdi-home"></i><span>Beranda</span></a>
                </li>
                <li class="{{ active(['user.passgrade', 'user.passgrade.*']) }}" title="Informasi">
                    <a href="{{ route('user.passgrade') }}"><i class="icon mdi mdi-graduation-cap"></i><span>Passing Grade</span></a>
                </li>
                <li class="{{ active(['member.simulasi', 'member.simulasi.*']) }}" title="Informasi">
                    <a href="{{ route('member.simulasi') }}"><i class="icon mdi mdi-file-text"></i><span>Simulasi</span></a>
                </li>
                <li class="{{ active(['member.grupchat', 'member.grupchat.*']) }}" title="Join Grup Chat">
                    <a href="{{ route('member.grupchat') }}"><i class="icon mdi mdi-accounts-add"></i><span>Join Grup Chat</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
