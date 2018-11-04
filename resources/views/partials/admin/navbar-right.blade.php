<div class="be-right-navbar">
    <ul class="nav navbar-nav navbar-right be-user-nav">
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle">
                <img src="{{ asset('asset-beagle/img/avatar7.png')}}" alt="Avatar">
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
                <li>
                    <div class="user-info-second" style="background: #FFF; margin-bottom: 0; padding-top: 0;">
                        Saldo: <span class="text-success text-bold">{{ formatUang(Auth::user()->saldo) }}</span>
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
    <div class="page-title"><span>{{ Auth::user()->role->nama }}</span></div>
    <ul class="nav navbar-nav navbar-right be-icons-nav">
        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false"><span class="icon mdi mdi-notifications"></span><span class="indicator"></span></a>
            <ul class="dropdown-menu be-notifications">
                <li>
                    <div class="title">Notifications<span class="badge badge-pill">1</span></div>
                    <div class="list">
                        <div class="be-scroller ps-container ps-theme-default ps-active-y" data-ps-id="ec74bdce-0753-7b65-49b2-77c2e8333a0d">
                            <div class="content">
                                <ul>
                                    @if(!Auth::user()->email_is_verified)
                                    <li class="notification">
                                        <p style="padding: 15px; display: block; margin: 0">
                                            Maaf email Anda belum dikonfirmasi. Silahkan cek email Anda untuk konfirmasi email Anda. Apakah Anda tidak mendapat email konfirmasi?
                                            <a href="{{route("email.verification.resend", ["username" => Auth::user()->username])}}">Kirim Ulang.</a>
                                        </p>
                                    </li>
                                    @endif
                                    <!-- <li class="notification">
                                        <a href="#">
                                            <div class="image"><img src="assets/img/avatar3.png" alt="Avatar"></div>
                                            <div class="notification-info">
                                                <div class="text"><span class="user-name">Joel King</span> is now following you</div><span class="date">2 days ago</span>
                                            </div>
                                        </a>
                                    </li> -->
                                </ul>
                            </div>
                            <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;">
                                <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                            </div>
                            <div class="ps-scrollbar-y-rail" style="top: 0px; right: 0px; height: 222px;">
                                <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 164px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="footer"> <a href="#">View all notifications</a></div> -->
                </li>
            </ul>
        </li>
    </ul>
</div>
