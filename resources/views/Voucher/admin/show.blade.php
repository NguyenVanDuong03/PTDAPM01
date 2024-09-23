@extends('layouts.admin')

@section('content')
    <div class="col-8 col-md-10">
        <div class="mb-4">
            {{-- Thêm đường dẫn qua lại index --}}
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 12H5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M12 19L5 12L12 5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
        <h3 class="pt-3">
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
