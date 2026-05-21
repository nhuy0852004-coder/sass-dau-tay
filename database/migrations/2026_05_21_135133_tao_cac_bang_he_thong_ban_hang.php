<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Chạy migration để tạo toàn bộ bảng nền tảng cho hệ thống bán hàng.
     */
    public function up(): void
    {
        Schema::create('nguoidung', function (Blueprint $table) {
            $table->id();
            $table->string('hoten', 150);
            $table->string('email', 150)->unique();
            $table->string('matkhau');
            $table->string('sodienthoai', 20)->nullable();
            $table->string('vaitro', 50)->default('admin');
            $table->string('trangthai', 50)->default('dang_hoat_dong');
            $table->rememberToken();
            $table->timestamp('ngayxacnhanemail')->nullable();
            $table->timestamp('ngaytao')->nullable();
            $table->timestamp('ngaycapnhat')->nullable();

            $table->index('email');
            $table->index('trangthai');
            $table->index('vaitro');
        });

        Schema::create('danhmuc', function (Blueprint $table) {
            $table->id();
            $table->string('tendanhmuc', 180);
            $table->string('slug', 220)->unique();
            $table->text('mota')->nullable();
            $table->unsignedInteger('thutu')->default(0);
            $table->string('trangthai', 50)->default('hien');
            $table->timestamp('ngaytao')->nullable();
            $table->timestamp('ngaycapnhat')->nullable();

            $table->index('tendanhmuc');
            $table->index('trangthai');
            $table->index('thutu');
        });

        Schema::create('sanpham', function (Blueprint $table) {
            $table->id();
            $table->string('masanpham', 80)->unique();
            $table->string('tensanpham', 220);
            $table->string('slug', 260)->unique();
            $table->foreignId('danhmuc_id')
                ->nullable()
                ->constrained('danhmuc')
                ->nullOnDelete();

            $table->unsignedBigInteger('giaban')->default(0);
            $table->unsignedBigInteger('giakhuyenmai')->nullable();
            $table->unsignedInteger('soluongton')->default(0);
            $table->string('trangthai', 50)->default('dang_ban');
            $table->text('mota')->nullable();
            $table->string('hinhanh', 255)->nullable();
            $table->timestamp('ngaytao')->nullable();
            $table->timestamp('ngaycapnhat')->nullable();

            $table->index('masanpham');
            $table->index('tensanpham');
            $table->index('trangthai');
            $table->index('soluongton');
            $table->index('danhmuc_id');
        });

        Schema::create('khachhang', function (Blueprint $table) {
            $table->id();
            $table->string('hoten', 160);
            $table->string('sodienthoai', 20);
            $table->string('email', 150)->nullable();
            $table->text('diachi')->nullable();
            $table->string('trangthai', 50)->default('dang_hoat_dong');
            $table->timestamp('ngaytao')->nullable();
            $table->timestamp('ngaycapnhat')->nullable();

            $table->index('hoten');
            $table->index('sodienthoai');
            $table->index('email');
            $table->index('trangthai');
        });

        Schema::create('donhang', function (Blueprint $table) {
            $table->id();
            $table->string('madonhang', 80)->unique();

            $table->foreignId('khachhang_id')
                ->nullable()
                ->constrained('khachhang')
                ->nullOnDelete();

            $table->string('tenkhachhang', 160);
            $table->string('sodienthoai', 20);
            $table->text('diachi')->nullable();

            $table->unsignedBigInteger('tongtien')->default(0);
            $table->string('trangthai', 50)->default('cho_xu_ly');
            $table->text('ghichu')->nullable();

            $table->timestamp('ngaytao')->nullable();
            $table->timestamp('ngaycapnhat')->nullable();

            $table->index('madonhang');
            $table->index('tenkhachhang');
            $table->index('sodienthoai');
            $table->index('trangthai');
            $table->index('khachhang_id');
        });

        Schema::create('chitietdonhang', function (Blueprint $table) {
            $table->id();

            $table->foreignId('donhang_id')
                ->constrained('donhang')
                ->cascadeOnDelete();

            $table->foreignId('sanpham_id')
                ->nullable()
                ->constrained('sanpham')
                ->nullOnDelete();

            $table->string('tensanpham', 220);
            $table->string('masanpham', 80)->nullable();
            $table->unsignedInteger('soluong')->default(1);
            $table->unsignedBigInteger('dongia')->default(0);
            $table->unsignedBigInteger('thanhtien')->default(0);

            $table->timestamp('ngaytao')->nullable();
            $table->timestamp('ngaycapnhat')->nullable();

            $table->index('donhang_id');
            $table->index('sanpham_id');
            $table->index('masanpham');
        });

        Schema::create('caidat', function (Blueprint $table) {
            $table->id();
            $table->string('tenkhoahoc', 120)->unique();
            $table->text('giatri')->nullable();
            $table->string('kieudulieu', 50)->default('text');
            $table->text('mota')->nullable();
            $table->timestamp('ngaytao')->nullable();
            $table->timestamp('ngaycapnhat')->nullable();

            $table->index('tenkhoahoc');
        });
    }

    /**
     * Rollback migration theo thứ tự ngược lại để tránh lỗi khóa ngoại.
     */
    public function down(): void
    {
        Schema::dropIfExists('caidat');
        Schema::dropIfExists('chitietdonhang');
        Schema::dropIfExists('donhang');
        Schema::dropIfExists('khachhang');
        Schema::dropIfExists('sanpham');
        Schema::dropIfExists('danhmuc');
        Schema::dropIfExists('nguoidung');
    }
};
