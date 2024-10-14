<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class checkFilmImage extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $admin = User::first();
        auth()->login($admin);
    }

    public function test_FilmImage(): void
    {
        $response = $this->call('POST', '/phims', [
            'MaTheLoai' => '1',
            'MaNCC' => '1',
            'TenPhim'  => 'Quái Vật Săn Mồi',
            'ThoiLuong' => '55',
            'NgayCongChieu' => '2024-12-12',
            'TrangThai' => 'Sắp Chiếu',
            'TomTat' => 'Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây',
            'image' => 'anh1.png',
        ]);
        $response->assertStatus($response->status());
    }

    public function test_FilmImageNull(): void
    {
        $response = $this->call('POST', '/phims', [
            'MaTheLoai' => '1',
            'MaNCC' => '1',
            'TenPhim'  => 'Quái Vật Săn Mồi',
            'ThoiLuong' => '55',
            'NgayCongChieu' => '2024-12-12',
            'TrangThai' => 'Sắp Chiếu',
            'TomTat' => 'Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây',
            'image' => '',
        ]);
        $response->assertInvalid(['image']);
    }

    public function test_FilmImageNotImage(): void
    {
        $response = $this->call('POST', '/phims', [
            'MaTheLoai' => '1',
            'MaNCC' => '1',
            'TenPhim'  => 'Quái Vật Săn Mồi',
            'ThoiLuong' => '55',
            'NgayCongChieu' => '2024-12-12',
            'TrangThai' => 'Sắp Chiếu',
            'TomTat' => 'Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây',
            'image' => 'anh1.heic',
        ]);
        $response->assertInvalid(['image']);
    }

    public function test_FilmImageSize(): void
    {
        $response = $this->call('POST', '/phims', [
            'MaTheLoai' => '1',
            'MaNCC' => '1',
            'TenPhim'  => 'Quái Vật Săn Mồi',
            'ThoiLuong' => '55',
            'NgayCongChieu' => '2024-12-12',
            'TrangThai' => 'Sắp Chiếu',
            'TomTat' => 'Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây',
            'image' => 'anh5.jpg',
        ]);
        $response->assertInvalid(['image']);
    }
}
