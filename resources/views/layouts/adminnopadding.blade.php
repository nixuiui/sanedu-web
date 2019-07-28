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
            <div class="be-content be-no-padding">
                <aside class="page-aside">
                    <div class="be-scroller ps-container ps-theme-default ps-active-y" data-ps-id="1f327705-3f21-f9a5-17a1-2282b08dd78c">
                        <div class="aside-content">
                            <div class="content">
                                <div class="aside-header">
                                    <button data-target=".aside-nav" data-toggle="collapse" type="button" class="navbar-toggle">
                                        <span class="icon mdi mdi-caret-down"></span>
                                    </button>
                                    <h3>@yield('menu-title')</h3>
                                    <p class="description">@yield('description')</p>
                                </div>
                            </div>
                            <div class="aside-nav collapse">
                                @yield('navigation')
                            </div>
                        </div>
                        <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;">
                            <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                        </div>
                        <div class="ps-scrollbar-y-rail" style="top: 0px; height: 542px; right: 0px;">
                            <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 442px;"></div>
                        </div>
                    </div>
                </aside>
                <div class="main-content container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
        @include('partials.admin.scripts')
    </body>

</html>
