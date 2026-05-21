<aside class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-brand">
        <div class="brand-icon">
            <i class="bi bi-shop"></i>
        </div>

        <div class="brand-text">
            <strong>Hệ Thống Bán Hàng</strong>
            <span>Trang quản trị</span>
        </div>
    </div>

    <nav class="sidebar-menu">
        <a href="{{ route('admin.tongquan') }}"
           class="sidebar-link {{ request()->routeIs('admin.tongquan') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2"></i>
            <span>Tổng quan</span>
        </a>

        <a href="{{ route('admin.danhmuc.index') }}"
            class="sidebar-link {{ request()->routeIs('admin.danhmuc.*') ? 'active' : '' }}">
            <i class="bi bi-folder2-open"></i>
            <span>Danh mục</span>
        </a>

        <a href="#"
           class="sidebar-link">
            <i class="bi bi-box-seam"></i>
            <span>Sản phẩm</span>
        </a>

        <a href="#"
           class="sidebar-link {{ request()->is('admin/don-hang*') ? 'active' : '' }}">
            <i class="bi bi-receipt"></i>
            <span>Đơn hàng</span>
        </a>

        <a href="#"
           class="sidebar-link {{ request()->is('admin/khach-hang*') ? 'active' : '' }}">
            <i class="bi bi-people"></i>
            <span>Khách hàng</span>
        </a>

        <a href="#"
           class="sidebar-link {{ request()->is('admin/doanh-thu*') ? 'active' : '' }}">
            <i class="bi bi-graph-up-arrow"></i>
            <span>Doanh thu</span>
        </a>

        <a href="#"
           class="sidebar-link {{ request()->is('admin/cai-dat*') ? 'active' : '' }}">
            <i class="bi bi-gear"></i>
            <span>Cài đặt</span>
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="user-avatar">
                <i class="bi bi-person"></i>
            </div>

            <div class="user-info">
                <strong>Quản trị viên</strong>
                <span>Đang hoạt động</span>
            </div>
        </div>
    </div>
</aside>

<div class="sidebar-overlay" id="sidebarOverlay"></div>
