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
                            <a href="{{ route('admin.home') }}" class="text-black p-2 d-flex w-100">Trang chủ</a>
                        </li>
                        <li class="" id="xuatves">
                            <a href="{{ route('datves.xuatVe') }}"
                                class="text-black p-2 d-flex w-100 align-items-center gap-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M23.1429 2.18182H18.8571V0.272727C18.8571 0.122727 18.7607 0 18.6429 0H17.1429C17.025 0 16.9286 0.122727 16.9286 0.272727V2.18182H12.9643V0.272727C12.9643 0.122727 12.8679 0 12.75 0H11.25C11.1321 0 11.0357 0.122727 11.0357 0.272727V2.18182H7.07143V0.272727C7.07143 0.122727 6.975 0 6.85714 0H5.35714C5.23929 0 5.14286 0.122727 5.14286 0.272727V2.18182H0.857143C0.383036 2.18182 0 2.66932 0 3.27273V22.9091C0 23.5125 0.383036 24 0.857143 24H23.1429C23.617 24 24 23.5125 24 22.9091V3.27273C24 2.66932 23.617 2.18182 23.1429 2.18182ZM22.0714 21.5455H1.92857V4.63636H5.14286V6.54545C5.14286 6.69545 5.23929 6.81818 5.35714 6.81818H6.85714C6.975 6.81818 7.07143 6.69545 7.07143 6.54545V4.63636H11.0357V6.54545C11.0357 6.69545 11.1321 6.81818 11.25 6.81818H12.75C12.8679 6.81818 12.9643 6.69545 12.9643 6.54545V4.63636H16.9286V6.54545C16.9286 6.69545 17.025 6.81818 17.1429 6.81818H18.6429C18.7607 6.81818 18.8571 6.69545 18.8571 6.54545V4.63636H22.0714V21.5455ZM9.42857 11.4545H4.5C4.38214 11.4545 4.28571 11.5773 4.28571 11.7273V13.3636C4.28571 13.5136 4.38214 13.6364 4.5 13.6364H9.42857C9.54643 13.6364 9.64286 13.5136 9.64286 13.3636V11.7273C9.64286 11.5773 9.54643 11.4545 9.42857 11.4545ZM9.42857 16.0909H4.5C4.38214 16.0909 4.28571 16.2136 4.28571 16.3636V18C4.28571 18.15 4.38214 18.2727 4.5 18.2727H9.42857C9.54643 18.2727 9.64286 18.15 9.64286 18V16.3636C9.64286 16.2136 9.54643 16.0909 9.42857 16.0909ZM17.6839 10.0432L14.9089 14.942L13.4946 12.45C13.4143 12.3068 13.2857 12.225 13.1491 12.225H11.6786C11.5045 12.225 11.4027 12.4773 11.5045 12.658L14.5607 18.0511C14.6002 18.1208 14.6521 18.1776 14.7122 18.2167C14.7722 18.2559 14.8388 18.2763 14.9062 18.2763C14.9737 18.2763 15.0403 18.2559 15.1003 18.2167C15.1604 18.1776 15.2123 18.1208 15.2518 18.0511L19.6714 10.2545C19.7732 10.0739 19.6714 9.82159 19.4973 9.82159H18.0268C17.8929 9.81818 17.7643 9.90341 17.6839 10.0432Z"
                                        fill="#1A1A1A" />
                                </svg>
                                Xuất vé
                            </a>
                        </li>
                        <li class="" id="xuatves">
                            <a href="{{ route('admin.datVe') }}"
                                class="text-black p-2 d-flex w-100 align-items-center gap-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M23.1429 2.18182H18.8571V0.272727C18.8571 0.122727 18.7607 0 18.6429 0H17.1429C17.025 0 16.9286 0.122727 16.9286 0.272727V2.18182H12.9643V0.272727C12.9643 0.122727 12.8679 0 12.75 0H11.25C11.1321 0 11.0357 0.122727 11.0357 0.272727V2.18182H7.07143V0.272727C7.07143 0.122727 6.975 0 6.85714 0H5.35714C5.23929 0 5.14286 0.122727 5.14286 0.272727V2.18182H0.857143C0.383036 2.18182 0 2.66932 0 3.27273V22.9091C0 23.5125 0.383036 24 0.857143 24H23.1429C23.617 24 24 23.5125 24 22.9091V3.27273C24 2.66932 23.617 2.18182 23.1429 2.18182ZM22.0714 21.5455H1.92857V4.63636H5.14286V6.54545C5.14286 6.69545 5.23929 6.81818 5.35714 6.81818H6.85714C6.975 6.81818 7.07143 6.69545 7.07143 6.54545V4.63636H11.0357V6.54545C11.0357 6.69545 11.1321 6.81818 11.25 6.81818H12.75C12.8679 6.81818 12.9643 6.69545 12.9643 6.54545V4.63636H16.9286V6.54545C16.9286 6.69545 17.025 6.81818 17.1429 6.81818H18.6429C18.7607 6.81818 18.8571 6.69545 18.8571 6.54545V4.63636H22.0714V21.5455ZM9.42857 11.4545H4.5C4.38214 11.4545 4.28571 11.5773 4.28571 11.7273V13.3636C4.28571 13.5136 4.38214 13.6364 4.5 13.6364H9.42857C9.54643 13.6364 9.64286 13.5136 9.64286 13.3636V11.7273C9.64286 11.5773 9.54643 11.4545 9.42857 11.4545ZM9.42857 16.0909H4.5C4.38214 16.0909 4.28571 16.2136 4.28571 16.3636V18C4.28571 18.15 4.38214 18.2727 4.5 18.2727H9.42857C9.54643 18.2727 9.64286 18.15 9.64286 18V16.3636C9.64286 16.2136 9.54643 16.0909 9.42857 16.0909ZM17.6839 10.0432L14.9089 14.942L13.4946 12.45C13.4143 12.3068 13.2857 12.225 13.1491 12.225H11.6786C11.5045 12.225 11.4027 12.4773 11.5045 12.658L14.5607 18.0511C14.6002 18.1208 14.6521 18.1776 14.7122 18.2167C14.7722 18.2559 14.8388 18.2763 14.9062 18.2763C14.9737 18.2763 15.0403 18.2559 15.1003 18.2167C15.1604 18.1776 15.2123 18.1208 15.2518 18.0511L19.6714 10.2545C19.7732 10.0739 19.6714 9.82159 19.4973 9.82159H18.0268C17.8929 9.81818 17.7643 9.90341 17.6839 10.0432Z"
                                        fill="#1A1A1A" />
                                </svg>
                                Đặt vé
                            </a>
                        </li>
                        <li class="" id="thongkes">
                            <a href="{{route('')}}" id="thong-ke"
                                class="text-black p-2 d-flex w-100 align-items-center gap-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_310_13830)">
                                        <path
                                            d="M23.75 21.5455H2.25V0.272727C2.25 0.122727 2.1375 0 2 0H0.25C0.1125 0 0 0.122727 0 0.272727V23.7273C0 23.8773 0.1125 24 0.25 24H23.75C23.8875 24 24 23.8773 24 23.7273V21.8182C24 21.6682 23.8875 21.5455 23.75 21.5455ZM5.55625 16.2852C5.65312 16.3909 5.80938 16.3909 5.90938 16.2852L10.2312 11.5943L14.2188 15.9716C14.3156 16.0773 14.475 16.0773 14.5719 15.9716L23.1781 6.58636C23.275 6.48068 23.275 6.30682 23.1781 6.20114L21.9406 4.85114C21.8936 4.80038 21.8302 4.77191 21.7641 4.77191C21.6979 4.77191 21.6345 4.80038 21.5875 4.85114L14.4 12.6886L10.4187 8.31818C10.3718 8.26743 10.3083 8.23895 10.2422 8.23895C10.1761 8.23895 10.1126 8.26743 10.0656 8.31818L4.32187 14.5466C4.27535 14.5978 4.24925 14.6671 4.24925 14.7392C4.24925 14.8113 4.27535 14.8806 4.32187 14.9318L5.55625 16.2852Z"
                                            fill="#1A1A1A" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_310_13830">
                                            <rect width="24" height="24" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                Thống kê
                            </a>
                        </li>
                        <li class="">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <div class="accordion-header">
                                        <button
                                            class="accordion-button collapsed p-2 d-flex align-items-center gap-2 text-black"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                            aria-expanded="false" aria-controls="flush-collapseOne">

                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_310_13847)">
                                                    <path
                                                        d="M17.6168 5.17431C17.6168 5.05321 17.5019 4.95413 17.3615 4.95413H5.10633C4.96591 4.95413 4.85101 5.05321 4.85101 5.17431V6.49541C4.85101 6.61651 4.96591 6.7156 5.10633 6.7156H17.3615C17.5019 6.7156 17.6168 6.61651 17.6168 6.49541V5.17431ZM17.3615 8.91743H5.10633C4.96591 8.91743 4.85101 9.01651 4.85101 9.13762V10.4587C4.85101 10.5798 4.96591 10.6789 5.10633 10.6789H17.3615C17.5019 10.6789 17.6168 10.5798 17.6168 10.4587V9.13762C17.6168 9.01651 17.5019 8.91743 17.3615 8.91743ZM10.9786 12.8807H5.10633C4.96591 12.8807 4.85101 12.9798 4.85101 13.1009V14.422C4.85101 14.5431 4.96591 14.6422 5.10633 14.6422H10.9786C11.119 14.6422 11.2339 14.5431 11.2339 14.422V13.1009C11.2339 12.9798 11.119 12.8807 10.9786 12.8807ZM9.44671 21.3578H2.29785V1.98165H20.17V11.4495C20.17 11.5706 20.2849 11.6697 20.4253 11.6697H22.2125C22.353 11.6697 22.4678 11.5706 22.4678 11.4495V0.880734C22.4678 0.393578 22.0115 0 21.4466 0H1.02127C0.456378 0 0 0.393578 0 0.880734V22.4587C0 22.9459 0.456378 23.3395 1.02127 23.3395H9.44671C9.58713 23.3395 9.70203 23.2404 9.70203 23.1193V21.578C9.70203 21.4569 9.58713 21.3578 9.44671 21.3578ZM20.8338 19.3101C21.7593 18.5862 22.3402 17.5404 22.3402 16.3761C22.3402 14.1881 20.2817 12.4128 17.7445 12.4128C15.2073 12.4128 13.1488 14.1881 13.1488 16.3761C13.1488 17.5404 13.7296 18.5862 14.6552 19.3101C12.836 20.2046 11.585 21.8615 11.4892 23.7716C11.4829 23.8954 11.6009 24 11.7446 24H13.2796C13.4137 24 13.5254 23.9092 13.535 23.7908C13.6594 21.8862 15.5009 20.367 17.7445 20.367C19.9881 20.367 21.8296 21.8862 21.954 23.7908C21.9604 23.9064 22.0721 24 22.2093 24H23.7444C23.8912 24 24.0061 23.8954 23.9997 23.7716C23.9072 21.8587 22.653 20.2046 20.8338 19.3101ZM17.7445 14.1743C19.1551 14.1743 20.2977 15.1596 20.2977 16.3761C20.2977 17.5927 19.1551 18.578 17.7445 18.578C16.3339 18.578 15.1913 17.5927 15.1913 16.3761C15.1913 15.1596 16.3339 14.1743 17.7445 14.1743Z"
                                                        fill="#1A1A1A" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_310_13847">
                                                        <rect width="24" height="24" fill="white" />
                                                    </clipPath>
                                                </defs>
                                            </svg>

                                            Quản lý
                                        </button>
                                    </div>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <ul class="accordion-body pe-0 pb-0 pt-1">
                                            <li class="" id="nhanviens">
                                                <a href="{{ route('nhanviens.index') }}"
                                                    class="text-black p-2 d-flex w-100">Nhân viên</a>
                                            </li>
                                            <li class="" id="phims">

                                                <a href="{{ route('phims.index') }}"
                                                    class="text-black p-2 d-flex w-100">Phim</a>
                                            </li>
                                            <li class="" id="theloais">
                                                <a href="{{ route('theloais.index') }}"
                                                    class="text-black p-2 d-flex w-100">Thể loại phim</a>

                                            </li>
                                            <li class="" id="doans">
                                                <a href="{{ route('doans.index') }}"
                                                    class="text-black p-2 d-flex w-100">Đồ ăn</a>
                                            </li>
                                            <li class="" id="nhacungcaps">

                                                <a href="{{ route('nhacungcaps.index') }}"
                                                    class="text-black p-2 d-flex w-100">Nhà cung cấp</a>

                                            </li>
                                            <li class="" id="lichchieus">
                                                <a href="{{ route('lichchieus.index') }}"
                                                    class="text-black p-2 d-flex w-100">Lịch chiếu</a>
                                            </li>
                                            <li class="" id="phongchieus">
                                                <a href="{{ route('phongchieus.index') }}"
                                                    class="text-black p-2 d-flex w-100">Phòng chiếu</a>
                                            </li>
                                            <li class="" id="vouchers">

                                                <a href="{{ route('vouchers.index') }}"
                                                    class="text-black p-2 d-flex w-100">Voucher</a>
                                            </li>
                                            <li class="" id="loadoans">
                                                <a href="{{ route('loaidoans.index') }}"
                                                    class="text-black p-2 d-flex w-100">Loại đồ ăn</a>

                                            </li>
                                            <li class="" id="quydinhs">
                                                <a href="{{route('quydinhs.index')}}"
                                                    class="text-black p-2 d-flex w-100 align-items-center gap-2">Quy
                                                    định</a>
                                            </li>
                                            
                                            <li class="" id="tintucs">

                                                <a href="{{ route('tintucs.index') }}"
                                                    class="text-black p-2 d-flex w-100">Tin tức</a>

                                            </li>
                                            <li class="" id="ghengois">
                                                <a href="{{ route('ghengois.index') }}"
                                                    class="text-black p-2 d-flex w-100 align-items-center gap-2">Ghế
                                                    ngồi</a>
                                            </li>
                                            <li class="" id="loaighe">
                                                <a href="{{ route('loaighes.index') }}"
                                                    class="text-black p-2 d-flex w-100 align-items-center gap-2">Loại
                                                    ghế</a>
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
                                {{-- <li><button class="dropdown-item" type="button">Tài Khoản</button></li> --}}
                                <li>
                                    <form hidden action="{{ route('logout') }}" method="post" id="FormDangXuat">
                                        @csrf
                                    </form>
                                    <button id="ButtonDangXuat" class="dropdown-item" type="submit">Đăng
                                        xuất</button>
                                </li>
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
    <script src={{ asset('asset/js/chart.min.js') }}></script>
    <script src={{ asset('asset/js/script.js') }}></script>
    <script src={{ asset('asset/jquery-3.7.1.min.js') }}></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var buttonDangXuat = document.getElementById('ButtonDangXuat');
        var formDangXuat = document.getElementById('FormDangXuat');

        buttonDangXuat.addEventListener('click', function() {
            Swal.fire({
                title: 'Bạn muốn thoát chứ?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Xác nhận',
                cancelButtonText: 'Không'
            }).then((result) => {
                if (result.isConfirmed) {
                    formDangXuat.submit();
                }
            });
        });
    </script>
    @yield('script')
</body>

</html>
