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
        $soLuong = Ve::whereBetween('created_at', [$start_date, $end_date])->count();
        return $soLuong;
    }
}
