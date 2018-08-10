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
            </ul>
        </div>
    </div>
</div>
