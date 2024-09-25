<?php

namespace Database\Seeders;

use App\Models\DoAn;
use App\Models\LichSuGiaDoAn;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\LoaiDoAn;

class DoAnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $matheloai = LoaiDoAn::pluck('MaTheLoai');
        $trangthai = ['Có sẵn', 'Không có sẵn'];
        for ($i = 0; $i < 50; $i++) {
            $doan = DoAn::create([
                'TenDoAn' => $faker->sentence(1),
                'MaTheLoai' => $matheloai->random(),
                'MoTa' => $faker->sentence(5),
                'TinhTrang' => $faker->randomElement($trangthai),
                'Anh' => $faker->imageUrl(300, 250, 'food'),
            ]);
            LichSuGiaDoAn::create([
                'MaDoAn' => $doan->MaDoAn,
                'ThoiGianTao' => now(),
                'Gia' => $faker->numberBetween(20000, 100000),
            ]);
        }
    }
}
