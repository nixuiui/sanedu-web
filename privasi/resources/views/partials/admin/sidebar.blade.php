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
        @elseif(Auth::user()->id_role == 1006)
        @include('partials.admin.menu.adminujian')
        @elseif(Auth::user()->id_role == 31)
        @include('partials.admin.menu.kapolres')
        @elseif(Auth::user()->id_role == 32)
        @include('partials.admin.menu.ccpolres')
        @elseif(Auth::user()->id_role == 41)
        @include('partials.admin.menu.dandim')
        @elseif(Auth::user()->id_role == 42)
        @include('partials.admin.menu.cckodim')
        @endif
    </div>
</div>
