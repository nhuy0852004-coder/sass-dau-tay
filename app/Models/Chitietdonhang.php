<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chitietdonhang extends Model
{
    use HasFactory;

    protected $table = 'chitietdonhang';

    const CREATED_AT = 'ngaytao';
    const UPDATED_AT = 'ngaycapnhat';

    protected $fillable = [
        'donhang_id',
        'sanpham_id',
        'tensanpham',
        'masanpham',
        'soluong',
        'dongia',
        'thanhtien',
    ];

    protected $casts = [
        'donhang_id' => 'integer',
        'sanpham_id' => 'integer',
        'soluong' => 'integer',
        'dongia' => 'integer',
        'thanhtien' => 'integer',
        'ngaytao' => 'datetime',
        'ngaycapnhat' => 'datetime',
    ];

    public function donhang()
    {
        return $this->belongsTo(Donhang::class, 'donhang_id');
    }

    public function sanpham()
    {
        return $this->belongsTo(Sanpham::class, 'sanpham_id');
    }

    public function getDonGiaHienThiAttribute()
    {
        return number_format($this->dongia, 0, ',', '.') . ' ₫';
    }

    public function getThanhTienHienThiAttribute()
    {
        return number_format($this->thanhtien, 0, ',', '.') . ' ₫';
    }
}
