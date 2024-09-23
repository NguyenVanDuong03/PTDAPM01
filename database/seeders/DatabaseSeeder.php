<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\DoAn;
use App\Models\LoaiDoAn;
use App\Models\LoaiGhe;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            // LoaiDoAnSeeder::class,
            TaiKhoanSeeder::class,
            NhanVienSeeder::class,
            LoaiDoAnSeeder::class,
            DoAnSeeder::class,
            PhongChieuSeeder::class,
            LoaiGheSeeder::class,
            GheNgoiSeeder::class,
            TinTucSeeder::class,
            VoucherSeeder::class
        ]);
    }
}
