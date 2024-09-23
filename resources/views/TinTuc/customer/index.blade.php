@extends('layouts.customer')
@section('link')
<link href="{{ asset('asset/css/tintuc.css') }}" rel="stylesheet" />
@endsection
@section('main')
<!-- BEGIN: Main -->
<main class="bg-color">

    <div class="row">
        <div class="col-md-9">
            <h5 style="margin-bottom: 0px;">SALE KHÔNG NGỪNG, MỪNG "MAD SALE DAY"</h5>
            <h6 class="fontsize-text">Không thể bỏ lỡ Mad Sale Day -Thứ 2 đầu tiên của tháng -Ngày hội hấp dẫn nhất của Galaxy Cinema</h6>
            <h5>💢 ĐỪNG BỎ LỠ - MAD SALE DAY VỚI CÁC ƯU ĐÃI SAU💢"</h5>
            <h6 class="fontsize-text">🎁 Đồng giá 50K/vé đối với 2D ➕ tặng 1 bắp: Áp dụng tại Beta Giải Phóng, Trần Quang Khải.</h6>
            <h6 class="fontsize-text">🎁 Đồng giá 45K/vé đối với 2D ➕ tặng 1 bắp: Áp dụng tại Beta Thanh Xuân, Mỹ Đình, Đan Phượng, Long Khánh, Tân Uyên, Empire Bình Dương (Thủ Dầu Một), Lào Cai.</h6>
            <h6 class="fontsize-text">🎁 Đồng giá 45k/vé (học sinh, sinh viên, trẻ em, người cao tuổi), 50k/vé (người lớn) đối với 2D ➕ tặng 1 bắp: Áp dụng tại Beta Quang Trung.</h6>
            <h6 class="fontsize-text">🎁 Đồng giá 40K/vé đối với 2D ➕ tặng 1 bắp: Áp dụng tại các cụm rạp Beta Thái Nguyên, Thanh Hóa, Bắc Giang, Nha Trang, Biên Hòa.</h6>
            <h6 class="fontsize-text">🎁 Đồng giá 50k/vé (học sinh, sinh viên, trẻ em, người cao tuổi), 60k/vé (người lớn) đối với 2D ➕ tặng 1 bắp: Áp dụng tại Beta Hồ Tràm, TRMall Phú Quốc.</h6><br>
            <h5>⚠️ LƯU Ý:</h5>
            <h6 class="fontsize-text">🔹 Áp dụng cho tất cả khách hàng.</h6>
            <h6 class="fontsize-text">🔹 Áp dụng khi mua vé trực tiếp tại quầy và mua online.</h6>
            <h6 class="fontsize-text">🔹 Không giới hạn suất chiếu và ghế ngồi.</h6>
            <h6 class="fontsize-text">🔹 Áp dụng tại toàn bộ các rạp Beta Cinemas trừ Phú Mỹ, Hồ Tràm.</h6>
            <h6 class="fontsize-text">🔹 Không áp dụng đồng thời với các chương trình khuyến mại khác.</h6>
            <h6 class="fontsize-text">🔹 Không áp dụng nếu trùng vào ngày lễ, Tết và các ngày nghỉ bù theo lịch của Nhà nước.</h6>
            <h6 class="fontsize-text">🔹 Không phụ thu phim bom tấn, ghế VIP, ghế đôi.</h6>

            <h6 class="fontsize-text">🔹 Giá vé giảm Mad Sale Day không áp dụng với các phim có suất chiếu sớm, hoặc giá vé đặc biệt từ nhà phát hành. Với các phim này, vé phim sẽ chỉ được tặng Bắp MIỄN PHÍ</h6>

            <h5>'BOM TẤN' ĐÃ NỔ, CÒN BẠN ĐÃ 'NỔ VÍ' HAY CHƯA?</h5>
        </div>
        @foreach($tintucs as $item)
        <!-- Thêm các card tin tức khác -->
        <div class="col-md-3">
        <div class="card bg">
                <img src="{{$item->Anh}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h6 class="card-title">{{$item->TenSuKien}}</h6>
                </div>
            </div>
        </div>
        @endforeach

</main>

<!-- END: Main -->
@endsection