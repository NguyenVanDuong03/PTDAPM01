<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class ThongKe extends Model
{
    use HasFactory;

    public function thongKeByDay($start_date, $end_date)
    {
        $soLuong = Ve::whereBetween('created_at', [$start_date, $end_date])->count();
        return $soLuong;
    }

    public function thongKeDoanhThuByDay($start_date, $end_date)
    {
        $tongGiaVe = Ve::join('ghe_ngois', 'ves.MaGhe', '=', 'ghe_ngois.MaGhe')
                        ->join('loai_ghes', 'loai_ghes.MaLoaiGhe', '=', 'ghe_ngois.MaLoaiGhe')
                        ->whereBetween('ves.created_at', [$start_date, $end_date])
                        ->sum('loai_ghes.GiaVe');
    
        return $tongGiaVe;
    }
    
}
