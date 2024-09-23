@extends('layouts.admin')

@section('content')
<div class="col-8 col-md-10">
    <a href="{{route('vouchers.index')}}">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M19 12H5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M12 19L5 12L12 5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </a>
    <h3 style="padding-top: 20px;">
        Sửa voucher
    </h3>
    <form action="{{route('vouchers.update', ['voucher'=>$voucher->MaVoucher])}}" method="POST" class="d-grid gap-3 w-md-50 mx-auto">
        @csrf
        @method('PUT')
        <div class="d-flex flex-column gap-2">
            <label for="TenDangNhapNVv">Tên đăng nhập nhân viên*</label>
            <input value="{{$voucher->TenDangNhapNV}}" type="text" id="ten-dang-nhap-nv" name="TenDangNhapNV" class="py-1 px-2 rounded border border-1">
            @error('TenDangNhapNVv')
            <div class="text-danger fw-bold">{{$message}}</div>
            @enderror
        </div>
        <div class="row">
            <div class="d-flex flex-column gap-2 col-12 col-sm-6">
                <label for="TiLeChietKhau">Tỉ lệ chiết khẩu*</label>
                <input value="{{$voucher->TiLeChietKhau}}" type="text" id="ti-le-chiet-khau" name="TiLeChietKhau" class="py-1 px-2 rounded border border-1">
                @error('TiLeChietKhau')
                <div class="text-danger fw-bold">{{$message}}</div>
                @enderror
            </div>
            <div class="d-flex flex-column gap-2 col-12 col-sm-6">
                <label for="HanMuc">Hạn mức*</label>
                <input value="{{$voucher->HanMuc}}" type="text" id="han-muc" name="HanMuc" class="py-1 px-2 rounded border border-1">
                @error('HanMuc')
                <div class="text-danger fw-bold">{{$message}}</div>
                @enderror
            </div>
        </div>
        <div class="d-flex flex-column gap-2">
            <label for="TinhTrang">Tình trạng vouvher*</label>
            <select class="form-select form-select-sm" name="TinhTrang" aria-label="Small select example">
                <option value="Đã sử dụng" {{ $voucher->TinhTrang == 'Đã sử dụng' ? 'selected' : '' }}>Đã sử dụng</option>
                <option value="Chưa sử dụng" {{ $voucher->TinhTrang == 'Chưa sử dụng' ? 'selected' : '' }}>Chưa sử dụngg</option>
                <option value="Đã xóa" {{ $voucher->TinhTrang == 'Đã xóa' ? 'selected' : '' }}>Đã xóa</option>
            </select>
        </div>
        <div class="row">
            <div class="d-flex flex-column gap-2 col-12 col-sm-6">
                <label for="NgayTao">Ngày tạo*</label>
                <input value="{{$voucher->NgayTao}}" type="date" name="NgayTao" id="ngay-tao" class="py-1 px-2 rounded border border-1">
                @error('NgayTao')
                <div class="text-danger fw-bold">{{$message}}</div>
                @enderror
            </div>
            <div class="d-flex flex-column gap-2 col-12 col-sm-6">
                <label for="HanDung">Hạn dùng*</label>
                <input value="{{$voucher->HanDung}}" type="datetime-local" name="HanDung" id="han-dung" class="py-1 px-2 rounded border border-1">
                @error('HanDung')
                <div class="text-danger fw-bold">{{$message}}</div>
                @enderror
            </div>
        </div>
        <div class="rounded text-center my-5" style="background-color: #5F6D7E">
            <button type="submit " class="border-0 bg-transparent w-100 py-2 text-white">
                Sửa
            </button>
        </div>
    </form>
</div>
@if (session('mess_fail'))
<div id="toast">
    <div class="message message--error">
        <div class="message__icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ff623d" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z" />
            </svg>
        </div>
        <div class="message__body">
            <h3 class="message__title mb-0"> {{ session('mess_fail') }}
            </h3>

        </div>
        <div class="message__close">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="black" class="bi bi-x-lg" viewBox="0 0 16 16">
                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
            </svg>
        </div>
    </div>
</div>
@endif

@if (session('mess_success'))
<div id="toast">
    <div class="message message--error">
        <div class="message__icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ff623d" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z" />
            </svg>
        </div>
        <div class="message__body">
            <h3 class="message__title mb-0"> {{ session('mess_success') }}
            </h3>

        </div>
        <div class="message__close">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="black" class="bi bi-x-lg" viewBox="0 0 16 16">
                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
            </svg>
        </div>
    </div>
</div>
@endif

@endsection

{{--@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ngayTaoInput = document.getElementById('ngay-tao');
        var hanDungInput = document.getElementById('han-dung');

        hanDungInput.addEventListener('change', function() {
            var ngayTaoValue = new Date(ngayTaoInput.value);
            var hanDungValue = new Date(hanDungInput.value);

            if (hanDungValue <= ngayTaoValue) {
                alert("Ngày hạn dùng phải lớn hơn ngày tạo!");
                hanDungInput.value = '';
            }
        });
    });
</script>
@endsection--}}