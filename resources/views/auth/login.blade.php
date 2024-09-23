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
    <title>Login</title>

    <link href="{{ asset('asset/css/vendor.min.css') }}?v=1.0.0" rel="stylesheet" />
    <link href="{{ asset('asset/css/layout.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset/css/media-screen.css') }}" rel="stylesheet" />
</head>

<body>
    <div class="container-fluid padding0">

        <div class="position-relative">

            <!-- Image BackGroud -->

            <img class="w-100 opacity-50 img-bg" src="{{ url('images/img-backgroud-login.png') }}" alt="">

            <!-- Form -->

            <div class="position-absolute form-login d-flex">

                <!-- Image Form -->

                <img class="w-50 d-none d-md-block" src="{{ url('images/image-login.png') }}" alt="">
                <div id="carouselExampleDark"
                    class="carousel carousel-dark slide w-100 w-md-50 d-flex align-items-center">
                    <div class="carousel-indicators group-btn-change">

                        <!-- Tab Login -->
                        <div class="d-flex flex-column justify-content-between">
                            <label for="form-login"
                                class="align-items-center justify-content-center d-flex fw-bold fs-3 fs-md-2">Đăng
                                nhập</label>
                            <input type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0"
                                class="{{session('register_fail') ? '' : 'active' }}" aria-current=" true" aria-label="Slide 1" name="form-login"
                                id="form-login" value="form-login">
                            </input>
                        </div>
                        <!-- Tab Register -->

                        <div class="d-flex flex-column">
                            <label for="form-register"
                                class="mb-3 ms-2 ms-md-3 align-items-center justify-content-center d-flex fw-bold fs-3 fs-md-2">Đăng
                                ký</label>
                            <input type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                                class="{{session('register_fail') ? 'active' : '' }}" aria-label="Slide 2" name="form-register" id="form-register"
                                value="slide-last"></input>
                        </div>
                    </div>
                    <div class="carousel-inner w-100 mx-3 w-md-75 mx-md-auto margin-top-form">

                        <!-- Form Login -->

                        <div class="carousel-item {{session('register_fail') ? '' : 'active' }}" data-bs-interval="10000">
                            <!-- <h3 class="text-center">Đăng nhập</h3> -->

                            <!-- Form -->

                            <form method="post" action="{{route('authenticate')}}" class="d-flex flex-column gap-4 form-input ">
                                @csrf
                                <input type="text" name="email" id="email" value="{{old('email')}}"
                                    placeholder="Nhập email của bạn" class="rounded-4">
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                <input  value="{{old('password')}}" type="password" name="password" id="password" placeholder="Mật khẩu của bạn"
                                    class="rounded-4">
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                <button type="submit" class="rounded-4">Đăng nhập</button>
                            </form>

                            <!-- Save Password -->

                            <div class="d-flex mt-5 justify-content-between">
                            {{--<div class="d-flex align-items-center gap-1">

                                    <!-- Change information account in value -->

                                    <input type="checkbox" id="note-password" name="note-password" value="password"
                                        class="cursor-pointer">
                                    <label for="note-password" class="cursor-pointer">
                                        Ghi nhớ mật khẩu
                                    </label>
                                </div>--}}
                                <div class="">
                                    <a href="{{route('qmk.nhapEmail')}}" class="text-black">Quên mật khẩu?</a>
                                </div>
                            </div>

                            <!-- More Information -->
                           {{-- <div class="d-flex gap-3 align-items-center space_article">
                                <hr class=" w-50">
                                <span class="d-flex fs-3 fw-bold">Hoặc</span>
                                <hr class=" w-50">
                            </div>--}}

                            <!-- <div class="d-flex justify-content-center gap-5 space_article">
                                <a href="#">
                                    <img src="{{ url('images/image-facebook.png') }}" alt="">
                                </a>
                                <a href="#">
                                    <img src="{{ url('images/image-google.png') }}" alt="">
                                </a>
                            </div> -->
                        </div>

                        <!-- Form Registor -->

                        <div class="carousel-item {{ session('register_fail') ? 'active' : '' }}" data-bs-interval="2000">
                            <!-- <h3 class="text-center">Đăng ký</h3> -->

                            <!-- Form -->

                            <form method="post" action="store" class="d-flex flex-column gap-3 gap-xl-4 form-input space-bottom">
                                @csrf
                                <input type="text" name="TenKhachHang" id="TenKhachHang" placeholder="Họ tên của bạn"
                                    class="rounded-4" value="{{old('TenKhachHang')}}">
                                    @if ($errors->has('TenKhachHang'))
                                        <span class="text-danger">{{ $errors->first('TenKhachHang') }}</span>
                                    @endif
                                <input type="" name="email" id="email"
                                    placeholder="Email của bạn" class="rounded-4"  value="{{old('email')}}">
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                <div class="d-flex gap-3 ms-1">
                                    <h5 class="d-flex align-items-center mb-0">Giới tính</h5>
                                    <div class="d-flex gap-3 align-items-center">
                                        <label for="boy">Nam</label>
                                        <input checked type="checkbox" id="boy" name="GioiTinh" value="Nam">
                                    </div>
                                    <div class="d-flex gap-3 align-items-center">
                                        <label for="girl">Nữ</label>
                                        <input type="checkbox" id="girl" name="GioiTinh" value="Nữ">
                                    </div>
                                    <div class="d-flex gap-3 align-items-center">
                                        <label for="other">Khác</label>
                                        <input type="checkbox" id="other" name="GioiTinh" value="Giới tính khác">
                                    </div>
                                </div>
                                <div class="d-flex gap-3 ms-1">
                                    <h5 class="d-flex align-items-center mb-0">Ngày sinh</h5>
                                    <input type="date" name="NgaySinh"  value="{{old('NgaySinh')}}">
                                    @if ($errors->has('NgaySinh'))
                                        <span class="text-danger">{{ $errors->first('NgaySinh') }}</span>
                                    @endif
                                </div>
                                <input type="password" name="password" id="password"
                                    placeholder="Mật khẩu của bạn" class="rounded-4">
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    placeholder="Nhập lại mật khẩu của bạn" class="rounded-4">
                                <span id="message" style="display:none; color:red;">Mật khẩu không khớp</span>
                                <button type="submit" class="rounded-4 space_article">Đăng ký</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(session()->has('register_fail'))
            {{ session()->forget('register_fail') }}
        @endif
    </div>
    <script src={{ asset('asset/js/vendor.min.js') }}></script>
    <script src={{ asset('asset/js/script.js') }}></script>
    <script>
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    checkboxes.forEach(cb => {
                        if (cb !== this) {
                            cb.checked = false;
                        }
                    });
                }
            });
        });
        document.getElementById('mat-khau-kiem-tra').addEventListener('input', function() {
            var matKhauMoi = document.getElementById('mat-khau-moi').value;
            var matKhauKiemTra = this.value;
            var message = document.getElementById('message');
            if (matKhauMoi !== matKhauKiemTra) {
                message.style.display = 'block';
            } else {
                message.style.display = 'none';
            }
        });
    </script>
</body>

</html>
