<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class ThongKe extends Model
{
    use HasFactory;

    public function thongKeByDay(Date start, Date end){
        String sql = "SELECT GiaVe FROM `ves` JOIN `ghe_ngois` ON `ves`.`MaGhe` = `ghe_ngois`.`MaGhe`  JOIN `loai_ghes` ON `loai_ghes`.`MaLoaiGhe` = `ghe_ngois`.`MaLoaiGhe` WHERE `ves`.`MaVe`=4;
        "
    }
}
