<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class checkRoomCategory extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $admin = User::first();
        auth()->login($admin);
    }

    public function test_RoomCategory(): void
    {
        $response = $this->call('POST', '/phongchieus', [
            'TenPhong' => 'Phòng 20',
            'SoLuongGhe' => '30',
            'TinhTrang' => 'Đang hoạt động',
            'LoaiPhong' => '2D',
        ]);
        $response->assertStatus($response->status());
    }

    public function test_RoomCategoryNull(): void
    {
        $response = $this->call('POST', '/phongchieus', [
            'TenPhong' => 'Phòng 20',
            'SoLuongGhe' => '30',
            'TinhTrang' => 'Đang hoạt động',
            'LoaiPhong' => '',
        ]);
        $response->assertInvalid(['LoaiPhong']);
    }
}
