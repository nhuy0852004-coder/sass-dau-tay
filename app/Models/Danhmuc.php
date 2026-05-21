<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Danhmuc extends Model
{
    use HasFactory;

    protected $table = 'danhmuc';

    const CREATED_AT = 'ngaytao';
    const UPDATED_AT = 'ngaycapnhat';

    protected $fillable = [
        'tendanhmuc',
        'slug',
        'mota',
        'thutu',
        'trangthai',
    ];

    protected $casts = [
        'thutu' => 'integer',
        'ngaytao' => 'datetime',
        'ngaycapnhat' => 'datetime',
    ];

    public function sanpham()
    {
        return $this->hasMany(Sanpham::class, 'danhmuc_id');
    }

    public function scopeDangHien($query)
    {
        return $query->where('trangthai', 'hien');
    }

    public function scopeSapXep($query)
    {
        return $query->orderBy('thutu')->orderBy('id', 'desc');
    }
}
