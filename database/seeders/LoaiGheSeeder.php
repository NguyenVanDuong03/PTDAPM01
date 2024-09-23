<?php

namespace Database\Seeders;

use App\Models\LichSuGiaVe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LoaiGhe;
use Faker\Factory as Faker;

class LoaiGheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $f = Faker::create();
        $ten = ['Ghế vip', 'Ghế thường', 'Ghế đôi'];
        for($i = 0; $i < 3; $i ++){
            $loaighe = LoaiGhe::create([
                'TenLoaiGhe' => $ten[$i],
                'GiaVe' => $f->randomFloat(2, 10000, 100000)
            ]);
            $lichSuGiaVe = new LichSuGiaVe();
            $lichSuGiaVe->MaLoaiGhe = $loaighe->MaLoaiGhe;
            $lichSuGiaVe->GiaVe = $loaighe->GiaVe;
            $lichSuGiaVe->ThoiGianTao = now(); // Lấy ngày hiện tại
            $lichSuGiaVe->save();
        }
    }
}
