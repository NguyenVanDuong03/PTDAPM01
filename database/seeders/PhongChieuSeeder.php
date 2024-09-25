<?php

namespace Database\Seeders;

use App\Models\LoaiPhong;
use App\Models\PhongChieu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PhongChieuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $tinhTrangOptions = ['Bình thường', 'Tạm ngưng', 'Ngừng sử dụng'];
        $loaiphongs = LoaiPhong::pluck('MaLoaiPhong');
        for ($i = 1; $i < 10; $i++) {
            PhongChieu::create([
                // 'MaPhong' =>  $i,
                'TenPhong' => 'Phòng ' . $i,
                'MaLoaiPhong' => $loaiphongs->random(),
                'SoLuongGhe' => $faker->numberBetween(20, 50),
                'TinhTrang' => $faker->randomElement($tinhTrangOptions),
            ]);
        }
    }
}
