<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class checkSummary extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $admin = User::first();
        auth()->login($admin);
    }

    public function test_Summary(): void
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

    public function test_SummaryNull(): void
    {
        $response = $this->call('POST', '/tintucs', [
            'TenSuKien' => 'Anh lkajdf flajdflakjf kkajdf lakjdf ljfla',
            'MaLoaiTinTuc' => '1',
            'TomTat' => '',
            'NgayDang' => '2021-12-12',
            'TenDangNhapNV' => '1',
            'Anh' => 'anh1.jpg',
            'NoiDung' => 'Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây',
        ]);

        $response->assertInvalid(['TomTat']);
    }

    public function test_SummarySpecialCharacters(): void
    {
        $response = $this->call('POST', '/tintucs', [
            'TenSuKien' => 'Anh lkajdf flajdflakjf kkajdf lakjdf ljfla',
            'MaLoaiTinTuc' => '1',
            'TomTat' => '@Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây',
            'NgayDang' => '2021-12-12',
            'TenDangNhapNV' => '1',
            'Anh' => 'anh1.jpg',
            'NoiDung' => 'Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây',
        ]);

        $response->assertInvalid(['TomTat']);
    }

    public function test_SummaryLength(): void
    {
        $response = $this->call('POST', '/tintucs', [
            'TenSuKien' => 'Anh lkajdf flajdflakjf kkajdf lakjdf ljfla',
            'MaLoaiTinTuc' => '1',
            'TomTat' => 'Trên dải đất hình chữ S Việt Nam nổi bật với vẻ đẹp thiên nhiên kỳ vĩ và nền văn hóa đa dạng Từ những cánh đồng lúa bát ngát của đồng bằng sông Cửu Long đến những ngọn núi cao trùng điệp ở Tây Bắc, mỗi vùng miền đều có bản sắc riêng biệt Không chỉ là cảnh sắc thiên nhiên con người Việt Nam cũng là một phần không thể thiếu của bức tranh này với lòng hiếu khách và tình cảm chân thành. Những món ăn truyền thống, như phở, bún chả, bánh mì, đã trở thành biểu tượng văn hóa ẩm thực, thu hút hàng triệu du khách mỗi năm. Không chỉ dừng lại ở đó, Việt Nam còn tự hào với hàng loạt di sản văn hóa, từ phố cổ Hội An, vịnh Hạ Long cho đến quần thể Tràng An. Mỗi di sản là một minh chứng cho sự trường tồn của lịch sử và sự sáng tạo của con người qua nhiều thế hệ. Việt Nam không ngừng phát triển, hòa mình vào dòng chảy toàn cầu, nhưng vẫn giữ vững những giá trị truyền thống sâu sắc. Chính sự kết hợp giữa quá khứ và hiện tại đã tạo nên một Việt Nam độc đáo và cuốn hút, mang lại niềm tự hào không chỉ cho người dân trong nước mà còn làm say đắm những ai đã từng ghé thăm.',
            'NgayDang' => '2021-12-12',
            'TenDangNhapNV' => '1',
            'Anh' => 'anh1.jpg',
            'NoiDung' => 'Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây Trên con đường dài thẳng tắp ánh nắng vàng nhạt xuyên qua những tán lá cây',
        ]);

        $response->assertInvalid(['TomTat']);
    }

}
