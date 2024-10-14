<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class checkFoodName extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $admin = User::first();
        auth()->login($admin);
    }

    public function test_FoodName(): void
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

    public function test_FoodNameNull(): void
    {
        $response = $this->call('POST', '/doans', [
            'Anh' => 'anh1.png',
            'TenDoAn'  => '',
            'MaTheLoai' => '2',
            'MoTa' => 'Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây',
            'Gia' => '10000',
            'TinhTrang' => 'Có sẵn'
        ]);
        $response->assertInvalid(['TenDoAn']);
    }

    public function test_FoodNameMax(): void
    {
        $response = $this->call('POST', '/doans', [
            'Anh' => 'anh1.png',
            'TenDoAn'  => 'Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây',
            'MaTheLoai' => '2',
            'MoTa' => 'Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây',
            'Gia' => '10000',
            'TinhTrang' => 'Có sẵn'
        ]);
        $response->assertInvalid(['TenDoAn']);
    }

    public function test_FoodNameSpecialCharacters(): void
    {
        $response = $this->call('POST', '/doans', [
            'Anh' => 'anh1.png',
            'TenDoAn'  => 'Bún Bò Huế',
            'MaTheLoai' => '2',
            'MoTa' => 'Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây',
            'Gia' => '10000',
            'TinhTrang' => 'Có sẵn'
        ]);
        $response->assertValid(['TenDoAn']);
    }
}
