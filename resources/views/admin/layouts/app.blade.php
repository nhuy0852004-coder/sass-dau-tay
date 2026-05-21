<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('tieude', 'Quản trị hệ thống') - Hệ Thống Bán Hàng</title>

    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/admin/css/admin.css') }}">
</head>

<body>
    <div class="admin-wrapper">
        @include('admin.layouts.sidebar')

        <div class="admin-main" id="adminMain">
            @include('admin.layouts.header')

            <main class="admin-content">
                <div class="page-heading">
                    <div>
                        <h1>@yield('tieudetrang', 'Tổng quan')</h1>
                        <p>@yield('mota', 'Theo dõi nhanh tình hình vận hành của hệ thống.')</p>
                    </div>

                    @hasSection('hanhdong')
                        <div class="page-heading-actions">
                            @yield('hanhdong')
                        </div>
                    @endif
                </div>

                @if (session('thanhcong'))
                    <div class="alert-success">
                        {{ session('thanhcong') }}
                    </div>
                @endif

                @if (session('loi'))
                    <div class="alert-danger">
                        {{ session('loi') }}
                    </div>
                @endif

                @yield('noidung')
            </main>
        </div>
    </div>

    <script src="{{ asset('assets/admin/js/admin.js') }}"></script>
</body>

</html>
