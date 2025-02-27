<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class checkNameOfPostingStaff extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $admin = User::first();
        auth()->login($admin);
    }

    public function test_NameOfPostingStaff(): void
    {
        $response = $this->call('POST', '/tintucs', [
            'TenSuKien' => 'Anh lkajdf flajdflakjf kkajdf lakjdf ljfla',
            'MaLoaiTinTuc' => '1',
            'TomTat' => 'Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây',
            'NgayDang' => '2021-12-12',
            'TenDangNhapNV' => '1',
            'Anh' => 'anh1.jpg',
            'NoiDung' => 'Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây',
        ]);

        $response->assertStatus($response->status());
    }

    public function test_NameOfPostingStaffNull(): void
    {
        $response = $this->call('POST', '/tintucs', [
            'TenSuKien' => 'Anh lkajdf flajdflakjf kkajdf lakjdf ljfla',
            'MaLoaiTinTuc' => '1',
            'TomTat' => 'Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây',
            'NgayDang' => '2021-12-12',
            'TenDangNhapNV' => '',
            'Anh' => 'anh1.jpg',
            'NoiDung' => 'Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây',
        ]);

        $response->assertInvalid(['TenDangNhapNV']);
    }
}
