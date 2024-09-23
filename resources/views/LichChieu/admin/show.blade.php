@extends('layouts.admin')

@section('content')
    <div class="col-8 col-md-10">
        <h3>
            {{-- Thêm đường dẫn qua lại index --}}
            <a href="" class="text-black">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
                    class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                    <path
                        d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
                </svg>
            </a>
            Thông tin voucher
        </h3>
        <form action="" class="d-grid gap-3 w-md-50 mx-auto">
            <div class="d-flex flex-column gap-2">
                <label for="ten-dang-nhap-nv">Tên đăng nhập nhân viên*</label>
                <input type="text" id="ten-dang-nhap-nv" name="ten-dang-nhap-nv"
                    class="py-1 px-2 rounded border border-1" disabled="true">
            </div>
            <div class="row">
                <div class="d-flex flex-column gap-2 col-12 col-sm-6">
                    <label for="ti-le-chiet-khau">Tỉ lệ chiết khẩu*</label>
                    <input type="number" id="ti-le-chiet-khau" name="ti-le-chiet-khau"
                        class="py-1 px-2 rounded border border-1" disabled="true">
                </div>
                <div class="d-flex flex-column gap-2 col-12 col-sm-6">
                    <label for="han-muc">Hạn mức*</label>
                    <input type="number" id="han-muc" name="han-muc" class="py-1 px-2 rounded border border-1"
                        disabled="true">
                </div>
            </div>
            <div class="d-flex flex-column gap-2">
                <label for="tinh-trang">Tình trạng vouvher*</label>
                <select class="form-select form-select-sm" name="tinh-trang" aria-label="Small select example"
                    disabled="true">
                    <option selected>Tình trạng vouvher</option>
                    <option value="binh-thuong">Đã sử dụng</option>
                    <option value="ngung-su-dung">Chưa sử dụng</option>
                    <option value="tam-ngung">Đã xóa</option>
                </select>
            </div>
            <div class="row">
                <div class="d-flex flex-column gap-2 col-12 col-sm-6">
                    <label for="ngay-tao">Ngày tạo*</label>
                    <input type="date" name="ngay-tao" id="ngay-tao" class="py-1 px-2 rounded border border-1"
                        disabled="true">
                </div>
                <div class="d-flex flex-column gap-2 col-12 col-sm-6">
                    <label for="han-dung">Hạn dùng*</label>
                    <input type="date" name="han-dung" id="han-dung" class="py-1 px-2 rounded border border-1"
                        disabled="true">
                </div>
            </div>
        </form>
    </div>
@endsection
