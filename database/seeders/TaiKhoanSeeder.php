<?php

namespace Database\Seeders;

use App\Models\KhachHang;
use App\Models\NhanVien;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TaiKhoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $f = Faker::create();
        User::create([
            'email' => 'phong@gmail.com',
            'password' => Hash::make('12345678'),
            'VaiTro' => 1
        ]);
        NhanVien::create([
            'TenDangNhapNV' => 'phong@gmail.com',
            'TenNhanVien' => 'Nhan vien cham chi',
            'NgaySinh' => '2001-12-1',
            'GioiTinh' => 'Nam',
            'DiaChi' => 'Cầu Giấy',
            'NgayVaoLam' => '2024-01-01',
            'ViTri' => 'Admin',
            'SDT' => '0352186176',
            'Gmail' => 'phong@gmail.com',
        ]);
        User::create([
            'email' => 'nhanvien@gmail.com',
            'password' => Hash::make('12345678'),
            'VaiTro' => 2
        ]);
        NhanVien::create([
            'TenDangNhapNV' => 'nhanvien@gmail.com',
            'TenNhanVien' => 'Nhan vien cham chi',
            'NgaySinh' => '2001-12-1',
            'GioiTinh' => 'Nữ',
            'DiaChi' => 'Cầu Giấy',
            'NgayVaoLam' => '2024-01-01',
            'ViTri' => 'Pha chế',
            'SDT' => '0352186176',
            'Gmail' => 'nhanvien@gmail.com',
        ]);
        User::create([
            'email' => 'khach@gmail.com',
            'password' => Hash::make('12345678'),
            'VaiTro' => 3
        ]);
        KhachHang::create([
            'TenDangNhapKH' => 'khach@gmail.com',
            'TenKhachHang' => 'Khach cute',
            'NgaySinh' => '2003-12-9',
            'GioiTinh' => 'Nữ',
            'SDT' => '0358263852',
            'Gmail' => 'khach@gmail.com'
        ]);
    }
}
