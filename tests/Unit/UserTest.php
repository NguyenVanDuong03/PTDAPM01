<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_newName(): void
    {
        // Giả lập đăng nhập bằng tài khoản admin cố định
        $admin = User::where('email', 'phong@gmail.com')->first();

        if ($admin) {
            $this->actingAs($admin); // Đăng nhập bằng tài khoản admin
        }
        $response = $this->call('POST', '/tintucs', [
            'TenSuKien' => 'Trên con đường dài thẳng tắp, ánh nắng vàng nhạt xuyên qua những tán lá cây',
            'MaLoaiTinTuc' => '1',
            'TomTat' => 'Trên con đường dài thẳng tắp, ánh nắng vàng nhạt xuyên qua những tán lá cây',
            'NgayDang' => '2021-12-12',
            'TenDangNhapNV' => '1',
            'HinhAnh' => '',
            'NoiDung' => 'Trên con đường dài thẳng tắp, ánh nắng vàng nhạt xuyên qua những tán lá cây, ánh nắng vàng nhạt xuyên qua những tán lá cây, ánh nắng vàng nhạt xuyên qua những tán lá cây',
        ]);
        // Kiểm tra trạng thái thành công
        $response->assertStatus(200);

        // Kiểm tra nếu dữ liệu đã được lưu vào cơ sở dữ liệu
        $this->assertDatabaseHas('tintucs', [
            'TenSuKien' => 'Trên con đường dài thẳng tắp, ánh nắng vàng nhạt xuyên qua những tán lá cây',
        ]);
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
            'NoiDung' => 'Trên con đường dài thẳng tắp, ánh nắng vàng nhạt xuyên qua những tán lá cây, ánh nắng vàng nhạt xuyên qua những tán lá cây, ánh nắng vàng nhạt xuyên qua những tán lá cây',
        ]);
        // Kiểm tra mã lỗi 422 do validate fail
        $response->assertStatus(422);

        // Kiểm tra nội dung phản hồi để chắc chắn Laravel trả về thông báo lỗi cho 'TenSuKien'
        $response->assertJsonValidationErrors('TenSuKien');
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
            'NoiDung' => 'Trên con đường dài thẳng tắp, ánh nắng vàng nhạt xuyên qua những tán lá cây, ánh nắng vàng nhạt xuyên qua những tán lá cây, ánh nắng vàng nhạt xuyên qua những tán lá cây',
        ]);
        // Kiểm tra lỗi validate với ký tự đặc biệt nếu validate cho phép
        $response->assertStatus(422);
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
        // Kiểm tra lỗi validate cho độ dài vượt quá giới hạn
        $response->assertStatus(422);

        // Kiểm tra phản hồi có chứa lỗi cho trường 'TenSuKien'
        $response->assertJsonValidationErrors('TenSuKien');
    }
}
