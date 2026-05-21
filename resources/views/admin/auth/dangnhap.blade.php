<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Hệ Thống Bán Hàng</title>

    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/admin/css/admin.css') }}">
</head>

<body>
    <main class="auth-page">
        <section class="auth-panel">
            <div class="auth-side">
                <div class="auth-logo">
                    <div class="auth-logo-icon">
                        <i class="bi bi-shop"></i>
                    </div>

                    <div>
                        <strong>Hệ Thống Bán Hàng</strong>
                        <span>Quản trị vận hành</span>
                    </div>
                </div>

                <div class="auth-intro">
                    <h1>Quản lý bán hàng rõ ràng, dễ dùng.</h1>
                    <p>Theo dõi sản phẩm, đơn hàng, khách hàng và doanh thu trong một giao diện quản trị gọn gàng.</p>
                </div>

                <div class="auth-note">
                    <i class="bi bi-shield-check"></i>
                    <span>Khu vực Admin được bảo vệ bằng phiên đăng nhập riêng.</span>
                </div>
            </div>

            <div class="auth-form-wrap">
                <div class="auth-form-header">
                    <h2>Đăng nhập Admin</h2>
                    <p>Nhập thông tin tài khoản quản trị để tiếp tục.</p>
                </div>

                @if (session('thanhcong'))
                    <div class="alert-success">
                        {{ session('thanhcong') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert-danger">
                        Vui lòng kiểm tra lại thông tin đăng nhập.
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.dangnhap.xuly') }}" class="auth-form">
                    @csrf

                    <div class="form-group full">
                        <label class="form-label" for="email">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email') }}"
                            placeholder="Ví dụ: admin@gmail.com"
                            autocomplete="email"
                            autofocus
                        >
                        @error('email')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group full">
                        <label class="form-label" for="password">Mật khẩu</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control"
                            placeholder="Nhập mật khẩu"
                            autocomplete="current-password"
                        >
                        @error('password')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="auth-options">
                        <label class="checkbox-line">
                            <input type="checkbox" name="ghinho" value="1">
                            <span>Ghi nhớ đăng nhập</span>
                        </label>
                    </div>

                    <button type="submit" class="btn-primary auth-submit">
                        <i class="bi bi-box-arrow-in-right"></i>
                        Đăng nhập
                    </button>
                </form>

                <div class="auth-footer-text">
                    Chưa có tài khoản?
                    <a href="{{ route('admin.dangky') }}">Tạo tài khoản Admin</a>
                </div>
            </div>
        </section>
    </main>
</body>

</html>
