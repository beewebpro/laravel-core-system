<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">{{ trans('core/base::layouts.system_menu') }}</li>
                @foreach (DashboardMenu::getAll() as $menu)
                    @php
                        $hasChildren =
                            array_key_exists('children', $menu) && ($childrenCount = count($menu['children']));
                    @endphp
                    <li>
                        <a href="{{ $hasChildren ? 'javascript: void(0);' : $menu['url'] }}" class="waves-effect">
                            @if ($menu['icon'] !== false)
                                <i class="{{ $menu['icon'] }}"></i>
                            @endif
                            <span>{{ $menu['name'] }}</span>
                        </a>
                        @if ($hasChildren)
                            <ul class="sub-menu" aria-expanded="false">
                                @foreach ($children as $child)
                                    <li><a href="{{ $child['url'] }}">{{ $child['name'] }}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
                <li class="menu-title" key="t-menu">{{ trans('core/base::layouts.platform_admin') }}</li>

                <li>
                    <a href="{{ route('system.index') }}" class="waves-effect ">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-starter-page">{{ trans('core/base::layouts.platform_admin') }}</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
