<div class="be-left-sidebar">
    <div class="left-sidebar-wrapper">
        <a href="#" class="left-sidebar-toggle">Dashboard</a>
        @if(Auth::user()->id_role == 1001)
        @include('partials.admin.menu.superadmin')
        @elseif(Auth::user()->id_role == 1002)
        @include('partials.admin.menu.admin')
        @elseif(Auth::user()->id_role == 1003)
        @include('partials.admin.menu.admintiket')
        @elseif(Auth::user()->id_role == 1004)
        @include('partials.admin.menu.member')
        @elseif(Auth::user()->id_role == 1005)
        @include('partials.admin.menu.user')
        @elseif(Auth::user()->id_role == 1006)
        @include('partials.admin.menu.adminujian')
        @elseif(Auth::user()->id_role == 1007)
        @include('partials.admin.menu.adminsimulasi')
        @elseif(Auth::user()->id_role == 1008)
        @include('partials.admin.menu.pengawas')
        @endif
    </div>
</div>
