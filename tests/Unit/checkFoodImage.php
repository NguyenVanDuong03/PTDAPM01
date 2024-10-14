<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class checkFoodImage extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $admin = User::first();
        auth()->login($admin);
    }

    public function test_FoodImage(): void
    {
        $response = $this->call('POST', '/doans', [
            'Anh' => 'anh1.png',
            'TenDoAn'  => 'Bún Bò Huế',
            'MaTheLoai' => '2',
            'MoTa' => 'Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây',
            'Gia' => '10000',
            'TinhTrang' => 'Có sẵn'
        ]);
        $response->assertStatus($response->status());
    }

    public function test_FoodImageNull(): void
    {
        $response = $this->call('POST', '/doans', [
            'Anh' => '',
            'TenDoAn'  => 'Bún Bò Huế',
            'MaTheLoai' => '2',
            'MoTa' => 'Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây',
            'Gia' => '10000',
            'TinhTrang' => 'Có sẵn'
        ]);
        $response->assertInvalid(['Anh']);
    }

    public function test_FoodImageNotImage(): void
    {
        $response = $this->call('POST', '/doans', [
            'Anh' => 'anh1.heic',
            'TenDoAn'  => 'Bún Bò Huế',
            'MaTheLoai' => '2',
            'MoTa' => 'Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây',
            'Gia' => '10000',
            'TinhTrang' => 'Có sẵn'
        ]);
        $response->assertInvalid(['Anh']);
    }

    public function test_FoodImageOverSize(): void
    {
        $response = $this->call('POST', '/doans', [
            'Anh' => 'anh1.png',
            'TenDoAn'  => 'Bún Bò Huế',
            'MaTheLoai' => '2',
            'MoTa' => 'Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây',
            'Gia' => '10000',
            'TinhTrang' => 'Có sẵn'
        ]);
        $response->assertInvalid(['Anh']);
    }
}
