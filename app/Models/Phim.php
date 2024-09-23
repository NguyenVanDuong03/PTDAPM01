<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phim extends Model
{
    use SoftDeletes;
    protected $fillable = ['MaTheLoai', 'MaNCC', 'TenPhim', 'ThoiLuong', 'NgayCongChieu', 'TrangThai', 'MoTa','DuongDan'];
    protected $table = 'phims';
    protected $primaryKey = 'MaPhim';
    protected $dates = ['deleted_at'];
    public function theloai()
    {
        return $this->belongsTo('App\Models\TheLoai', 'MaTheLoai');
    }
    
    public function nhacungcap()
    {
        return $this->belongsTo('App\Models\NhaCungCap', 'MaNCC');
    }
}
