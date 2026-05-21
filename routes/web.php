<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TongquanController;
use App\Http\Controllers\Admin\XacthucController;

Route::get('/', function () {
    return redirect()->route('admin.tongquan');
});

Route::get('/login', function () {
    return redirect()->route('admin.dangnhap');
})->name('login');

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::middleware('guest')->group(function () {
            Route::get('/dang-nhap', [XacthucController::class, 'hienThiDangNhap'])
                ->name('dangnhap');

            Route::post('/dang-nhap', [XacthucController::class, 'xuLyDangNhap'])
                ->name('dangnhap.xuly');

            Route::get('/dang-ky', [XacthucController::class, 'hienThiDangKy'])
                ->name('dangky');

            Route::post('/dang-ky', [XacthucController::class, 'xuLyDangKy'])
                ->name('dangky.xuly');
        });

        Route::middleware('auth')->group(function () {
            Route::get('/', [TongquanController::class, 'index'])
                ->name('tongquan');

            Route::post('/dang-xuat', [XacthucController::class, 'dangXuat'])
                ->name('dangxuat');
        });
    });
