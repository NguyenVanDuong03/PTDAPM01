<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\LoaiDoAn;

class LoaiDoAnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $tenloais = ['Bánh','Tráng miệng','Nước ngọt', 'Đồ ăn vặt'];
        for ($i = 0; $i < 4; $i++) {
            LoaiDoAn::create([
                'TenTheLoai' => $tenloais[$i],
                'MoTa' => $faker->sentence(2),
            ]);
        }
    }
}
