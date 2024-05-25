<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href=''>NARVE</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class='{{ Request::is('pages.dashboard') ? 'active' : '' }}'>
                <a class="nav-link"
                    href=""><i class="fas fa-house"></i>Dashboard</a>
            </li>

            <li class="menu-header">Menu</li>
            <li>
                <a class="nav-link" href="{{ route('users.index') }}"><i class="fas fa-users"></i>Users</a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('products.index') }}"><i class="fas fa-box-archive"></i>Products</a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('categories.index') }}"><i class="fas fa-cart-shopping"></i>Categories</a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('products.index') }}"><i class="fas fa-clipboard"></i>All Reports</a>
            </li>

            <li class="menu-header">Report</li>
            <li>
                <a class="nav-link" href=""><i class="fas fa-cart-shopping"></i>Order</a>
            </li>
            <li>
                <a class="nav-link" href=""><i class="fas fa-clipboard-list"></i>Laporan</a>
            </li>
    
        </ul>
    </aside>
</div>
