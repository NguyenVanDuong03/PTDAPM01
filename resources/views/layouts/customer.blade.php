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


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    {{--
    <link href="{{ asset('asset/css/vendor.min.css') }}?v=1.0.0" rel="stylesheet" /> --}}
    <link href="{{ asset('asset/css/layout.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset/css/media-screen.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset/css/user-index.css') }}" rel="stylesheet" />
    @yield('link')
</head>

<body>
    <div class="container-fluid padding0">
        <!-- BEGIN: Header -->
        <header>
            <div class="navbar navbar-light bg-light gradient-background">
                <div class="logo">LOGO</div>
                <div class="form-inline search-container">
                    <div class="bg-light rounded rounded-pill shadow-sm">
                        <div class="p-2">
                            <button type="submit" class="btn pe-0"><i class="bi bi-search"></i></button>

                            <input type="text" placeholder="Bạn muốn tìm phim gì?" class="border-0 bg-light px-3 py-2">

                        </div>
                    </div>
                </div>
                <div class="navbar navbar-expand-lg">

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">

                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('customer.home') }}">PHIM <span
                                        class="sr-only">(current)</span></a>
                            </li>
                            {{--<li class="nav-item active">
                                <a class="nav-link" href="#">GIÁ VÉ <span class="sr-only">(current)</span></a>
                            </li>--}}
                            {{-- <li class="nav-item active">
                                <a class="nav-link" href="{{route('doans.index')}}">ĐỒ ĂN<span
                                        class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="#">RẠP<span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="#">LICH CHIẾU<span class="sr-only">(current)</span></a>
                            </li> --}}
                            <li class="nav-item active">

                                <a class="nav-link" href="{{ route('tintucs.index') }}">TIN TỨC VÀ ƯU ĐÃI<span
                                        class="sr-only">(current)</span></a>

                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="{{route('quydinhs.index')}}">QUY ĐỊNH<span
                                        class="sr-only">(current)</span></a>
                            </li>
                        </ul>
                        <div class="navbar navbar-light  justify-content-end">
                            {{-- Nếu đăng nhậop rồi thì hiện cái dưới --}}
                            @if (Auth::check())
                            <div class="btn-group ">
                                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                    <a href="#"><i class="bi bi-person"></i></a>
                                </button>
                                <div class="dropdown-menu">
                                    <form hidden id="FormDangXuat" action="{{ route('logout') }}" method="post">
                                        @csrf
                                    </form>
                                    <button id="ButtonDangXuat" class="dropdown-item" type="submit">Đăng
                                        xuất</button>
                                    <a class="dropdown-item" href="{{route('khachhangs.show')}}">Thông tin cá nhân</a>
                                </div>

                            </div>
                            @else
                            <div class="btn-group">
                                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                    <a href="#"><i class="bi bi-box-arrow-in-left"></i></a>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('login') }}">Đăng Nhập</a>
                                    <a class="dropdown-item" href="{{ route('register') }}">Đăng Ký</a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
            @yield('baner')
        </header>
        <!-- END: Header -->

        @yield('main')

        <footer>
            <footer>
                <div class="footer-container row">
                    <div class="col-6">
                        <div class="address">
                            <span> Rạp phim A cinema</span><br>
                            <span> Đại diện: Cù Việt Dũng</span><br>
                            <span> Địa chỉ: Tòa A45, 175 Tây Sơn, Đống Đa, Hà Nội</span><br>
                            <span> Số điện thoại: 0848686868</span><br>
                            <span> Email: CVZ@gmail.com</span><br>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="customer-care">
                            <strong> Chăm sóc khách hàng</strong><br>
                            <span> Hotline: 0848686868</span><br>
                            <span> Giờ làm việc: 08:00 - 23:59</span><br>
                            <span> (Tất cả các ngày trong tuần kể cả ngày Lễ Tết)</span><br>
                            <span> Email hỗ trợ: hoidap@GC.vn</span><br>
                        </div>
                    </div>
                </div>
            </footer>

        </footer>
        <!-- END: Footer -->


    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <script src="js/script.js"></script>
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
    @yield('js')
</body>

</html>