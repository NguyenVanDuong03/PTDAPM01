<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class checkFilmTimes extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $admin = User::first();
        auth()->login($admin);
    }

    public function test_FilmTimes(): void
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

    public function test_FilmTimesNull(): void
    {
        $response = $this->call('POST', '/phims', [
            'MaTheLoai' => '1',
            'MaNCC' => '1',
            'TenPhim'  => 'Quái Vật Săn Mồi',
            'ThoiLuong' => '',
            'NgayCongChieu' => '2024-12-12',
            'TrangThai' => 'Sắp Chiếu',
            'TomTat' => 'Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây',
            'image' => 'anh1.png',
        ]);
        $response->assertInvalid(['ThoiLuong']);
    }

    public function test_FilmTimesLength(): void
    {
        $response = $this->call('POST', '/phims', [
            'MaTheLoai' => '1',
            'MaNCC' => '1',
            'TenPhim'  => 'Quái Vật Săn Mồi',
            'ThoiLuong' => '301',
            'NgayCongChieu' => '2024-12-12',
            'TrangThai' => 'Sắp Chiếu',
            'TomTat' => 'Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây',
            'image' => 'anh1.png',
        ]);
        $response->assertInvalid(['ThoiLuong']);
    }

    public function test_FilmTimesLessThanZero(): void
    {
        $response = $this->call('POST', '/phims', [
            'MaTheLoai' => '1',
            'MaNCC' => '1',
            'TenPhim'  => 'Quái Vật Săn Mồi',
            'ThoiLuong' => '-1',
            'NgayCongChieu' => '2024-12-12',
            'TrangThai' => 'Sắp Chiếu',
            'TomTat' => 'Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây',
            'image' => 'anh1.png',
        ]);
        $response->assertInvalid(['ThoiLuong']);
    }

    public function test_FilmTimesString(): void
    {
        $response = $this->call('POST', '/phims', [
            'MaTheLoai' => '1',
            'MaNCC' => '1',
            'TenPhim'  => 'Quái Vật Săn Mồi',
            'ThoiLuong' => 'abc@',
            'NgayCongChieu' => '2024-12-12',
            'TrangThai' => 'Sắp Chiếu',
            'TomTat' => 'Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây',
            'image' => 'anh1.png',
        ]);
        $response->assertInvalid(['ThoiLuong']);
    }
}
