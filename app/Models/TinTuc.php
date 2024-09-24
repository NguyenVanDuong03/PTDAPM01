<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\NhanVien;

class TinTuc extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'MaTinTuc';
    public $timestamps = false;
    public $fillable = ['TenSuKien', 'MaLoaiTinTuc', 'TomTat', 'NgayDang', 'TenDangNhapNV', 'NoiDung', 'Anh'];

    function getNhanVien()
    {
        $nhanvien = NhanVien::withTrashed()->where('TenDangNhapNV', $this->TenDangNhapNV)->first();
        return $nhanvien;
    }


    public function getTenLoaiTinTuc()
    {
        return LoaiTinTuc::where('MaLoaiTinTuc', $this->MaLoaiTinTuc)->first();
    }
}
