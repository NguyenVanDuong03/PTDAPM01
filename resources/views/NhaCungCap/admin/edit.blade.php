@extends('layouts.admin')
@section('content')
<!-- BEGIN: Form -->
<div class="col-8 col-md-10">
    <div class="mb-4">
        {{-- Thêm đường dẫn qua lại index --}}
        <a href="{{ route('nhacungcaps.index') }}">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 12H5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M12 19L5 12L12 5" stroke="black" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </a>
    </div>
    <h3>Chỉnh sửa nhà cung cấp</h3>
    <form method="POST" action="{{ route('nhacungcaps.update',$nhacungcap->MaNCC) }}"
        class="d-grid gap-3 w-md-50 mx-auto">
        @csrf
        @method('PUT')
        <div class="flex-column d-flex gap-2">
            <label for="ten_nha_cung_cap" class="">Tên nhà cung cấp*</label>
            <input value="{{ htmlspecialchars($nhacungcap->TenNCC) }}" type="text" maxlength="40" id="ten_nha_cung_cap"
                name="TenNCC" class="py-1 px-2 rounded border border-1" placeholder="Nhập tên nhà cung cấp">
            @error('TenNCC')
            <div class="text-danger fw-bold">{{$message}}</div>
            @enderror
        </div>
        <div class="flex-column d-flex gap-2">
            <label for="tinh_trang" class="">Tình trạng*</label>
            <select class="form-select form-select-sm" name="TinhTrang" aria-label="Small select example">
                <option value="Đang hợp tác" {{ $nhacungcap->TinhTrang =="Đang hợp tác"?"selected":"" }}>Đang hợp tác
                </option>
                <option value="Ngưng hợp tác" {{ $nhacungcap->TinhTrang =="Ngưng hợp tác"?"selected":"" }}>Ngưng hợp tác
                </option>
            </select>
        </div>
        <div class="flex-column d-flex gap-2">
            <label for="quoc_gia" class="">Quốc gia*</label>
            <select class="form-select form-select-sm" name="QuocGia" aria-label="Small select example">
                <option value="Việt Nam" {{ $nhacungcap->QuocGia=="Việt Nam"?"selected":"" }}>Việt Nam</option>
                <option value="Lào" {{ $nhacungcap->QuocGia=="Lào"?"selected":"" }}>Lào</option>
                <option value="Campuchia" {{ $nhacungcap->QuocGia=="Campuchia"?"selected":"" }}>Campuchia</option>
            </select>
        </div>
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