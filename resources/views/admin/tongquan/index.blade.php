@extends('admin.layouts.app')

@section('tieude', 'Tổng quan')
@section('tieudetrang', 'Tổng quan')
@section('mota', 'Theo dõi nhanh sản phẩm, đơn hàng, khách hàng và doanh thu.')

@section('noidung')
    <div class="page-toolbar">
        <div>
            <h2>Hoạt động hôm nay</h2>
            <p>Dữ liệu thống kê sẽ được kết nối ở các bước tiếp theo.</p>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="bi bi-box-seam"></i>
            </div>
            <div>
                <span>Tổng sản phẩm</span>
                <strong>0</strong>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon green">
                <i class="bi bi-folder2-open"></i>
            </div>
            <div>
                <span>Tổng danh mục</span>
                <strong>0</strong>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon amber">
                <i class="bi bi-receipt"></i>
            </div>
            <div>
                <span>Tổng đơn hàng</span>
                <strong>0</strong>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon red">
                <i class="bi bi-cash-coin"></i>
            </div>
            <div>
                <span>Doanh thu hôm nay</span>
                <strong>0 ₫</strong>
            </div>
        </div>
    </div>

    <div class="content-card">
        <div class="card-header">
            <div>
                <h3>Đơn hàng mới nhất</h3>
                <p>Danh sách đơn hàng gần đây sẽ hiển thị tại đây.</p>
            </div>

            <button class="btn-light">
                <i class="bi bi-arrow-clockwise"></i>
                Làm mới
            </button>
        </div>

        <div class="empty-state">
            <div class="empty-icon">
                <i class="bi bi-inbox"></i>
            </div>
            <h4>Chưa có dữ liệu</h4>
            <p>Sau khi có đơn hàng, danh sách sẽ được hiển thị tại khu vực này.</p>
        </div>
    </div>
@endsection
