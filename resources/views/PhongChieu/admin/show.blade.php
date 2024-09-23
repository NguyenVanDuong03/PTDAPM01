@extends('layouts.admin.aside')

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
            Thông tin phòng chiếu
        </h3>
        <form action="" class="d-grid gap-3 w-md-50 mx-auto">
            <div class="d-flex flex-column gap-2">
                <label for="so-luong-ghe">Số lượng ghế*</label>
                <input type="number" id="so-luong-ghe" name="so-luong-ghe" placeholder="Nhập số lượng ghế"
                    class="py-1 px-2 rounded border border-1" disabled="true">
            </div>
            <div class="d-flex flex-column gap-2">
                <label for="tinh-trang">Tình trạng ghế*</label>
                <select class="form-select form-select-sm" name="tinh-trang" aria-label="Small select example"
                    disabled="true">
                    <option selected>Tình trạng ghế</option>
                    <option value="binh-thuong">Bình thường</option>
                    <option value="ngung-su-dung">Ngưng sử dụng</option>
                    <option value="tam-ngung">Tạm ngưng</option>
                </select>
            </div>

        </form>
    </div>
@endsection
