<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\LichChieu;
use App\Models\Phim;
use App\Models\PhongChieu;
use DateInterval;

class LichChieuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $maphim = Phim::pluck('MaPhim');
        $maphong = PhongChieu::pluck('MaPhong');

        for ($i = 0; $i < 20; $i++) {
            $phimchon = $maphim->random();
            $ngayCongChieu = Phim::where('MaPhim', $phimchon)->pluck('NgayCongChieu')->first();

            // Convert string to DateTime
            $ngayCongChieu = new \DateTime($ngayCongChieu);

            if ($ngayCongChieu) {
                $lichchieu = LichChieu::create([
                    'MaPhim' => $phimchon,
                    'MaPhong' => $maphong->random(),
                    'ThoiGianBatDau' => $faker->dateTimeBetween($ngayCongChieu->add(new DateInterval('P1D')), $ngayCongChieu->add(new DateInterval('P3D'))),
                ]);
            } else {
                continue;
            }
        }
    }
}
