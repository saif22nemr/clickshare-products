<!-- MENU SIDEBAR-->
<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="{{ asset('assets/cool_dashboard/images/icon/logo.png') }}" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">

                <li class="{{ isUrlActive('admin/home') ? 'active' : '' }}">
                    <a href="{{ route('admin.home') }}">
                        <i class="fas fa-chart-bar"></i>{{ trans('app.dashboard') }}</a>
                </li>
                <li class="{{ isUrlActive('admin/admin') ? 'active' : '' }}">
                    <a href="{{ route('admin.admin.index') }}">
                        <i class="fas fa-chart-bar"></i>{{ trans('app.admins') }}</a>
                </li>
                <li class="{{ isUrlActive('admin/product') ? 'active' : '' }}">
                    <a href="{{ route('admin.product.index') }}">
                        <i class="fas fa-chart-bar"></i>{{ trans('app.products') }}</a>
                </li>


            </ul>
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR-->
