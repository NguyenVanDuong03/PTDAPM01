@extends('layouts.admin')

@section('content')
    <div class="col-8 col-md-10">
        <h3>
            {{-- Thêm đường dẫn qua lại index --}}
            <a href="{{route('nhanviens.index')}}" class="text-black">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
                    class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                    <path
                        d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
                </svg>
            </a>
            Sửa nhân viên
        </h3>
        <form method="post" action="{{route('nhanviens.update', $nhanvien->id)}}" class="d-grid gap-3 w-md-50 mx-auto">
            @csrf
            @method('PUT')
            <div class="d-flex flex-column gap-2">
                <label for="email">Tên đăng nhập nhân viên*</label>
                <input type="text" id="email" name="email" value="{{$nhanvien->TenDangNhapNV}}"
                    placeholder="Nhập email của nhân viên" class="py-1 px-2 rounded border border-1">
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
            <div class="d-flex flex-column gap-2">
                <label for="ten-nv">Tên nhân viên*</label>
                <input type="text" id="ten-nv" name="TenNhanVien" placeholder="Nhập họ tên của nhân viên"
                    class="py-1 px-2 rounded border border-1"  value="{{$nhanvien->TenNhanVien}}">
                    @if ($errors->has('TenNhanVien'))
                        <span class="text-danger">{{ $errors->first('TenNhanVien') }}</span>
                    @endif
            </div>
            <div class="row">
                <div class="d-flex flex-column gap-2 col-12 col-sm-6">
                    <label for="ngay-sinh">Ngày sinh*</label>
                    <input  value="{{$nhanvien->NgaySinh}}" type="date" id="ngay-sinh" name="NgaySinh" class="py-1 px-2 rounded border border-1">
                    @if ($errors->has('NgaySinh'))
                        <span class="text-danger">{{ $errors->first('NgaySinh') }}</span>
                    @endif
                </div>
                <div class="d-flex flex-column gap-2 col-12 col-sm-6">
                    <label for="gioi-tinh">Giới tính*</label>
                    <select class="form-select form-select-sm" name="GioiTinh" aria-label="Small select example">
                        <option value="" selected>Giới tính</option>
                        <option @if ($nhanvien->GioiTinh == 'Nam') 
                                    selected 
                                @endif
                                value="Nam">Nam</option>
                        <option
                                @if ($nhanvien->GioiTinh == 'Nữ') 
                                    selected 
                                @endif
                         value="Nữ">Nữ</option>
                        <option 
                                @if ($nhanvien->GioiTinh == 'Giới tính khác') 
                                    selected 
                                @endif
                        value="Giới tính khác">Khác</option>
                    </select>
                    @if ($errors->has('GioiTinh'))
                        <span class="text-danger">{{ $errors->first('GioiTinh') }}</span>
                    @endif
                </div>
            </div>
            <div class="d-flex flex-column gap-2">
                <label for="dia-chi">Địa chỉ*</label>
                <input value="{{$nhanvien->DiaChi}}" type="text" id="dia-chi" name="DiaChi" class="py-1 px-2 rounded border border-1">
                @if ($errors->has('DiaChi'))
                    <span class="text-danger">{{ $errors->first('DiaChi') }}</span>
                @endif
            </div>
            <div class="row">
                <div class="d-flex flex-column gap-2 col-12 col-sm-6">
                    <label for="ngay-vao-lam">Ngày vào làm*</label>
                    <input  value="{{$nhanvien->NgayVaoLam}}" type="date" id="ngay-vao-lam" name="NgayVaoLam" class="py-1 px-2 rounded border border-1">
                    @if ($errors->has('NgayVaoLam'))
                        <span class="text-danger">{{ $errors->first('NgayVaoLam') }}</span>
                    @endif
                </div>
                <!-- <div class="d-flex flex-column gap-2 col-12 col-sm-6">
                    <label for="ngay-ra">Ngày ra</label>
                    <input type="date" id="ngay-ra" name="ngay-ra" class="py-1 px-2 rounded border border-1">
                </div> -->
            </div>
            <div class="d-flex flex-column gap-2">
                <label for="vi-tri-lam-viec">Chức vụ*</label>
                <select class="form-select form-select-sm" name="ViTri" aria-label="Small select example">
                    <option value="" selected>Chức vụ</option>
                    <option
                        @if ($nhanvien->ViTri == 'Tạp vụ') 
                            selected 
                        @endif
                    value="Tạp vụ">Tạp vụ</option>
                    <option
                        @if ($nhanvien->ViTri == 'Nhân viên bán vé') 
                            selected 
                        @endif
                    value="Nhân viên bán vé">Nhân viên bán vé</option>
                </select>
                @if ($errors->has('ViTri'))
                    <span class="text-danger">{{ $errors->first('ViTri') }}</span>
                @endif
            </div>
            <div class="d-flex flex-column gap-2">
                <label for="so-dien-thoai">Số điện thoại*</label>
                <input  value="{{$nhanvien->SDT}}" type="tel" id="so-dien-thoai" name="SDT" class="py-1 px-2 rounded border border-1">
                @if ($errors->has('SDT'))
                    <span class="text-danger">{{ $errors->first('SDT') }}</span>
                @endif
            </div>
            <!-- <div class="d-flex flex-column gap-2">
                <label for="email">Email*</label>
                <input type="email" id="email" name="email" class="py-1 px-2 rounded border border-1">
            </div> -->
            <div class="d-flex flex-column gap-2">
                <label for="password">Mật khẩu*</label>
                <input type="password" id="password" name="password" class="py-1 px-2 rounded border border-1">
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="d-flex flex-column gap-2">
                <label for="so-password_confirmation-thoai">Xác nhận mật khẩu*</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="py-1 px-2 rounded border border-1">
            </div>

            <div class="py-2 rounded text-center my-5" style="background-color: #5F6D7E">
                <button type="submit" class="border-0 bg-transparent  text-white">
                    Sửa nhân viên
                </button>
            </div>
        </form>
    </div>
@endsection
