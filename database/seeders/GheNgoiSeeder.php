<?php

namespace Database\Seeders;

use App\Models\GheNgoi;
use App\Models\LoaiGhe;
use App\Models\PhongChieu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class GheNgoiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $f = Faker::create();
        $MaPhongs = PhongChieu::pluck('MaPhong');
        $MaLoaiGhes = LoaiGhe::pluck('MaLoaiGhe');
        foreach($MaPhongs as $MP){
            for($i = 1; $i <= 6; $i++){
                for($j = 1; $j <= 6; $j++){
                    GheNgoi::create([
                        'ViTriDay' => $i,
                        'ViTriCot' => $j,
                        'MaPhong' => $MP,
                        'MaLoaiGhe' => $MaLoaiGhes->random(),
                    ]);
                }
            }
            
        }
    }
}
