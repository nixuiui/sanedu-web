
<nav class="navbar navbar-default navbar-fixed-top be-top-header">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="{{ route('guest.home') }}" class="navbar-brand" style="background: none;"></a>
        </div>
        <div class="be-right-navbar">
            <div class="page-title"><span>{{ Auth::user()->role->nama }}</span></div>
            <ul class="nav navbar-nav navbar-right be-user-nav">
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle">
                        <img src="{{ asset('asset-beagle/img/avatar.png')}}" alt="Avatar">
                        <span class="user-name">{{ Auth::user()->nama }}</span>
                    </a>
                    <ul role="menu" class="dropdown-menu">
                        <li>
                            <div class="user-info">
                                <div class="user-name"></div>
                                <div class="user-position online">{{ Auth::user()->nama }}</div>
                            </div>
                        </li>
                        @if(Auth::user()->id_role == 1004)
                        <li>
                            <div class="user-info-second" style="background: #FFF; margin-bottom: 0;">
                                @if(Auth::user()->pin == null || Auth::user()->kap == null)
                                <a href="{{ route('member.profil.edit') }}" class="btn btn-md btn-warning">Masukan No Tiket</a>
                                @else
                                <strong>PIN: </strong> {{ Auth::user()->pin }} <br>
                                <strong>KAP: </strong> {{ Auth::user()->kap }}
                                @endif
                            </div>
                        </li>
                        <hr>
                        <li><a href="{{ route('member.profil.edit') }}"><span class="icon mdi mdi-settings"></span> Ubah Profil</a></li>
                        @endif
                        @if(Auth::user()->id_role == 1001 || Auth::user()->id_role == 1002 || Auth::user()->id_role == 1003)
                        <li><a href="{{ route('alladmin.profil.edit') }}"><span class="icon mdi mdi-settings"></span> Ubah Profil</a></li>
                        @endif
                        <li><a href="{{ route('auth.logout') }}"><span class="icon mdi mdi-power"></span> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
