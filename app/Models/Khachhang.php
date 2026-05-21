<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khachhang extends Model
{
    use HasFactory;

    protected $table = 'khachhang';

    const CREATED_AT = 'ngaytao';
    const UPDATED_AT = 'ngaycapnhat';

    protected $fillable = [
        'hoten',
        'sodienthoai',
        'email',
        'diachi',
        'trangthai',
    ];

    protected $casts = [
        'ngaytao' => 'datetime',
        'ngaycapnhat' => 'datetime',
    ];

    public function donhang()
    {
        return $this->hasMany(Donhang::class, 'khachhang_id');
    }

    public function scopeDangHoatDong($query)
    {
        return $query->where('trangthai', 'dang_hoat_dong');
    }

    public function scopeMoiNhat($query)
    {
        return $query->orderBy('id', 'desc');
    }
}
