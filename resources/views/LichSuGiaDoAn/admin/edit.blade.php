<!DOCTYPE html>
<html lang="en">

<<<<<<< HEAD
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, maximum-scale=1.0, initial-scale=1.0, shrink-to-fit=no, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="format-detection" content="telephone=no" />
    <base href="" />
    <meta name="google-site-verification" content="" />
    <title>Phim</title>

    <link href="{{ asset('asset/css/vendor.min.css') }}?v=1.0.0" rel="stylesheet" />
    <link href="{{ asset('asset/css/layout.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset/css/media-screen.css') }}" rel="stylesheet" />
</head>

<body>
    <div class="container-fluid padding0">
        <div class="row px-3 px-md-4 pt-4">

            <!-- BEGIN: Aside -->
            <div class="col-4 col-md-2 ps-0 container-fluid border-end">
                <div class="aside-admin">

                    <!-- BEGIN: Link Page -->
                    <ul class="ps-0">
                        <li>
                            <a href="#">LOgo</a>
                        </li>
                        <li class="">
                            <a href="" class="text-black p-2 d-flex w-100">Trang chủ</a>
                        </li>
                        <li class="">
                            <a href="" class="text-black p-2 d-flex w-100">Xuất vé</a>
                        </li>
                        <li class="">
                            <a href="" class="text-black p-2 d-flex w-100">Thống kê</a>
                        </li>
                        <li class="">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <div class="accordion-header">
                                        <button class="accordion-button collapsed p-2" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                            Quản lý
                                        </button>
                                    </div>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                        <ul class="accordion-body pe-0">
                                            <li class="">
                                                <a href="" class="text-black p-2 d-flex w-100">Nhân viên</a>
                                            </li>
                                            <li class="">
                                                <a href="" class="text-black p-2 d-flex w-100">Phim</a>
                                            </li>
                                            <li class="active-admin-aside">
                                                <a href="" class="text-black p-2 d-flex w-100">Đồ ăn</a>
                                            </li>
                                            <li class="">
                                                <a href="" class="text-black p-2 d-flex w-100">Lịch chiếu</a>
                                            </li>
                                            <li class="">
                                                <a href="" class="text-black p-2 d-flex w-100">Phòng chiếu</a>
                                            </li>
                                            <li class="">
                                                <a href="" class="text-black p-2 d-flex w-100">Voucher</a>
                                            </li>
                                            <li class="">
                                                <a href="" class="text-black p-2 d-flex w-100">Bán đồ ăn</a>
                                            </li>
                                            <li class="">
                                                <a href="" class="text-black p-2 d-flex w-100">Quy định</a>
                                            </li>
                                            <li class="">
                                                <a href="" class="text-black p-2 d-flex w-100">Bán vé</a>
                                            </li>
                                            <li class="">
                                                <a href="" class="text-black p-2 d-flex w-100">Tin tức</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <!-- END: Link Page -->


                    <!-- BEGIN: Account Admin -->
                    <div class="d-flex justify-content-center">
                        <div class="dropdown w-lg-75">
                            <button class="btn btn-light border dropdown-toggle w-100 d-flex align-items-center justify-content-between" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <!-- Name Account -->
                                <img src="{{ url('images/avatauser.png') }}" alt="avata" class="avata-admin">
                                ABC
                            </button>
                            <ul class="dropdown-menu">
                                <li><button class="dropdown-item" type="button">Tài Khoản</button></li>
                                <li><button class="dropdown-item" type="button">Đăng xuất</button></li>
                            </ul>
                        </div>
                    </div>
                    <!-- END: Account Admin -->

                </div>
            </div>
            <!-- END: Aside -->

            <!-- BEGIN: Form -->
            <div class="col-8 col-md-10">
                <h3>Sửa thông tin giá đồ ăn</h3>
                <form method="POST" action="{{route('lichsugiadoans.update', ['lichsugiadoan'=>$lichsugiadoan->MaGiaDoAn])}}" class="d-grid gap-3 w-md-50 mx-auto">
                    <div class="flex-column d-flex gap-2">
                        @csrf
                        @method('PUT')
                        <label for="ma-do-an">Tên đồ ăn*</label>
                        <select class="form-select form-select-sm" aria-label="Small select example" id="ma-do-an" name="MaDoAn">
                            @foreach($doans as $item)
                            <option value="{{$item->MaDoAn}}" {{ $item->MaDoAn == $lichsugiadoan->MaDoAn ? 'selected' : '' }}>{{$item->TenDoAn}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-column d-flex gap-2">
                        <label for="ThoiGianTao">Thời gian tạo*</label>
                        <input value="{{$lichsugiadoan->ThoiGianTao}}" type="datetime-local" id="thoi-gian" name="ThoiGianTao" class="px-2 py-1">
                        @error('ThoiGianTao')
                        <div class="text-danger fw-bold">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="flex-column d-flex gap-2">
                        <label for="Gia">Gia*</label>
                        <input value="{{$lichsugiadoan->Gia}}" type="text" id="gia" name="Gia" class="px-2 py-1">
                        @error('Gia')
                        <div class="text-danger fw-bold">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="py-2 rounded text-center mt-5" style="background-color: #5F6D7E">
                        <button type="submit " class="border-0 bg-transparent  text-white">
                            Sửa thông tin giá đồ ăn
                        </button>
                    </div>
                </form>
            </div>
            <!-- END: Form -->
        </div>

=======
@section('content')
    <!-- BEGIN: Form -->
    <div class="col-8 col-md-10">
        <div class="mb-4">
            {{-- Thêm đường dẫn qua lại index --}}
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 12H5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M12 19L5 12L12 5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
        <h3 class="pt-3">
            Sửa thông tin giá đồ ăn
        </h3>
        <form action="" class="d-grid gap-3 w-md-50 mx-auto">
            <div class="flex-column d-flex gap-2">
                <label for="ma-do-an">Tên đồ ăn*</label>
                <select class="form-select form-select-sm" aria-label="Small select example" id="ma-do-an" name="ma-do-an">
                    <option selected>Tên đồ ăn</option>
                    <option value="1">One</option>
                </select>
            </div>
            <div class="flex-column d-flex gap-2">
                <label for="thoi-gian">Thời gian tạo*</label>
                <input type="datetime" id="thoi-gian" name="thoi-gian" disabled="true" class="px-2 py-1">
            </div>
            <div class="flex-column d-flex gap-2">
                <label for="gia">Gia*</label>
                <input type="text" id="gia" name="gia" class="px-2 py-1" oninput="formatNumber(event)">
            </div>
            <div class="rounded text-center my-5" style="background-color: #5F6D7E">
                <button type="submit " class="border-0 bg-transparent py-2 w-100 text-white">
                    Sửa thông tin giá đồ ăn
                </button>
            </div>
        </form>
>>>>>>> origin/FE-Admin
    </div>



    <script src={{ asset('asset/js/vendor.min.js') }}></script>
    <script src={{ asset('asset/js/script.js') }}></script>
    <script>
        function layNgayThangNamHienTai() {
            const ngayThangNam = new Date().toLocaleDateString(
                'vi-VN');
            return ngayThangNam;
        }
        document.getElementById('thoi-gian').value = layNgayThangNamHienTai();

        function formatNumber(event) {
            const input = event.target;
            const value = input.value.replace(/\D/g, '');

            const formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

            input.value = formattedValue;
        }
    </script>
<<<<<<< HEAD
</body>

</html>
=======
@endsection
>>>>>>> origin/FE-Admin
