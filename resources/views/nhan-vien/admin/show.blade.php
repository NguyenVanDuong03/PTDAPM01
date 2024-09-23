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
            Thêm nhân viên
        </h3>
        <form action="" class="d-grid gap-3 w-md-50 mx-auto">
            <div class="d-flex flex-column gap-2">
                <label for="ten-dang-nhap-nv">Tên đăng nhập nhân viên*</label>
                <input type="text" id="ten-dang-nhap-nv" name="ten-dang-nhap-nv"
                    placeholder="Nhập tên đăng nhập của nhân viên" class="py-1 px-2 rounded border border-1"
                    disabled="true">
            </div>
            <div class="d-flex flex-column gap-2">
                <label for="ten-nv">Tên nhân viên*</label>
                <input type="text" id="ten-nv" name="ten-nv" placeholder="Nhập họ tên của nhân viên"
                    class="py-1 px-2 rounded border border-1" disabled="true">
            </div>
            <div class="row">
                <div class="d-flex flex-column gap-2 col-12 col-sm-6">
                    <label for="ngay-sinh">Ngày sinh*</label>
                    <input type="date" id="ngay-sinh" name="ngay-sinh" class="py-1 px-2 rounded border border-1"
                        disabled="true">
                </div>
                <div class="d-flex flex-column gap-2 col-12 col-sm-6">
                    <label for="gioi-tinh">Giới tính*</label>
                    <select class="form-select form-select-sm" name="gioi-tinh" aria-label="Small select example"
                        disabled="true">
                        <option selected>Giới tính</option>
                        <option value="1">Nam</option>
                        <option value="0">Nữ</option>
                        <option value="-1">Khác</option>
                    </select>
                </div>
            </div>
            <div class="d-flex flex-column gap-2">
                <label for="dia-chi">Địa chỉ*</label>
                <input type="text" id="dia-chi" name="dia-chi" class="py-1 px-2 rounded border border-1"
                    disabled="true">
            </div>
            <div class="row">
                <div class="d-flex flex-column gap-2 col-12 col-sm-6">
                    <label for="ngay-vao-lam">Ngày vào làm*</label>
                    <input type="date" id="ngay-vao-lam" name="ngay-vao-lam" class="py-1 px-2 rounded border border-1"
                        disabled="true">
                </div>
                <div class="d-flex flex-column gap-2 col-12 col-sm-6">
                    <label for="ngay-ra">Ngày ra</label>
                    <input type="date" id="ngay-ra" name="ngay-ra" class="py-1 px-2 rounded border border-1"
                        disabled="true">
                </div>
            </div>
            <div class="d-flex flex-column gap-2">
                <label for="vi-tri-lam-viec">Chức vụ*</label>
                <select class="form-select form-select-sm" name="vi-tri-lam-viec" aria-label="Small select example"
                    disabled="true">
                    <option selected>Chức vụ</option>
                    <option value="1">Quản lý</option>
                    <option value="0">Nhân viên</option>
                </select>
            </div>
            <div class="d-flex flex-column gap-2">
                <label for="so-dien-thoai">Số điện thoại*</label>
                <input type="tel" id="so-dien-thoai" name="so-dien-thoai" class="py-1 px-2 rounded border border-1"
                    disabled="true">
            </div>
            <div class="d-flex flex-column gap-2">
                <label for="email">Email*</label>
                <input type="email" id="email" name="email" class="py-1 px-2 rounded border border-1"
                    disabled="true">
            </div>

        </form>
    </div>
@endsection
