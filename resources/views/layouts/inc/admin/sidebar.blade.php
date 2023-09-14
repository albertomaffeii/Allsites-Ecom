<div class="container-fluid page-body-wrapper">
    <nav class="sidebar sidebar-offcanvas {{ config('app.panel_color') }}" id="sidebar">
        <ul class="nav">
            <li class="nav-item {{ Request::is('admin/dasboard') ? 'active':'' }}" >
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="mdi mdi-home menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/orders') ? 'active':'' }}" >
                <a class="nav-link" href="{{ route('orders.index') }}">
                    <i class="mdi mdi-sale menu-icon"></i>
                    <span class="menu-title">Orders</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/category*') ? 'active':'' }}" >
                <a class="nav-link" data-bs-toggle="collapse"
                    href="#category">
                    <i class="mdi mdi-view-list menu-icon"></i>
                    <span class="menu-title">Categories</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse {{ Request::is('admin/category*') ? 'show':'' }}" id="category">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('admin/category*') || Request::is('admin/category/*/edit')? 'active':'' }}" href="{{ route('category') }}">View Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('admin/category/create*') ? 'active':'' }}" href="{{ route('category.create') }}">New Category</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ Request::is('admin/products*') ? 'active':'' }}" >
                <a class="nav-link" data-bs-toggle="collapse"
                    href="#products">
                    <i class="mdi mdi-plus-circle menu-icon"></i>
                    <span class="menu-title">Products</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse {{ Request::is('admin/products*') ? 'show':'hidden' }}" id="products">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('admin/products') || Request::is('admin/products/*/edit')? 'active':'' }}" href="{{ route('products') }}">View Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('admin/products/create') ? 'active':'' }}" href="{{ route('products.create') }}">New Product</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ Request::is('admin/brands') ? 'active':'' }}" >
                <a class="nav-link" href="{{ route('brands') }}">
                    <i class="mdi mdi-view-headline menu-icon"></i>
                    <span class="menu-title">Brands</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/colors') ? 'active':'' }}" >
            <a class="nav-link" href="{{ route('colors') }}">
                <i class="mdi mdi-view-headline menu-icon"></i>
                <span class="menu-title">Colors</span>
            </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                    <i class="mdi mdi-account menu-icon"></i>
                    <span class="menu-title">Users</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="auth">
                    <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/login-2.html"> Login 2 </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/register-2.html"> Register 2 </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/lock-screen.html"> Lockscreen </a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ Request::is('admin/sliders') ? 'active':'' }}" >
                <a class="nav-link" href="{{ route('sliders') }}">
                    <i class="mdi mdi-view-carousel menu-icon"></i>
                    <span class="menu-title">Home Slider</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/settings') ? 'active':'' }}" >
                <a class="nav-link" href="{{ route('settings') }}">
                    <i class="mdi mdi-settings menu-icon"></i>
                    <span class="menu-title">Site Setting</span>
                </a>
            </li>
        </ul>
    </nav>
