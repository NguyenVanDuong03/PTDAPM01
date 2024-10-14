<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class checkRoomStatus extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $admin = User::first();
        auth()->login($admin);
    }

    public function test_RoomStatus(): void
    {
        $response = $this->call('POST', '/phongchieus', [
            'TenPhong' => 'Phòng 20',
            'SoLuongGhe' => '30',
            'TinhTrang' => 'Đang hoạt động',
            'LoaiPhong' => '2D',
        ]);
        $response->assertStatus($response->status());
    }

    public function test_RoomStatusNull(): void
    {
        $response = $this->call('POST', '/phongchieus', [
            'TenPhong' => 'Phòng 20',
            'SoLuongGhe' => '30',
            'TinhTrang' => '',
            'LoaiPhong' => '2D',
        ]);
        $response->assertInvalid(['TinhTrang']);
    }
}
