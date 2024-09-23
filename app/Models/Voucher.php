<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\NhanVien;

class Voucher extends Model
{
    use HasFactory;
    protected $primaryKey = 'MaVoucher';
    public $timestamps = false;
    use SoftDeletes;
    public $fillable = ['TenDangNhapNV', 'TiLeChietKhau', 'HanMuc', 'TinhTrang', 'NgayTao', 'HanDung'];

    function getNhanVien()
    {
        $nhanvien = NhanVien::withTrashed()->where('TenDangNhapNV', $this->TenDangNhapNV)->first();
        return $nhanvien;
    }
}
