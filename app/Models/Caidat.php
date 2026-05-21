<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caidat extends Model
{
    use HasFactory;

    protected $table = 'caidat';

    const CREATED_AT = 'ngaytao';
    const UPDATED_AT = 'ngaycapnhat';

    protected $fillable = [
        'tenkhoahoc',
        'giatri',
        'kieudulieu',
        'mota',
    ];

    protected $casts = [
        'ngaytao' => 'datetime',
        'ngaycapnhat' => 'datetime',
    ];

    public static function layGiaTri($tenkhoahoc, $macdinh = null)
    {
        return static::where('tenkhoahoc', $tenkhoahoc)->value('giatri') ?? $macdinh;
    }

    public static function capNhatGiaTri($tenkhoahoc, $giatri, $kieudulieu = 'text', $mota = null)
    {
        return static::updateOrCreate(
            ['tenkhoahoc' => $tenkhoahoc],
            [
                'giatri' => $giatri,
                'kieudulieu' => $kieudulieu,
                'mota' => $mota,
            ]
        );
    }
}
