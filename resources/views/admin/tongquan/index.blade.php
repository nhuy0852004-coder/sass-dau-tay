@extends('admin.layouts.app')

@section('tieude', 'Tổng quan')
@section('tieudetrang', 'Tổng quan')
@section('mota', 'Theo dõi nhanh tình hình sản phẩm, đơn hàng, khách hàng và doanh thu.')

@section('noidung')
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="bi bi-box-seam"></i>
            </div>

            <div>
                <span>Tổng sản phẩm</span>
                <strong>{{ number_format($thongke['tong_sanpham'], 0, ',', '.') }}</strong>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon green">
                <i class="bi bi-folder2-open"></i>
            </div>

            <div>
                <span>Tổng danh mục</span>
                <strong>{{ number_format($thongke['tong_danhmuc'], 0, ',', '.') }}</strong>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon amber">
                <i class="bi bi-receipt"></i>
            </div>

            <div>
                <span>Tổng đơn hàng</span>
                <strong>{{ number_format($thongke['tong_donhang'], 0, ',', '.') }}</strong>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon red">
                <i class="bi bi-people"></i>
            </div>

            <div>
                <span>Tổng khách hàng</span>
                <strong>{{ number_format($thongke['tong_khachhang'], 0, ',', '.') }}</strong>
            </div>
        </div>
    </div>

    <div class="dashboard-grid">
        <div class="content-card">
            <div class="card-header">
                <div>
                    <h3>Doanh thu</h3>
                    <p>Chỉ tính các đơn hàng đã hoàn thành.</p>
                </div>
            </div>

            <div class="revenue-list">
                <div class="revenue-item">
                    <span>Doanh thu hôm nay</span>
                    <strong>{{ number_format($thongke['doanhthu_homnay'], 0, ',', '.') }} ₫</strong>
                </div>

                <div class="revenue-item">
                    <span>Doanh thu tháng này</span>
                    <strong>{{ number_format($thongke['doanhthu_thangnay'], 0, ',', '.') }} ₫</strong>
                </div>
            </div>
        </div>

        <div class="content-card">
            <div class="card-header">
                <div>
                    <h3>Trạng thái đơn hàng</h3>
                    <p>Tổng hợp nhanh theo từng trạng thái.</p>
                </div>
            </div>

            <div class="order-status-list">
                <div class="order-status-item">
                    <span class="badge badge-warning">Chờ xử lý</span>
                    <strong>{{ number_format($thongke['don_choxuly'], 0, ',', '.') }}</strong>
                </div>

                <div class="order-status-item">
                    <span class="badge badge-info">Đang giao</span>
                    <strong>{{ number_format($thongke['don_danggiao'], 0, ',', '.') }}</strong>
                </div>

                <div class="order-status-item">
                    <span class="badge badge-success">Hoàn thành</span>
                    <strong>{{ number_format($thongke['don_hoanthanh'], 0, ',', '.') }}</strong>
                </div>

                <div class="order-status-item">
                    <span class="badge badge-danger">Đã hủy</span>
                    <strong>{{ number_format($thongke['don_dahuy'], 0, ',', '.') }}</strong>
                </div>
            </div>
        </div>
    </div>

    <div class="content-card">
        <div class="card-header">
            <div>
                <h3>Đơn hàng mới nhất</h3>
                <p>Danh sách đơn hàng được tạo gần đây trong hệ thống.</p>
            </div>

            <button type="button" class="btn-light">
                <i class="bi bi-arrow-clockwise"></i>
                Làm mới
            </button>
        </div>

        @if ($donhangMoiNhat->count())
            <div class="table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Mã đơn</th>
                            <th>Khách hàng</th>
                            <th>Số điện thoại</th>
                            <th class="text-right">Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($donhangMoiNhat as $donhang)
                            @php
                                $trangthai = $trangThaiDonHang[$donhang->trangthai] ?? [
                                    'ten' => 'Không xác định',
                                    'class' => 'badge-muted',
                                ];
                            @endphp

                            <tr>
                                <td>
                                    <strong>{{ $donhang->madonhang }}</strong>
                                </td>

                                <td>{{ $donhang->tenkhachhang }}</td>

                                <td>{{ $donhang->sodienthoai }}</td>

                                <td class="text-right">
                                    {{ number_format($donhang->tongtien, 0, ',', '.') }} ₫
                                </td>

                                <td>
                                    <span class="badge {{ $trangthai['class'] }}">
                                        {{ $trangthai['ten'] }}
                                    </span>
                                </td>

                                <td>
                                    {{ optional($donhang->ngaytao)->format('d/m/Y H:i') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="bi bi-inbox"></i>
                </div>

                <h4>Chưa có đơn hàng</h4>
                <p>Khi có đơn hàng mới, dữ liệu sẽ được hiển thị tại khu vực này.</p>
            </div>
        @endif
    </div>
@endsection
