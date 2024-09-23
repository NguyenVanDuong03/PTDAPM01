<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GheNgoi extends Model
{
    use SoftDeletes;
    protected $fillable = ['ViTriDay', 'ViTriCot', 'MaPhong', 'MaLoaiGhe'];
    protected $table = 'ghe_ngois';
    protected $primaryKey = 'MaGhe';
    protected $dates = ['deleted_at'];
    public $TrangThai = 1;
    public $GiaVe = 0;
    public function phongchieu()
    {
        return $this->belongsTo('App\Models\PhongChieu', 'MaPhong');
    }

    public function loaighe()
    {
        return $this->belongsTo('App\Models\LoaiGhe', 'MaLoaiGhe');
    }
}
