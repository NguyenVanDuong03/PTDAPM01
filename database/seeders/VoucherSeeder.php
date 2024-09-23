<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\NhanVien;
use App\Models\Voucher;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $tinhTrangOptions = ['Đã sử dụng', 'Chưa sử dụng', 'Đã xóa'];
        $users =NhanVien::pluck('TenDangNhapNV');
        for ($i = 0; $i < 50; $i++) {
            Voucher::create([
                'TenDangNhapNV'=> $users->random(),
                'TiLeChietKhau' => $faker->numberBetween(10, 70),
                'HanMuc' => $faker->numberBetween(10000, 70000),
                'TinhTrang' => $faker->randomElement($tinhTrangOptions),
                'NgayTao'=> $faker->dateTimeBetween('-10 months', '-5 months')->format('Y-m-d'),
                'HanDung'=> $faker->dateTimeBetween('-4 months', 'now'),
            ]);
        }
    }
}
