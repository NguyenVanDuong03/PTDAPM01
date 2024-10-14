<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class checkRoomName extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $admin = User::first();
        auth()->login($admin);
    }

    public function test_RoomName(): void
    {
        $response = $this->call('POST', '/phongchieus', [
            'TenPhong' => 'Phòng 20',
            'SoLuongGhe' => '30',
            'TinhTrang' => 'Đang hoạt động',
            'LoaiPhong' => '2D',
        ]);
        $response->assertStatus($response->status());
    }

    public function test_RoomNameNull(): void
    {
        $response = $this->call('POST', '/phongchieus', [
            'TenPhong' => '',
            'SoLuongGhe' => '30',
            'TinhTrang' => 'Đang hoạt động',
            'LoaiPhong' => '2D',
        ]);
        $response->assertInvalid(['TenPhong']);
    }

    public function test_RoomSpecialCharacters(): void
    {
        $response = $this->call('POST', '/phongchieus', [
            'TenPhong' => '@Phòng 20',
            'SoLuongGhe' => '30',
            'TinhTrang' => 'Đang hoạt động',
            'LoaiPhong' => '2D',
        ]);
        $response->assertInvalid(['TenPhong']);
    }

    public function test_RoomNameMax(): void
    {
        $response = $this->call('POST', '/phongchieus', [
            'TenPhong' => 'Phong co ten dai nhat trong cac phong chieu phim',
            'SoLuongGhe' => '30',
            'TinhTrang' => 'Đang hoạt động',
            'LoaiPhong' => '2D',
        ]);
        $response->assertInvalid(['TenPhong']);
    }

    public function test_RoomDuplicate(): void
    {
        $response = $this->call('POST', '/phongchieus', [
            'TenPhong' => 'Phòng 1',
            'SoLuongGhe' => '30',
            'TinhTrang' => 'Đang hoạt động',
            'LoaiPhong' => '2D',
        ]);
        $response->assertInvalid(['TenPhong']);
    }
}
