<!DOCTYPE html>
<html lang="en">
@include('partials.admin.htmlheader')
<body>
    <div class="be-wrapper be-collapsible-sidebar be-fixed-sidebar">
        <nav class="navbar navbar-default navbar-fixed-top be-top-header">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="#" class="be-toggle-left-sidebar"><span class="icon mdi mdi-menu"></span></a>
                </div>
                @include('partials.admin.navbar-right')
            </div>
        </nav>
        @include('partials.admin.sidebar')
        <div id="app" class="be-content">
            <div class="page-head">
                <h2 class="page-head-title">@yield('title')</h2>
            </div>
            <div class="main-content container-fluid">
                @include('partials.admin.helpers.alert')
                @yield('content')
            </div>
        </div>
    </div>
    @include('partials.admin.scripts')
</body>
</html>
