<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
        content="width=device-width, maximum-scale=1.0, initial-scale=1.0, shrink-to-fit=no, user-scalable=no" />
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
                <div class="d-grid gap-1">

                    <!-- BEGIN: Link Page -->
                    <ul class="ps-0">
                        <li>
                            <a href="#">LOgo</a>
                        </li>
                        <li class="" id="home">
                            <a href="" class="text-black p-2 d-flex w-100">Trang chủ</a>
                        </li>
                        <li class="" id="xuatves">
                            <a href="" class="text-black p-2 d-flex w-100">Xuất vé</a>
                        </li>
                        <li class="" id="thongkes">
                            <a href="" id="thong-ke" class="text-black p-2 d-flex w-100">Thống kê</a>
                        </li>
                        <li class="">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <div class="accordion-header">
                                        <button class="accordion-button collapsed p-2" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                            aria-expanded="false" aria-controls="flush-collapseOne">
                                            Quản lý
                                        </button>
                                    </div>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <ul class="accordion-body pe-0 pb-0 pt-1">
                                            <li class="" id="nhanviens">
                                                <a href="" class="text-black p-2 d-flex w-100">Nhân viên</a>
                                            </li>
                                            <li class="" id="phims">
                                                <a href="" class="text-black p-2 d-flex w-100">Phim</a>
                                            </li>
                                            <li class="" id="theloaiphims">
                                                <a href="" class="text-black p-2 d-flex w-100">Thể loại phim</a>
                                            </li>
                                            <li class="" id="doans">
                                                <a href="" class="text-black p-2 d-flex w-100">Đồ ăn</a>
                                            </li>
                                            <li class="" id="nhacungcaps">
                                                <a href="" class="text-black p-2 d-flex w-100">Nhà cung cấp</a>
                                            </li>
                                            <li class="" id="lichchieus">
                                                <a href="" class="text-black p-2 d-flex w-100">Lịch chiếu</a>
                                            </li>
                                            <li class="" id="phongchieus">
                                                <a href="" class="text-black p-2 d-flex w-100">Phòng chiếu</a>
                                            </li>
                                            <li class="" id="vouchers">
                                                <a href="" class="text-black p-2 d-flex w-100">Voucher</a>
                                            </li>
                                            <li class="" id="loadoans">
                                                <a href="" class="text-black p-2 d-flex w-100">Loại đồ ăn</a>
                                            </li>
                                            <li class="" id="quydinhs">
                                                <a href="" class="text-black p-2 d-flex w-100">Quy định</a>
                                            </li>
                                            <li class="" id="lichsugiadoans">
                                                <a href="" class="text-black p-2 d-flex w-100">Lịch sử giá đồ
                                                    ăn</a>
                                            </li>
                                            <li class="" id="tintucs">
                                                <a href="" class="text-black p-2 d-flex w-100">Tin tức</a>
                                            </li>
                                            <li class="" id="ghengois">
                                                <a href="" class="text-black p-2 d-flex w-100">Ghế ngồi</a>
                                            </li>
                                            <li class="" id="loaighe">
                                                <a href="" class="text-black p-2 d-flex w-100">Loại ghế</a>
                                            </li>
                                            <li class="" id="lichsugiaves">
                                                <a href="" class="text-black p-2 d-flex w-100">Lịch sử giá
                                                    vé</a>
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
                            <button
                                class="btn btn-light border dropdown-toggle w-100 d-flex align-items-center justify-content-between"
                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <!-- Name Account -->
                                <img src="{{ url('images/avatauser.png') }}" alt="avata" class="avata-admin">
                                ABC
                            </button>
                            <ul class="dropdown-menu">
                                <li><button class="dropdown-item" type="button">Tài Khoản</button></li>
                                <form action="{{route('logout')}}" method="post">
                                    @csrf
                                    <li><button class="dropdown-item" type="submit">Đăng xuất</button></li>
                                </form>
                            </ul>
                        </div>
                    </div>
                    <!-- END: Account Admin -->

                </div>
            </div>
            <!-- END: Aside -->

            @yield('content')
        </div>

    </div>



    <script src={{ asset('asset/js/vendor.min.js') }}></script>
    <script src={{ asset('asset/js/script.js') }}></script>
    @yield('script')
</body>

</html>
