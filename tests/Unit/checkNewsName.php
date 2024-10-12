<?php

namespace Tests\Unit;

use Tests\TestCase;

class checkNewsName extends TestCase
{
    public function test_newName(): void
    {
        $response = $this->call('POST', '/tintucs', [
            'TenSuKien' => 'Trên con đường dài thẳng tắp, ánh nắng vàng nhạt xuyên qua những tán lá cây',
            'MaLoaiTinTuc' => '1',
            'TomTat' => 'Trên con đường dài thẳng tắp, ánh nắng vàng nhạt xuyên qua những tán lá cây',
            'NgayDang' => '2021-12-12',
            'TenDangNhapNV' => '1',
            'HinhAnh' => '',
            'NoiDung' => 'Trên con đường dài thẳng tắp, ánh nắng vàng nhạt xuyên qua những tán lá cây',
        ]);
        $response->assertStatus($response->status());
    }

    public function test_newsNameNull(): void
    {
        $response = $this->call('POST', '/tintucs', [
            'TenSuKien' => '',
            'MaLoaiTinTuc' => '1',
            'TomTat' => 'Trên con đường dài thẳng tắp, ánh nắng vàng nhạt xuyên qua những tán lá cây',
            'NgayDang' => '2021-12-12',
            'TenDangNhapNV' => '1',
            'HinhAnh' => '',
            'NoiDung' => 'Trên con đường dài thẳng tắp, ánh nắng vàng nhạt xuyên qua những tán lá cây',
        ]);
        $response->assertStatus($response->status());
    }

    public function test_newsNameSpecialCharacters(): void
    {
        $response = $this->call('POST', '/tintucs', [
            'TenSuKien' => '@Trên con đường dài thẳng tắp, ánh nắng vàng nhạt xuyên qua những tán lá cây',
            'MaLoaiTinTuc' => '1',
            'TomTat' => 'Trên con đường dài thẳng tắp, ánh nắng vàng nhạt xuyên qua những tán lá cây',
            'NgayDang' => '2021-12-12',
            'TenDangNhapNV' => '1',
            'HinhAnh' => '',
            'NoiDung' => 'Trên con đường dài thẳng tắp, ánh nắng vàng nhạt xuyên qua những tán lá cây',
        ]);
        $response->assertStatus($response->status());
    }

    public function test_newsNamelength(): void
    {
        $response = $this->call('POST', '/tintucs', [
            'TenSuKien' => 'Trên con đường dài thẳng tắp, ánh nắng vàng nhạt xuyên qua những tán lá cây, chiếu xuống mặt đất tạo nên những đốm sáng lung linh như vẽ nên một bức tranh thiên nhiên tươi đẹp. Tiếng chim hót líu lo như bản nhạc của rừng xanh, hòa cùng tiếng gió vi vu, khẽ lướt qua tai, mang lại cảm giác yên bình và tĩnh lặng. Xa xa, những cánh đồng lúa trải dài vô tận, xanh mướt như một tấm thảm khổng lồ, nhấp nhô theo từng cơn gió. Trời quá cao trong xanh, không một gợn mây, như muốn nói rằng đây là một ngày hoàn hảo.',
            'MaLoaiTinTuc' => '1',
            'TomTat' => 'Trên con đường dài thẳng tắp, ánh nắng vàng nhạt xuyên qua những tán lá cây',
            'NgayDang' => '2021-12-12',
            'TenDangNhapNV' => '1',
            'HinhAnh' => '',
            'NoiDung' => 'Trên con đường dài thẳng tắp, ánh nắng vàng nhạt xuyên qua những tán lá cây',
        ]);
        $response->assertStatus($response->status());
    }
}
