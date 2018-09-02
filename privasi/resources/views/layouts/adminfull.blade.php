<!DOCTYPE html>
<html lang="en">
@include('partials.admin.htmlheader')
<body>
    <div class="be-wrapper be-nosidebar-left">
        <nav class="navbar navbar-default navbar-fixed-top be-top-header">
            <div class="container-fluid">
                <div class="navbar-header">
                    <!-- <a href="{{ route('guest.home') }}" class="navbar-brand">
                        <img src="{{ asset('asset-beagle/img/logo-san.png') }}" style="width: 50px; margin-top: 7px">
                    </a> -->
                </div>
                @include('partials.admin.navbar-right')
                <a href="#" data-toggle="collapse" data-target="#be-navbar-collapse" class="be-toggle-top-header-menu collapsed">No Sidebar Left</a>
            </div>
        </nav>
        <div class="be-content">
            <div class="main-content container">
                @include('partials.admin.helpers.alert')
                @yield('content')
            </div>
        </div>
        <div class="be-right-sidebar">
            <!-- Right sidebar -->
            asd
        </div>
    </div>
    @include('partials.admin.scripts')
</body>

</html>
