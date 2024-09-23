@extends('layouts.admin')
@section('content')
<!-- BEGIN: Form -->
<div class="col-8 col-md-10">
    <div class="mb-4">
        {{-- Thêm đường dẫn qua lại index --}}
        <a href="{{ route('phims.index') }}">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 12H5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M12 19L5 12L12 5" stroke="black" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </a>
    </div>
    <h3>Chỉnh sửa phim</h3>
    <form method="POST" enctype="multipart/form-data" action="{{ route('phims.update',$phim->MaPhim) }}"
        class="d-grid gap-3 w-md-50 mx-auto">
        @csrf
        @method('PUT')
        <div class="flex-column d-flex gap-2">
            <label for="TenPhim" class="">Tên phim*</label>
            <input value="{{ $phim->TenPhim }}" type="text" id="TenPhim" name="TenPhim"
                class="py-1 px-2 rounded border border-1" placeholder="Nhập tên phim">
            @error('TenPhim')
            <div class="text-danger fw-bold">{{$message}}</div>
            @enderror
        </div>
        <div class="flex-column d-flex gap-2">
            <label for="Anhphim" class="">Ảnh phim*</label>
            <input type="file" id="Anhphim" name="image" class="py-1 px-2 rounded border border-1">
            @error('image')
            <div class="text-danger fw-bold">{{$message}}</div>
            @enderror
            @if ($phim->DuongDan)
            <img src="{{ asset($phim->DuongDan) }}" alt="Ảnh phim" style="max-width: 200px;">
            @endif
        </div>
        <div class="flex-column d-flex gap-2">
            <label for="TenPhim" class="">Thể loại phim*</label>
            <select class="form-control" id="MaTheLoai" name="MaTheLoai">
                <option value="" disabled selected>Thể loại</option>
                @foreach($theloais as $theloai)
                <option value="{{ $theloai->MaTheLoai }}" {{ $theloai->MaTheLoai == $phim->MaTheLoai ? 'selected' :
                    '' }}>{{ $theloai->TenTheLoai }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex-column d-flex gap-2">
            <label for="MaNCC" class="">Nhà cung cấp*</label>
            <select class="form-control" id="MaNCC" name="MaNCC">
                <option value="" disabled selected>Nhà cung cấp</option>
                @foreach($nhacungcaps as $nhacungcap)
                <option value="{{ $nhacungcap->MaNCC }}" {{ $nhacungcap->MaNCC == $phim->MaNCC ? 'selected' :
                    '' }}>{{ $nhacungcap->TenNCC }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex-column d-flex gap-2">
            <label for="ThoiLuong" class="">Thời lượng*</label>
            <input value="{{ $phim->ThoiLuong }}" min="0" type="number" id="ThoiLuong" name="ThoiLuong"
                class="py-1 px-2 rounded border border-1" placeholder="Nhập thời lượng">
            @error('ThoiLuong')
            <div class="text-danger fw-bold">{{$message}}</div>
            @enderror
        </div>
        <div class="flex-column d-flex gap-2">
            <label for="NgayCongChieu" class="">Ngày công chiếu*</label>
            <input type="date" value="{{ $phim->NgayCongChieu }}" id="NgayCongChieu" name="NgayCongChieu"
                class="py-1 px-2 rounded border border-1" placeholder="Chọn ngày công chiếu"
                min="<?php echo date('Y-m-d'); ?>">
            @error('NgayCongChieu')
            <div class="text-danger fw-bold">{{$message}}</div>
            @enderror
        </div>
        <div class="flex-column d-flex gap-2">
            <label for="TrangThai" class="">Trạng thái*</label>
            <select class="form-control" id="TrangThai" name="TrangThai">
                <option value="" disabled selected>Trạng thái</option>
                <option value="Đang chiếu" {{ $phim->TrangThai =="Đang chiếu" ? 'selected' :
                    '' }}>Đang chiếu</option>
                <option value="Sắp chiếu" {{ $phim->TrangThai =="Sắp chiếu" ? 'selected' :
                    '' }}>Sắp chiếu</option>
            </select>
        </div>
        <div class="flex-column d-flex gap-2">
            <label for="MoTa" class="">Tóm tắt</label>
            <input value="{{ $phim->MoTa }}" type="text" id="MoTa" name="MoTa" class="py-1 px-2 rounded border border-1"
                placeholder="Nhập mô tả">
        </div>
        {{-- <div class="flex-column d-flex gap-2">
            <label for="thoi-gian">Thời gian tạo*</label>
            <input type="datetime" id="thoi-gian" name="thoi-gian" disabled="true" class="px-2 py-1">
        </div>
        <div class="flex-column d-flex gap-2">
            <label for="gia">Gia*</label>
            <input type="text" id="gia" name="gia" class="px-2 py-1" oninput="formatNumber(event)">
        </div> --}}
        <div class="py-2 rounded text-center mt-5" style="background-color: #5F6D7E">
            <button type="submit" class="border-0 bg-transparent  text-white">
                Cập nhật
            </button>
        </div>
    </form>
</div>
@if (session('mess_fail'))
<div id="toast">
    <div class="message message--error">
        <div class="message__icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ff623d" class="bi bi-x-circle-fill"
                viewBox="0 0 16 16">
                <path
                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z" />
            </svg>
        </div>
        <div class="message__body">
            <h3 class="message__title mb-0"> {{ session('mess_fail') }}
            </h3>

        </div>
        <div class="message__close">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="black" class="bi bi-x-lg"
                viewBox="0 0 16 16">
                <path
                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
            </svg>
        </div>
    </div>
</div>
@endif
<!-- END: Form -->
@endsection