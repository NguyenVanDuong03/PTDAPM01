<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhongChieu extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $timestamps = false;
    protected $primaryKey = 'MaPhong';

    public $fillable = ['TenPhong', 'MaLoaiPhong', 'SoLuongGhe', 'TinhTrang'];

    // protected $table = 'phong_chieus';
    // protected $dates = ['deleted_at'];
    public function ghengoi()
    {
        return $this->hasMany(GheNgoi::class);
    }

    public function loaiphong()
    {
        return $this->belongsTo(LoaiPhong::class, 'MaLoaiPhong');
    }

    function getTenphong()
    {
        $tenphong = LoaiPhong::where('MaLoaiPhong', $this->MaLoaiPhong)->first();
        return $tenphong;
    }

}
