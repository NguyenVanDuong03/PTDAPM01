<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LichChieu extends Model
{
    use SoftDeletes;
    protected $fillable = ['MaPhim', 'MaPhong', 'NgayChieu', 'GioChieu'];
    protected $primaryKey = 'MaLichChieu';
    public $timestamps = false;

    use HasFactory;
    public function getPhim(){
        return Phim::where('MaPhim', $this->MaPhim)->first();
    }
}
