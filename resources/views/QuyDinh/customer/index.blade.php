@extends('layouts.customer')
@section('link')
<link href="{{ asset('asset/css/tintuc.css') }}" rel="stylesheet" />
@endsection
@section('main')
<!-- BEGIN: Main -->
<main class="bg-color">
    <div class="row">
        <div class="col-md-9">
            <title>Quy định của rạp chiếu phim</title>

            <body>
                <h1>Quy định của rạp chiếu phim</h1>

                <h2>1. Thời gian mở cửa và đóng cửa</h2>
                <p>Rạp chiếu phim mở cửa từ <span class="highlight">8:00</span> sáng đến <span
                        class="highlight">10:00</span> tối mỗi ngày.</p>

                <h2>2. Quy định về vé</h2>
                <ul>
                    <li>Vé chỉ áp dụng cho suất chiếu và ghế ngồi được chỉ định.</li>
                    <li>Không được chuyển nhượng vé cho người khác.</li>
                    <li>Không hoàn trả vé sau khi đã mua.</li>
                    <li>Trẻ em dưới 12 tuổi phải có người lớn đi cùng.</li>
                </ul>

                <h2>3. Quy định về ăn uống và đồ uống</h2>
                <p>Không được mang thức ăn hoặc đồ uống từ ngoài vào rạp chiếu phim.</p>
                <p>Rạp có các dịch vụ ăn uống và đồ uống phục vụ tại chỗ.</p>

                <h2>4. Quy định về hành vi</h2>
                <p>Yêu cầu khách hàng giữ gìn vệ sinh, trật tự, không gây ồn ào trong suốt thời gian ở trong rạp chiếu
                    phim.</p>
                <p>Không được sử dụng điện thoại di động hoặc thiết bị phát âm thanh trong suốt buổi chiếu.</p>

                <h2>5. Quy định về an ninh</h2>
                <p>Không mang vũ khí hoặc các vật dụng nguy hiểm vào rạp chiếu phim.</p>
                <p>Khách hàng phải tuân thủ hướng dẫn của nhân viên bảo vệ.</p>

                <h2>6. Quy định về phản ánh và khiếu nại</h2>
                <p>Khách hàng có quyền phản ánh và khiếu nại với quản lý rạp chiếu phim về các vấn đề liên quan đến dịch
                    vụ và trải nghiệm của mình.</p>
            </body>
</main>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }

    h1 {
        text-align: center;
        color: #333;
    }

    h2 {
        color: #333;
    }

    p {
        margin-bottom: 10px;
    }

    ul {
        margin-bottom: 10px;
    }

    li {
        margin-left: 20px;
    }

    .highlight {
        background-color: #f2f2f2;
        padding: 5px;
        border-radius: 5px;
    }
</style>
<!-- END: Main -->
@endsection