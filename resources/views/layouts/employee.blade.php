<!DOCTYPE html>
<html lang="en">
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
                <div class="d-grid gap-1">

                    <!-- BEGIN: Link Page -->
                    <ul class="ps-0">
                        <li>
                            <a href="#">LOgo</a>
                        </li>
                        <li class="" id="home">
                            <a href="{{route('employee.home')}}" class="text-black p-2 d-flex w-100">Trang chủ</a>
                        </li>
                        <li class="" id="xuatves">
                            <a href="{{ route('datves.xuatVe') }}" class="text-black p-2 d-flex w-100">Xuất vé</a>
                        </li>
                        
                        <li class="" id="xuatves">
                            <a href="{{ route('quydinhs.index') }}" class="text-black p-2 d-flex w-100">Quy định</a>
                        </li>
                        <li class="" id="xuatves">
                            <a href="{{ route('tintucs.index') }}" class="text-black p-2 d-flex w-100">Tin tức</a>
                        </li>
                        {{--<li class="" id="thongkes">
                            <a href="" id="thong-ke" class="text-black p-2 d-flex w-100">Thống kê</a>
                        </li>--}}
                        
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
                                <form hidden id="FormDangXuat" action="{{ route('logout') }}" method="post">
                                    @csrf
                                </form>
                                <li><button id="ButtonDangXuat" class="dropdown-item" type="submit">Đăng xuất</button>
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
    <script src={{ asset('asset/js/script.js') }}></script>
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