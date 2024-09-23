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

        <div class="w-50 m-auto border border-black p-5 rounded" style="transform: translateY(50%)">
            <div class="d-flex gap-2 align-items-center mb-3">
                {{-- Thêm link quay lại trang nhập thông tin email --}}
                <a href="">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 12H5" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M12 19L5 12L12 5" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </a>
                <h1 class="mb-0 fs-4">Nhập mã OTP</h1>
            </div>
            {{--<div class=" d-flex justify-content-around mb-3">
                <input type="text" class="otp-input text-center py-2" style="width: 50px" maxlength="1"
                    minlength="1" oninput="moveToNextInput(this)">
                <input type="text" class="otp-input text-center py-2" style="width: 50px" maxlength="1"
                    minlength="1" oninput="moveToNextInput(this)">
                <input type="text" class="otp-input text-center py-2" style="width: 50px" maxlength="1"
                    minlength="1" oninput="moveToNextInput(this)">
                <input type="text" class="otp-input text-center py-2" style="width: 50px" maxlength="1"
                    minlength="1" oninput="moveToNextInput(this)">
            </div>--}}
            <form action="{{route('qmk.nhapMatKhauMoi')}}" method="post">
                @csrf
                <input type="text" class="otp-input text-center py-2" name="OTP">
                <button type="submit" class="btn btn-primary float-end">Xác minh</button>
            </form>
        </div>
    </div>
    <script src={{ asset('asset/js/vendor.min.js') }}></script>
    <script src={{ asset('asset/js/script.js') }}></script>
    <script>
        function moveToNextInput(input) {
            var value = input.value.trim();
            if (value.length === 1) {
                var nextInput = input.nextElementSibling;
                if (nextInput !== null) {
                    nextInput.focus();
                } else {
                    input.blur();
                }
            }
        }
    </script>
</body>

</html>
