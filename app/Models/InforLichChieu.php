<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InforLichChieu extends Model
{
    
    public $NgayChieu;
    // public $GioChieu;
    public $MaPhong;
    public $LichChieus=[];

    public static function addMinutesToTime($ThoiGian, $SoPhut)
    {
        $time = Carbon::parse($ThoiGian);  // Chuyển đổi chuỗi thời gian thành đối tượng Carbon
        $time->addMinutes($SoPhut);      // Cộng thêm số phút vào thời gian
    
        return $time->format('H:i:s');  // Trả về chuỗi thời gian định dạng giờ:phút
    }
    public static function NormalizationTimeString($timeString){
        return Carbon::parse($timeString)->format('H:i:s');
    }
   
    public  function DatetimeToTime($dateTime){
        $dateTime = Carbon::createFromFormat('Y-m-d H:i:s', $dateTime); // Tạo đối tượng Carbon từ chuỗi datetime
        $time = $dateTime->format('H:i'); // Chuyển đổi thành chuỗi giờ và phút
        return $time;
    }
    public  function DatetimeToDate($dateTime){
        $dateTime = Carbon::createFromFormat('Y-m-d H:i:s', $dateTime); // Tạo đối tượng Carbon từ chuỗi datetime
        $date = $dateTime->format('Y-m-d'); // Chuyển đổi thành chuỗi giờ và phút
        return $date;
    }
    public function TimeToDatetime($date, $time){
        $dateTimeString = $date . ' ' . $time . ':00'; // Kết hợp chuỗi thời gian với ngày hiện tại
        $dateTime = Carbon::createFromFormat('Y-m-d H:i:s', $dateTimeString); // Tạo đối tượng Carbon từ chuỗi datetime
        return $dateTime->format('Y-m-d H:i:s'); // In ra chuỗi datetime
    }
}
