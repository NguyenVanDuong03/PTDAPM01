<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Faker\Factory as Faker;


class DoAn extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $fillable = ['Anh', 'TenDoAn', 'MaTheLoai', 'MoTa', 'TrangThai', ];
    protected $primaryKey = 'MaDoAn';

    function getLoaiDoAn()
    {
        $loaidoan = LoaiDoAn::withTrashed()->where('MaTheLoai', $this->MaTheLoai)->first();
        return $loaidoan;
    }
    function getGiaDoAn(){
        $lsgda = LichSuGiaDoAn::where('MaDoAn', $this->MaDoAn)
            ->orderByDesc('ThoiGianTao')->first();
        return $lsgda->Gia;
    }

}
