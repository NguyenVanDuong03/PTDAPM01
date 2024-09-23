<?php

namespace Database\Seeders;

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
        $tinhTrangOptions = ['Bình thường', 'Ngưng sử dụng', 'Tạm ngưng'];
        for ($i = 1; $i < 10; $i++) {
            PhongChieu::create([
                // 'MaPhong' =>  $i,
                'SoLuongGhe' => $faker->numberBetween(30, 100),
                'TinhTrang' => $faker->randomElement($tinhTrangOptions),
            ]);
        }
    }
}
