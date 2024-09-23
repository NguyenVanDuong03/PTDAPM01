@extends('layouts.customer')
@section('main')
    <div class="my-4">
        <div style="min-height: auto;">
            <h4 class="text-center text-bold"
                style="background: linear-gradient(90deg, #5b190d 50%, #ea1307 95%);-webkit-background-clip: text;
                -webkit-text-fill-color: transparent;">
                Cảm ơn bạn đã tin tưởng dịch vụ của chúng tôi, yêu bạn rất nhiều!
            </h4>
            <div class="position-relative d-flex justify-content-center">
                <img src="images/pngegg.png" alt="" style="z-index: 2">
                <img src="images/pngegg1.png" alt="" style="max-width:550px; z-index: 1;" class="position-absolute">
            </div>
        </div>
        <h5 class="text-center fw-bold fs-1 mt-3"
            style="background: linear-gradient(90deg, #5b190d 50%, #ea1307 95%);-webkit-background-clip: text;
            -webkit-text-fill-color: transparent;">
            Tổng giá trị đơn hàng:{{ session('TongTienHoaDon') }} </h5>
    </div>
@endsection
