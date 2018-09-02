<!DOCTYPE html>
<html lang="en">
@include('partials.admin.htmlheader')
<body>
    <div class="be-wrapper be-collapsible-sidebar be-collapsible-sidebar-collapsed be-fixed-sidebar be-aside">
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
            <aside class="page-aside">
                <div class="be-scroller nano ps-container ps-theme-default" data-ps-id="4d56ab4c-5347-f109-1f77-e4f7335eaac1">
                    <div class="nano-content">
                        <div class="content">
                            @yield('content-side')
                        </div>
                    </div>
                    <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
                </aside>
                <div class="main-content container-fluid">
                    <div class="page-head">
                        <h2 class="page-head-title">@yield('title')</h2>
                    </div>
                    <div class="container-fluid">
                        @include('partials.admin.helpers.alert')
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        @include('partials.admin.scripts')
    </body>
    </html>
