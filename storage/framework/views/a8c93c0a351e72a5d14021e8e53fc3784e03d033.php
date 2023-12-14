<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #FBBC05;">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo e(route('dashboard_admin')); ?>">
    <div class="sidebar-brand-icon rotate-n-15">
        <!-- <i class="fas fa-laugh-wink"></i> -->
    </div>
    <div class="sidebar-brand-text mx-3">Quản Trị Viên <sup></sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="<?php echo e(route('dashboard_admin')); ?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Thông Tin</span>
    </a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Quản lý tài khoản
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Quản Lý Cửa Hàng</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <!-- <h6 class="collapse-header">Custom Components:</h6> -->
            <a class="collapse-item" href="<?php echo e(route('manage_shop_regist')); ?>">Cửa hàng chưa duyệt</a>
            <a class="collapse-item" href="<?php echo e(route('manage_shop_list')); ?>">Danh sách cửa hàng</a>
            <a class="collapse-item" href="<?php echo e(route('manage_shop_stop')); ?>">Cửa hàng dừng kinh doanh</a>

        </div>
    </div>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
       
        <i class="fas fa-clipboard-list"></i>
        <span>Quản Lý Người Dùng</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <!-- <h6 class="collapse-header">Chức năng tùy chọn:</h6> -->
            <a class="collapse-item" href="<?php echo e(route('manage_users_list')); ?>">Danh sách người dùng </a>
            <a class="collapse-item" href="<?php echo e(route('manage_users_stop')); ?>">Người dùng bị khóa</a>
            <!-- <a class="collapse-item" href="utilities-animation.html">Animations</a>
            <a class="collapse-item" href="utilities-other.html">Other</a> -->
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Quản lý sàn giao dịch
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>Danh Mục Sản Phẩm</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <!-- <h6 class="collapse-header">Login Screens:</h6> -->
            <a class="collapse-item" href="<?php echo e(route('manage_category')); ?>">Danh mục chính</a>
            <a class="collapse-item" href="<?php echo e(route('add_subcategory')); ?>">Thêm danh mục phụ</a>

        </div>
    </div>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCoupon"
        aria-expanded="true" aria-controls="collapseCoupon">
       
        <i class="fas fa-clipboard-list"></i>
        <span>Quản Lý Mã Giảm Giá</span>
    </a>
    <div id="collapseCoupon" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <!-- <h6 class="collapse-header">Chức năng tùy chọn:</h6> -->
            <a class="collapse-item" href="<?php echo e(route('add_coupon')); ?>">Thêm mã giảm giá</a>
            <a class="collapse-item" href="<?php echo e(route('manage_coupon')); ?>">Danh sách mã giảm giá</a>
            <!-- <a class="collapse-item" href="utilities-animation.html">Animations</a>
            <a class="collapse-item" href="utilities-other.html">Other</a> -->
        </div>
    </div>
</li>
<!-- Nav Item - Charts -->
<!-- <li class="nav-item">
    <a class="nav-link" href="charts.html">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Charts</span></a>
</li> -->

<!-- Nav Item - Tables -->
<!-- <li class="nav-item">
    <a class="nav-link" href="tables.html">
        <i class="fas fa-fw fa-table"></i>
        <span>Tables</span></a>
</li> -->
<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

<!-- Sidebar Message -->
<!-- <div class="sidebar-card d-none d-lg-flex">
    <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
    <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
    <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
</div> -->

</ul><?php /**PATH D:\Ecommerce\resources\views/admin/sidebaradmin.blade.php ENDPATH**/ ?>