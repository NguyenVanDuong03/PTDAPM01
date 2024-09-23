<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LichSuGiaVe extends Model
{
    use SoftDeletes;
    protected $fillable = ['MaLoaiGhe', 'ThoiGianTao', 'GiaVe'];
    protected $table = 'lich_su_gia_ves';
    protected $primaryKey = 'MaGiaVe';
    protected $dates = ['deleted_at'];

    public function loaighe()
    {
        return $this->belongsTo('App\Models\LoaiGhe', 'MaLoaiGhe');
    }
    public function getTenLoaiGhe()
    {
        $tenloaighe = LoaiGhe::where('MaLoaiGhe', $this->MaLoaiGhe)->first();
        return $tenloaighe;
    }
}
