@extends('layouts.admin')
@section('content')
<!-- BEGIN: Form -->
<div class="col-8 col-md-10">
    <a href="{{route('doans.index')}}">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M19 12H5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M12 19L5 12L12 5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </a>
    <h3>Thêm thông tin đồ ăn</h3>
    <form action="{{route('doans.store')}}" class="d-grid gap-3 w-md-50 mx-auto" method="POST" enctype="multipart/form-data">
        @csrf
        <div class=" flex-column d-flex gap-2">
            <label for="Anh">Ảnh đồ ăn</label>
            <input name="Anh" type="file" id="image" accept="Anh/*" onchange="previewImage(event)">
            <img src="" alt="" id="anh-hien-thi" class="img-thumbnail w-75" style="display: none;">
            @error('Anh')
            <div class="text-danger fw-bold">{{$message}}</div>
            @enderror
        </div>
        <div class="flex-column d-flex gap-2">
            <label for="ten-do-an" class="">Tên đồ ăn*</label>
            <input value="{{ old('TenDoAn') }}" name="TenDoAn" type="text" id="ten-do-an" class="py-1 px-2 rounded border border-1" placeholder="Nhập tên đồ ăn">
            @error('TenDoAn')
            <div class="text-danger fw-bold">{{$message}}</div>
            @enderror
        </div>
        <div class="flex-column d-flex gap-2">
            <label for="the-loai-do-an">Thể loại đồ ăn*</label>
            <select class="form-select form-select-sm" aria-label="Small select example" name="MaTheLoai">
                <option sel>---Thể loại đồ ăn---- </option>
                @foreach($loaidoans as $item)
                <option value="{{$item->MaTheLoai}}">{{$item->TenTheLoai}}</option>
                @endforeach
            </select>
        </div>
        <div class="flex-column d-flex gap-2">
            <label for="TinhTrang">Trạng thái đồ ăn*</label>
            <select class="form-select form-select-sm" aria-label="Small select example" name="TinhTrang">
                <option>Trạng thái</option>
                <option value="Đang bán">Đang bán</option>
                <option value="Ngừng bán">Ngừng bán</option>
            </select>
        </div>

        <div class="row">
            <div class="flex-column d-flex gap-2">
                <label for="Gia" class="">Giá đồ ăn*</label>
                <input value="{{ old('Gia') }}" name="Gia" type="number" id="ten-do-an" class="py-1 px-2 rounded border border-1" placeholder="Nhập giá đồ ăn">
                @error('Gia')
                <div class="text-danger fw-bold">{{$message}}</div>
                @enderror

            </div>
        </div>


        <div class="py-2 rounded text-center mt-5" style="background-color: #5F6D7E">
            <button type="submit" class="border-0 bg-transparent  text-white">
                Thêm
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

<!-- END: Form -->
@endsection

@section('script')
<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('anh-hien-thi');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            preview.style.display = 'none';
        }
    }
</script>
@endsection