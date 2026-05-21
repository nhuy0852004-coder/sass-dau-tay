<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Danhmuc;
use App\Models\Donhang;
use App\Models\Khachhang;
use App\Models\Sanpham;
use Carbon\Carbon;

class TongquanController extends Controller
{
    public function index()
    {
        $homNayBatDau = Carbon::now('Asia/Ho_Chi_Minh')->startOfDay();
        $homNayKetThuc = Carbon::now('Asia/Ho_Chi_Minh')->endOfDay();

        $thangNayBatDau = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth();
        $thangNayKetThuc = Carbon::now('Asia/Ho_Chi_Minh')->endOfMonth();

        $thongke = [
            'tong_sanpham' => Sanpham::count(),
            'tong_danhmuc' => Danhmuc::count(),
            'tong_khachhang' => Khachhang::count(),
            'tong_donhang' => Donhang::count(),

            'doanhthu_homnay' => Donhang::where('trangthai', 'hoan_thanh')
                ->whereBetween('ngaytao', [$homNayBatDau, $homNayKetThuc])
                ->sum('tongtien'),

            'doanhthu_thangnay' => Donhang::where('trangthai', 'hoan_thanh')
                ->whereBetween('ngaytao', [$thangNayBatDau, $thangNayKetThuc])
                ->sum('tongtien'),

            'don_choxuly' => Donhang::where('trangthai', 'cho_xu_ly')->count(),
            'don_danggiao' => Donhang::where('trangthai', 'dang_giao')->count(),
            'don_hoanthanh' => Donhang::where('trangthai', 'hoan_thanh')->count(),
            'don_dahuy' => Donhang::where('trangthai', 'da_huy')->count(),
        ];

        $donhangMoiNhat = Donhang::query()
            ->orderByDesc('id')
            ->limit(8)
            ->get();

        $trangThaiDonHang = [
            'cho_xu_ly' => [
                'ten' => 'Chờ xử lý',
                'class' => 'badge-warning',
            ],
            'dang_giao' => [
                'ten' => 'Đang giao',
                'class' => 'badge-info',
            ],
            'hoan_thanh' => [
                'ten' => 'Hoàn thành',
                'class' => 'badge-success',
            ],
            'da_huy' => [
                'ten' => 'Đã hủy',
                'class' => 'badge-danger',
            ],
        ];

        return view('admin.tongquan.index', compact(
            'thongke',
            'donhangMoiNhat',
            'trangThaiDonHang'
        ));
    }
}
