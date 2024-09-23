<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NhanVien extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'TenDangNhapNV',
        'TenNhanVien',
        'NgaySinh',
        'GioiTinh',
        'DiaChi',
        'NgayVaoLam',
        'ViTri',
        'SDT',
        'Gmail'
    ];
}
