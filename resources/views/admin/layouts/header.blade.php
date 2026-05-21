<header class="admin-header">
    <div class="header-left">
        <button type="button" class="sidebar-toggle" id="sidebarToggle" aria-label="Đóng mở menu">
            <i class="bi bi-list"></i>
        </button>

        <div class="header-search">
            <i class="bi bi-search"></i>
            <input type="text" placeholder="Tìm kiếm nhanh..." disabled>
        </div>
    </div>

    <div class="header-right">
        <button type="button" class="notification-button" aria-label="Thông báo">
            <i class="bi bi-bell"></i>
            <span class="notification-dot"></span>
        </button>

        <div class="header-admin">
            <div class="admin-avatar">
                {{ strtoupper(mb_substr(auth()->user()->hoten ?? 'Q', 0, 1)) }}
            </div>

            <div class="admin-info">
                <strong>{{ auth()->user()->hoten ?? 'Quản trị viên' }}</strong>
                <span>Đang hoạt động</span>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.dangxuat') }}">
            @csrf
            <button type="submit" class="logout-button" title="Đăng xuất">
                <i class="bi bi-box-arrow-right"></i>
            </button>
        </form>
    </div>
</header>
