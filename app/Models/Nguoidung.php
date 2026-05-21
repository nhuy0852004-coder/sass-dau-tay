<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Nguoidung extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'nguoidung';

    const CREATED_AT = 'ngaytao';
    const UPDATED_AT = 'ngaycapnhat';

    protected $fillable = [
        'hoten',
        'email',
        'matkhau',
        'sodienthoai',
        'vaitro',
        'trangthai',
        'ngayxacnhanemail',
    ];

    protected $hidden = [
        'matkhau',
        'remember_token',
    ];

    protected $casts = [
        'matkhau' => 'hashed',
        'ngayxacnhanemail' => 'datetime',
        'ngaytao' => 'datetime',
        'ngaycapnhat' => 'datetime',
    ];

    /**
     * Laravel Auth mặc định tìm cột password.
     * Dự án dùng cột tiếng Việt là matkhau nên cần khai báo lại.
     */
    public function getAuthPassword()
    {
        return $this->matkhau;
    }
}
