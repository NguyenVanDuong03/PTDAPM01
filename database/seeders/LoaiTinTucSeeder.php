<?php

namespace Database\Seeders;

use App\Models\LoaiTinTuc;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class LoaiTinTucSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $tenloais = ['Thông báo rạp','Tin tức nổi bật','Tin tức sự kiện', 'Tin tức độc quyền', 'Cập nhật lịch chiếu', 'Khuyến mãi và ưu đãi', 'Phim mới ra mắt', 'Cuộc thi và trò chơi', 'Sự kiện fan hâm mộ'];
        for ($i = 0; $i < 9; $i++) {
            LoaiTinTuc::create([
                'TenLoaiTinTuc' => $tenloais[$i],
                'MoTa' => $faker->sentence(2),
            ]);
        }
    }
}
