<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\NhanVien;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class NhanVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $f = Faker::create();
        for($i = 0; $i < 10; $i++){
            $email = $f->email();
            User::create([
                'email' => $email,
                'password' => Hash::make('1'),
                'VaiTro' => 2
            ]);
            NhanVien::create([
                'TenDangNhapNV' => $email,  
                'TenNhanVien' => $f->name(),
                'NgaySinh' => $f->date(),
                'GioiTinh' => $f->randomElement(['Nam', 'Nữ', 'Giới tính khác']),
                'DiaChi' => $f->city(),
                'NgayVaoLam' => $f->date(),
                'ViTri' => $f->randomElement(['Bán vé', 'Tạp vụ']),
                'SDT' => $f->numerify('0#########'),
                'Gmail' => $email
            ]);
        }
    }
}
