
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('dashboard_admin')}}">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-store-alt"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Quản Trị Viên</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item {{ request()->routeIs('dashboard_admin') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('dashboard_admin')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Nav Item - Commission Management -->
<li class="nav-item {{ request()->routeIs('manage_commission') || request()->routeIs('commission_detail') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('manage_commission')}}">
        <i class="fas fa-fw fa-percentage"></i>
        <span>Quản lý hoa hồng</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Quản Lý Cửa Hàng
</div>

<!-- Nav Item - Shop Management -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseShop"
        aria-expanded="false" aria-controls="collapseShop">
        <i class="fas fa-fw fa-building"></i>
        <span>Quản Lý Cửa Hàng</span>
    </a>
    <div id="collapseShop" class="collapse {{ request()->routeIs('manage_shop_*') || request()->routeIs('shop.locations*') ? 'show' : '' }}" 
         aria-labelledby="headingShop" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ request()->routeIs('manage_shop_regist') ? 'active' : '' }}" 
               href="{{route('manage_shop_regist')}}">Cửa hàng chờ duyệt</a>
            <a class="collapse-item {{ request()->routeIs('manage_shop_list') ? 'active' : '' }}" 
               href="{{route('manage_shop_list')}}">Danh sách cửa hàng</a>
            <a class="collapse-item {{ request()->routeIs('manage_shop_stop') ? 'active' : '' }}" 
               href="{{route('manage_shop_stop')}}">Cửa hàng bị khóa</a>
            <a class="collapse-item {{ request()->routeIs('shop.locations') ? 'active' : '' }}" 
               href="{{route('shop.locations')}}">Vị trí cửa hàng</a>
        </div>
    </div>
</li>

<!-- Heading -->
<div class="sidebar-heading">
    Quản Lý Người Dùng
</div>

<!-- Nav Item - User Management -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers"
        aria-expanded="false" aria-controls="collapseUsers">
        <i class="fas fa-fw fa-users"></i>
        <span>Quản Lý Người Dùng</span>
    </a>
    <div id="collapseUsers" class="collapse {{ request()->routeIs('manage_users_*') ? 'show' : '' }}" 
         aria-labelledby="headingUsers" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ request()->routeIs('manage_users_list') ? 'active' : '' }}" 
               href="{{route('manage_users_list')}}">Danh sách người dùng</a>
            <a class="collapse-item {{ request()->routeIs('manage_users_stop') ? 'active' : '' }}" 
               href="{{route('manage_users_stop')}}">Người dùng bị khóa</a>
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Danh Mục Sản Phẩm
</div>

<!-- Nav Item - Category Management -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategory"
        aria-expanded="false" aria-controls="collapseCategory">
        <i class="fas fa-fw fa-tags"></i>
        <span>Danh Mục</span>
    </a>
    <div id="collapseCategory" class="collapse {{ request()->routeIs('manage_category') || request()->routeIs('add_subcategory') ? 'show' : '' }}" 
         aria-labelledby="headingCategory" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ request()->routeIs('manage_category') ? 'active' : '' }}" 
               href="{{route('manage_category')}}">Danh mục chính</a>
            <a class="collapse-item {{ request()->routeIs('add_subcategory') ? 'active' : '' }}" 
               href="{{route('add_subcategory')}}">Thêm danh mục phụ</a>
        </div>
    </div>
</li>

<!-- Heading -->
<div class="sidebar-heading">
    Mã Giảm Giá
</div>

<!-- Nav Item - Coupon Management -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCoupon"
        aria-expanded="false" aria-controls="collapseCoupon">
        <i class="fas fa-fw fa-ticket-alt"></i>
        <span>Mã Giảm Giá</span>
    </a>
    <div id="collapseCoupon" class="collapse {{ request()->routeIs('add_coupon') || request()->routeIs('manage_coupon') || request()->routeIs('private_coupons*') ? 'show' : '' }}" 
         aria-labelledby="headingCoupon" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ request()->routeIs('add_coupon') ? 'active' : '' }}" 
               href="{{route('add_coupon')}}">Thêm mã giảm giá</a>
            <a class="collapse-item {{ request()->routeIs('manage_coupon') ? 'active' : '' }}" 
               href="{{route('manage_coupon')}}">Danh sách mã giảm giá</a>
            <a class="collapse-item {{ request()->routeIs('private-coupons*') ? 'active' : '' }}" 
               href="{{route('private-coupons.index')}}">Mã giảm giá riêng</a>
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>