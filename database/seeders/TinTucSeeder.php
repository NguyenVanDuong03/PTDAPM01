<?php

namespace Database\Seeders;

use App\Models\TinTuc;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\NhanVien;

class TinTucSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $users =NhanVien::pluck('TenDangNhapNV');
        for ($i = 0; $i < 50; $i++) {
            TinTuc::create([
                'TenSuKien' => $faker->sentence(1),
                'MaLoaiTinTuc' => $faker->numberBetween(1, 9),
                'TomTat'=> $faker->sentence(2),
                'NgayDang'=> $faker->dateTimeBetween('-10 months', 'now'),
                'TenDangNhapNV'=> $users->random(),
                'NoiDung'=> $faker->sentence(3),
                'Anh' => $faker->imageUrl(300, 250, 'food'),
            ]);
        }
    }
}
