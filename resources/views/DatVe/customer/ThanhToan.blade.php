@extends('layouts.customer')
@section('link')
    <link href="{{ asset('asset/css/vendor.min.css') }}?v=1.0.0" rel="stylesheet" />
    <link href="{{ asset('asset/css/doan.css') }}?v=1.0.0" rel="stylesheet" />
@endsection

@section('main')
    <main class="bg-color p-2 pt-3 d-flex flex-column justify-content-between">
        <div class="content">
            <div class="title text-center">
                <h3 class="text-success fw-bold">Sự Hài Lòng Của Các Bạn Là Sự Thành Công Của Chúng Tôi</h3>
            </div>
            <div class="w-75 m-auto mt-4">
                <h4>Nhập voucher nếu có</h4>
                <form action="{{ route('datves.thanhToanOnline') }}" method="post" class="mt-2" id="formVoucher">
                    @csrf
                    <div>
                        <input type="text" id="voucher" name="MaVoucher" class="form-control"
                            style="max-width: 200px;">
                        @error('MaVoucher')
                            <div class="text-danger fw-bold">{{ $message }}</div>
                        @enderror
                    </div>

                </form>
            </div>
            <div class="w-75 m-auto mt-4">
                <h4>Chọn phương thức thanh toán</h4>
                <div class="p-2 border border-dark rounded-2">
                    <div class="d-flex gap-3 align-items-center">
                        <input checked type="radio" name="ThanhToan" id="atm" class="fs-3">
                        <label for="atm" class="d-flex gap-2 align-items-center fs-3">
                            <img src="{{ url('images/vnpaylogo.png') }}" alt="atm" style="max-width: 76px">
                            Cổng thanh toán điện tử VN Pay
                        </label>
                    </div>
                    {{-- <div class="d-flex gap-3 align-items-center">
                        <input type="radio" name="ThanhToan" id="visa" class="fs-3">
                        <label for="visa" class="d-flex gap-2 align-items-center fs-3">
                            <img src="{{ url('images/visa.png') }}" alt="visa" style="max-width: 76px">
                            Thẻ quốc tế (Visa, Master, ....)
                        </label>
                    </div>
                    <div class="d-flex gap-3 align-items-center">
                        <input type="radio" name="ThanhToan" id="momo" class="fs-3">
                        <label for="momo" class="d-flex gap-2 align-items-center fs-3">
                            <img src="{{ url('images/momo.png') }}" alt="momo" style="max-width: 76px">
                            MoMo
                        </label>
                    </div>
                    <div class="d-flex gap-3 align-items-center">
                        <input type="radio" name="ThanhToan" id="zalopay" class="fs-3">
                        <label for="zalopay" class="d-flex gap-2 align-items-center fs-3">
                            <img src="{{ url('images/zalopay.png') }}" alt="zalopay" style="max-width: 76px">
                            ZaloPay
                        </label>
                    </div>
                    <div class="d-flex gap-3 align-items-center">
                        <input type="radio" name="ThanhToan" id="vnpay" class="fs-3">
                        <label for="vnpay" class="d-flex gap-2 align-items-center fs-3">
                            <img src="{{ url('images/vnpay.png') }}" alt="vnpay" style="max-width: 76px">
                            VNPAY
                        </label>
                    </div> --}}
                </div>
            </div>
        </div>
        {{-- BEGIN --}}
        <div class="d-flex gap-2 align-items-center justify-content-between mt-5 text-white px-3 py-2"
            style="background-color: #525252">
            <div class="">
                <a href="" class="d-flex flex-column gap-2 text-center">
                    <svg width="56" height="56" viewBox="0 0 56 56" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M28 0C12.5375 0 0 12.5375 0 28C0 43.4625 12.5375 56 28 56C43.4625 56 56 43.4625 56 28C56 12.5375 43.4625 0 28 0ZM34.5 19.8062C34.5 20.4437 34.1937 21.05 33.675 21.425L24.5875 28L33.675 34.575C34.1937 34.95 34.5 35.55 34.5 36.1937V39.125C34.5 39.5312 34.0375 39.7687 33.7062 39.5312L18.3312 28.4062C18.2674 28.3602 18.2153 28.2997 18.1794 28.2296C18.1436 28.1595 18.1248 28.0819 18.1248 28.0031C18.1248 27.9244 18.1436 27.8468 18.1794 27.7767C18.2153 27.7066 18.2674 27.646 18.3312 27.6L33.7062 16.475C33.781 16.4208 33.8693 16.3883 33.9613 16.3811C34.0534 16.374 34.1456 16.3925 34.2278 16.4345C34.31 16.4766 34.3789 16.5406 34.427 16.6194C34.475 16.6983 34.5003 16.7889 34.5 16.8813V19.8062Z"
                            fill="white" />
                    </svg>
                    <span class="fw-medium fs-5 text-white">BACK</span>
                </a>
            </div>
            <div class=" d-flex gap-3">
                <img src="images/anh.png" style="" alt="" class="rounded">
                <div class="d-flex align-items-center">
                    <h4 class ="d-flex flex-column gap-2">
                        Tên phim: {{ session('TenPhim') }}
                        <span>
                            Thời lượng: {{ session('ThoiLuong') }} Phút
                        </span>
                    </h4>
                </div>
            </div>
            <div class="">
                <h4>
                    Xuất chiếu: {{ session('GioChieu') }}
                    <br>
                    Ngày chiếu: {{ session('NgayChieu') }}
                    <br>
                    Phòng chiếu: Phòng {{ session('MaPhong') }}
                </h4>
            </div>
            <div class=>
                <h4>
                    <span class="d-flex gap-4">
                        Đồ ăn:
                        <span>{{ session('TienDoAn') }} VNĐ</span>
                    </span>
                    <span class="d-flex gap-4">
                        Đặt vé:
                        <span>
                            {{ session('TongGiaVe') }} VNĐ
                        </span>
                    </span>
                    <span class="d-flex gap-4">
                        Tổng tiền:
                        <span> {{ session('TongTienHoaDon') }} VNĐ</span>
                    </span>
                </h4>
            </div>
            <div class="">
                <button type="submit" id="btn_submit" class="d-flex flex-column gap-2 text-center">
                    <svg width="56" height="56" viewBox="0 0 56 56" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M28 56C43.4625 56 56 43.4625 56 28C56 12.5375 43.4625 0 28 0C12.5375 0 0 12.5375 0 28C0 43.4625 12.5375 56 28 56ZM21.5 36.1938C21.5 35.5562 21.8063 34.95 22.325 34.575L31.4125 28L22.325 21.425C21.8063 21.05 21.5 20.45 21.5 19.8063V16.875C21.5 16.4688 21.9625 16.2313 22.2938 16.4688L37.6688 27.5938C37.7326 27.6398 37.7847 27.7003 37.8206 27.7704C37.8564 27.8405 37.8752 27.9181 37.8752 27.9969C37.8752 28.0756 37.8564 28.1532 37.8206 28.2233C37.7847 28.2934 37.7326 28.354 37.6688 28.4L22.2938 39.525C22.219 39.5792 22.1307 39.6117 22.0387 39.6189C21.9466 39.626 21.8544 39.6075 21.7722 39.5655C21.69 39.5234 21.6211 39.4594 21.573 39.3806C21.525 39.3017 21.4997 39.2111 21.5 39.1187V36.1938Z"
                            fill="white" />
                    </svg>
                    <span class="fw-medium fs-5 text-white">Tiếp theo</span>
                </button>
            </div>
        </div>
        {{-- END --}}
    </main>
@endsection


@section('js')
    <script>
         $(document).ready(function() {

            const voucherTrue = 'DUONG';

            function voucher() {
                const voucher = $('#voucher');
                let voucherValue = voucher.val();
                voucher.parent().find('.text-danger').remove();

                // Kiểm tra nếu voucher không đúng với voucherTrue
                if (voucherValue !== voucherTrue) {
                    voucher.parent().append('<span class="text-danger fw-bold">Mã voucher không hợp lệ</span>');
                    return false;
                }

                // Kiểm tra voucher chỉ chứa chữ cái và số
                if (!/^[a-zA-Z0-9]+$/.test(voucherValue)) {
                    voucher.parent().append(
                        '<span class="text-danger fw-bold">Mã voucher chỉ được chứa chữ cái và số</span>');
                    return false;
                }

                // Kiểm tra độ dài của mã voucher
                if (voucherValue.length > 12) {
                    voucher.parent().append(
                        '<span class="text-danger fw-bold">Mã voucher không được vượt quá 12 ký tự</span>');
                    return false;
                }

                // Nếu tất cả đều hợp lệ, trả về true
                return true;
            }

            $('#formVoucher').submit(function(e) {
                e.preventDefault();
                let isVaild = true;

                if (!voucher()) {
                    isVaild = false;
                }

                if (isVaild) {
                    console.log("Form is valid, submitting");
                    $('#formVoucher').off('submit').submit();
                } else {
                    console.log("Form is invalid");
                }
            });
        });



        // function submitForm() {
        //     document.getElementById('formVoucher').submit();
        // }
        // document.querySelectorAll('input[name="ThanhToan"]').forEach(function(radio) {
        //     radio.addEventListener('change', function() {
        //         document.querySelectorAll('input[name="ThanhToan"]').forEach(function(otherRadio) {
        //             if (otherRadio !== radio) {
        //                 const otherPaymentMethodInfo = document.getElementById(
        //                     `${otherRadio.id}Info`);
        //                 otherPaymentMethodInfo.style.display = 'none';
        //             }
        //         });

        //     });
        // });
    </script>
@endsection
