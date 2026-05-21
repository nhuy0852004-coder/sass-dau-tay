<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donhang extends Model
{
    use HasFactory;

    protected $table = 'donhang';

    const CREATED_AT = 'ngaytao';
    const UPDATED_AT = 'ngaycapnhat';

    protected $fillable = [
        'madonhang',
        'khachhang_id',
        'tenkhachhang',
        'sodienthoai',
        'diachi',
        'tongtien',
        'trangthai',
        'ghichu',
    ];

    protected $casts = [
        'khachhang_id' => 'integer',
        'tongtien' => 'integer',
        'ngaytao' => 'datetime',
        'ngaycapnhat' => 'datetime',
    ];

    public function khachhang()
    {
        return $this->belongsTo(Khachhang::class, 'khachhang_id');
    }

    public function chitietdonhang()
    {
        return $this->hasMany(Chitietdonhang::class, 'donhang_id');
    }

    public function scopeMoiNhat($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public function scopeHoanThanh($query)
    {
        return $query->where('trangthai', 'hoan_thanh');
    }

    public function getTongTienHienThiAttribute()
    {
        return number_format($this->tongtien, 0, ',', '.') . ' ₫';
    }
}
