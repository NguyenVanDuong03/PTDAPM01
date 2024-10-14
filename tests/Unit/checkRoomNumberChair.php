<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class checkRoomNumberChair extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $admin = User::first();
        auth()->login($admin);
    }

    public function test_RoomNumberChair(): void
    {
        $response = $this->call('POST', '/phongchieus', [
            'TenPhong' => 'Phòng 20',
            'SoLuongGhe' => '30',
            'TinhTrang' => 'Đang hoạt động',
            'LoaiPhong' => '2D',
        ]);
        $response->assertStatus($response->status());
    }

    public function test_RoomNumberChairNull(): void
    {
        $response = $this->call('POST', '/phongchieus', [
            'TenPhong' => 'Phòng 20',
            'SoLuongGhe' => '',
            'TinhTrang' => 'Đang hoạt động',
            'LoaiPhong' => '2D',
        ]);
        $response->assertInvalid(['SoLuongGhe']);
    }

    public function test_RoomNumberChairSpecialCharacters(): void
    {
        $response = $this->call('POST', '/phongchieus', [
            'TenPhong' => 'Phòng 20',
            'SoLuongGhe' => '@10',
            'TinhTrang' => 'Đang hoạt động',
            'LoaiPhong' => '2D',
        ]);
        $response->assertInvalid(['SoLuongGhe']);
    }

    public function test_RoomNumberChairMin(): void
    {
        $response = $this->call('POST', '/phongchieus', [
            'TenPhong' => 'Phòng 20',
            'SoLuongGhe' => '0',
            'TinhTrang' => 'Đang hoạt động',
            'LoaiPhong' => '2D',
        ]);
        $response->assertInvalid(['SoLuongGhe']);
    }

    public function test_RoomNumberChairMax(): void
    {
        $response = $this->call('POST', '/phongchieus', [
            'TenPhong' => 'Phòng 20',
            'SoLuongGhe' => '1000',
            'TinhTrang' => 'Đang hoạt động',
            'LoaiPhong' => '2D',
        ]);
        $response->assertInvalid(['SoLuongGhe']);
    }
}
