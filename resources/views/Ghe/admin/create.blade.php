@extends('layouts.admin')
@section('content')
<!-- BEGIN: Form -->
<div class="col-8 col-md-10">
    <div class="mb-4">
        {{-- Thêm đường dẫn qua lại index --}}
        <a href="{{ route('ghengois.index') }}">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 12H5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M12 19L5 12L12 5" stroke="black" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </a>
    </div>
    <h3 class="pt-3">
        Thêm ghế
    </h3>
    <form action="{{route('ghengois.store')}}" method="POST" class="d-grid gap-3 w-md-50 mx-auto">
        @csrf
        <div class="flex-column d-flex gap-2">
            <label for="ma-phong">Phòng*</label>
            <select class="form-select form-select-sm" name="MaPhong" aria-label="Small select example">
                @foreach($phongchieus as $phong)
                @if($phong->TinhTrang == "Bình thường")
                <option value="{{ $phong->MaPhong }}">{{ $phong->MaPhong }}</option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="flex-column d-flex gap-2">
            <label for="ma-loai-ghe">Loại ghế*</label>
            <select class="form-select form-select-sm" name="MaLoaiGhe" aria-label="Small select example">
                @foreach($loaighes as $loaighe)
                <option value="{{ $loaighe->MaLoaiGhe }}">{{ $loaighe->TenLoaiGhe }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex-column d-flex gap-2">
            <label for="vi-tri-day" class="">Vị trí dãy*</label>
            <input type="text" maxlength="2" name="ViTriDay" id="vi-tri-day" class="py-1 px-2 rounded border border-1"
                placeholder="Nhập vị trí dãy">
            @error('ViTriDay')
            <div class="text-danger fw-bold">{{$message}}</div>
            @enderror
        </div>
        <div class="flex-column d-flex gap-2">
            <label for="vi-tri-cot" class="">Vị trí cột*</label>
            <input type="number" min="0" id="vi-tri-cot" name="ViTriCot" class="py-1 px-2 rounded border border-1"
                placeholder="Nhập vị trí cột">
            @error('ViTriCot')
            <div class="text-danger fw-bold">{{$message}}</div>
            @enderror
        </div>
        <div class="rounded text-center my-5" style="background-color: #5F6D7E">
            <button type="submit " class="border-0 bg-transparent py-2 w-100 text-white">
                Thêm ghế
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
