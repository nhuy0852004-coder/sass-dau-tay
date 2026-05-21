<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký Admin - Hệ Thống Bán Hàng</title>

    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/admin/css/admin.css') }}">
</head>

<body>
    <main class="auth-page">
        <section class="auth-panel auth-panel-wide">
            <div class="auth-side">
                <div class="auth-logo">
                    <div class="auth-logo-icon">
                        <i class="bi bi-shop"></i>
                    </div>

                    <div>
                        <strong>Hệ Thống Bán Hàng</strong>
                        <span>Tạo tài khoản quản trị</span>
                    </div>
                </div>

                <div class="auth-intro">
                    <h1>Thiết lập tài khoản Admin đầu tiên.</h1>
                    <p>Dùng tài khoản này để vào khu vực quản trị và tiếp tục xây dựng các module bán hàng.</p>
                </div>

                <div class="auth-note">
                    <i class="bi bi-info-circle"></i>
                    <span>Route đăng ký đang mở để phục vụ giai đoạn phát triển ban đầu.</span>
                </div>
            </div>

            <div class="auth-form-wrap">
                <div class="auth-form-header">
                    <h2>Đăng ký Admin</h2>
                    <p>Form được bố trí ngang, rộng, dễ nhập liệu giống phần mềm quản trị thực tế.</p>
                </div>

                @if ($errors->any())
                    <div class="alert-danger">
                        Vui lòng kiểm tra lại thông tin đăng ký.
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.dangky.xuly') }}" class="auth-form">
                    @csrf

                    <div class="form-grid form-grid-auth">
                        <div class="form-group">
                            <label class="form-label" for="hoten">Họ tên</label>
                            <input
                                type="text"
                                id="hoten"
                                name="hoten"
                                class="form-control"
                                value="{{ old('hoten') }}"
                                placeholder="Ví dụ: Nguyễn Quốc Huy"
                                autofocus
                            >
                            @error('hoten')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email') }}"
                                placeholder="Ví dụ: admin@gmail.com"
                            >
                            @error('email')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="sodienthoai">Số điện thoại</label>
                            <input
                                type="text"
                                id="sodienthoai"
                                name="sodienthoai"
                                class="form-control"
                                value="{{ old('sodienthoai') }}"
                                placeholder="Ví dụ: 0901234567"
                            >
                            @error('sodienthoai')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="password">Mật khẩu</label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control"
                                placeholder="Tối thiểu 8 ký tự"
                            >
                            @error('password')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="password_confirmation">Xác nhận mật khẩu</label>
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="form-control"
                                placeholder="Nhập lại mật khẩu"
                            >
                        </div>
                    </div>

                    <div class="auth-form-actions">
                        <a href="{{ route('admin.dangnhap') }}" class="btn-light">
                            <i class="bi bi-arrow-left"></i>
                            Quay lại đăng nhập
                        </a>

                        <button type="submit" class="btn-primary">
                            <i class="bi bi-person-plus"></i>
                            Tạo tài khoản
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>

</html>
