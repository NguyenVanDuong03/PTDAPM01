@extends('layouts.customer')
@section('link')
<link href="{{ asset('asset/css/tintuc.css') }}" rel="stylesheet" />
@endsection

@section('main')
<!-- BEGIN: Main -->
<main class="bg-color">
    <div class="bg-color">
        <div class="row bg">
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
            Thêm các card tin tức khác
            <div class="col-md-3">
                <div class="card bg">
                    <img src="images/5.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h6 class="card-title">SHARK MINH BETA KÝ KẾT NHƯỢNG QUYỀN “RẠP CHIẾU PHIM TRIỆU LIKE”,
                            NÂNG TỔNG SỐ LÊN 19 CỤM RẠP BETA CINEMAS</h6>
                    </div>
                </div>
            </div>
            <!-- Thêm các card tin tức khác -->
            <div class="col-md-3">
                <div class="card bg">
                    <img src="images/4.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h6 class="card-title">SHARK MINH BETA KÝ KẾT NHƯỢNG QUYỀN “RẠP CHIẾU PHIM TRIỆU LIKE”,
                            NÂNG TỔNG SỐ LÊN 19 CỤM RẠP BETA CINEMAS</h6>
                    </div>
                </div>
            </div>
            <!-- Thêm các card tin tức khác -->
            <div class="col-md-3">
                <div class="card bg">
                    <img src="images/5.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h6 class="card-title">SHARK MINH BETA KÝ KẾT NHƯỢNG QUYỀN “RẠP CHIẾU PHIM TRIỆU LIKE”,
                            NÂNG TỔNG SỐ LÊN 19 CỤM RẠP BETA CINEMAS</h6>
                    </div>
                </div>
            </div>
            <!-- Thêm các card tin tức khác -->
            <div class="col-md-3">
                <div class="card bg">
                    <img src="images/4.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h6 class="card-title">SHARK MINH BETA KÝ KẾT NHƯỢNG QUYỀN “RẠP CHIẾU PHIM TRIỆU LIKE”,
                            NÂNG TỔNG SỐ LÊN 19 CỤM RẠP BETA CINEMAS</h6>
                    </div>
                </div>
            </div>
            <!-- Thêm các card tin tức khác -->
            <div class="col-md-3">
                <div class="card bg">
                    <img src="images/5.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h6 class="card-title">SHARK MINH BETA KÝ KẾT NHƯỢNG QUYỀN “RẠP CHIẾU PHIM TRIỆU LIKE”,
                            NÂNG TỔNG SỐ LÊN 19 CỤM RẠP BETA CINEMAS</h6>
                    </div>
                </div>
            </div>
            <!-- Thêm các card tin tức khác -->
            <div class="col-md-3">
                <div class="card bg">
                    <img src="images/5.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h6 class="card-title">SHARK MINH BETA KÝ KẾT NHƯỢNG QUYỀN “RẠP CHIẾU PHIM TRIỆU LIKE”,
                            NÂNG TỔNG SỐ LÊN 19 CỤM RẠP BETA CINEMAS</h6>
                    </div>
                </div>
            </div>

            <!-- Thêm các card tin tức khác -->
        </div>
        <!-- Lặp lại các hàng nếu cần -->
    </div>
</main>

<!-- END: Main -->
@endsection