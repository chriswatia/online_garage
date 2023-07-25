<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-cogs"></i>
        </div>
        <div class="sidebar-brand-text">{{ config('app.name', 'Laravel') }}</div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/admin') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Lists
    </div>
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/admin') }}">
            <i class="fas fa-fw fa-calendar"></i>
            <span>Bookings</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/admin/mechanics') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Mechanics</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/admin/orders') }}">
            <i class="fas fa-fw fa-bookmark"></i>
            <span>Orders</span></a>
    </li>
    <!-- Divider -->
    <!-- <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Reports
    </div> -->
    <!-- Divider -->


    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Configurations
    </div>
    <li class="nav-item active">
        <a class="nav-link" href="/admin/categories">
            <i class="fas fa-fw fa-list"></i>
            <span>Categories</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/admin/brands') }}">
            <i class="fas fa-fw fa-car"></i>
            <span>Brands</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/admin/products') }}">
            <i class="fas fa-fw fa-store-slash"></i>
            <span>Products</span></a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/admin/services') }}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Services</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    @if (Auth::user()->role_id == 1)
    <!-- Heading -->
    <div class="sidebar-heading">
        Accounts
    </div>
    <li class="nav-item active">
        <a class="nav-link" href="/admin/users">
            <i class="fas fa-fw fa-users"></i>
            <span>Users</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="/admin/roles">
            <i class="fas fa-fw fa-list"></i>
            <span>Roles</span></a>
    </li>
    @endif
    @if (Auth::user()->role_id == 3)
    <!-- Heading -->
    <div class="sidebar-heading">
        Account
    </div>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/admin/edit-user/'.Auth::user()->id) }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Profile</span></a>
    </li>
    @endif
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
