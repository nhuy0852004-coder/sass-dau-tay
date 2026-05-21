<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sanpham extends Model
{
    use HasFactory;

    protected $table = 'sanpham';

    const CREATED_AT = 'ngaytao';
    const UPDATED_AT = 'ngaycapnhat';

    protected $fillable = [
        'masanpham',
        'tensanpham',
        'slug',
        'danhmuc_id',
        'giaban',
        'giakhuyenmai',
        'soluongton',
        'trangthai',
        'mota',
        'hinhanh',
    ];

    protected $casts = [
        'danhmuc_id' => 'integer',
        'giaban' => 'integer',
        'giakhuyenmai' => 'integer',
        'soluongton' => 'integer',
        'ngaytao' => 'datetime',
        'ngaycapnhat' => 'datetime',
    ];

    public function danhmuc()
    {
        return $this->belongsTo(Danhmuc::class, 'danhmuc_id');
    }

    public function chitietdonhang()
    {
        return $this->hasMany(Chitietdonhang::class, 'sanpham_id');
    }

    public function scopeDangBan($query)
    {
        return $query->where('trangthai', 'dang_ban');
    }

    public function scopeSapXepMoiNhat($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public function getGiaBanHienThiAttribute()
    {
        return number_format($this->giaban, 0, ',', '.') . ' ₫';
    }

    public function getGiaKhuyenMaiHienThiAttribute()
    {
        if ($this->giakhuyenmai === null) {
            return null;
        }

        return number_format($this->giakhuyenmai, 0, ',', '.') . ' ₫';
    }
}
