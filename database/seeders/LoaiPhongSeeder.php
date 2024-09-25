<?php

namespace Database\Seeders;

use App\Models\LoaiPhong;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class LoaiPhongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $loaiphongs = ['2D', '3D', 'IMAX', '4DX'];
        for ($i = 1; $i < 5; $i++) {
            LoaiPhong::create([
                'TenLoaiPhong' => $loaiphongs[$i],
            ]);
        }
    }
}
