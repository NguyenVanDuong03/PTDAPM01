<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DatVe extends Model
{
    use HasFactory;
    public $MaKhachHang = 'hahaha';
    public function datetimeTodate($datetime){
        $carbon = Carbon::instance($datetime);
        return $carbon->toDateString();
    }
    public function checkIfGheIsEmpty($PeriodOfTime, $MaGhe){
        return true;
    }
}
