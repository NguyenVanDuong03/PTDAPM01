@extends('layouts.admin')

@section('content')
<div class="col-8 col-md-10">
    <div class="mb-4">
        <a href="{{route('tintucs.index')}}">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 12H5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M12 19L5 12L12 5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>
    </div>
    <h3 class="pt-3">
        Thông tin tin tức
    </h3>
    <form class="d-grid gap-3 w-md-50 mx-auto" enctype="multipart/form-data">
        <div class="d-flex flex-column gap-2">
            <label for="TenSuKien">Tên sự kiện*</label>
            <input value="{{$tintuc->TenSuKien}}" type="text" id="ten-su-kien" name="TenSuKien" placeholder="Nhập tên sự kiện" class="py-1 px-2 rounded border border-1">

        </div>
        <div class="d-flex flex-column gap-2">
            <label for="TomTat">Tóm tắt*</label>
            <textarea name="TomTat" id="tom-tat" rows="2" placeholder="Nhập tóm tắt tin tức" class="py-1 px-2 rounded border border-1">{{$tintuc->TomTat}}</textarea>

        </div>
        <div class="row">
            <div class="d-flex flex-column gap-2 col-12 col-md-6">
                <label for="NgayDang">Ngày đăng*</label>
                <input value="{{$tintuc->NgayDang}}" type="datetime-local" id="ngay-dang" name="NgayDang" class="py-1 px-2 rounded border border-1">

            </div>
            <div class="d-flex flex-column gap-2 col-12 col-md-6">
                <label for="TenDangNhapNV">Tên đăng nhập nhân viên*</label>
                <input value="{{$tintuc->TenDangNhapNV}}" type="text" id="ten-dang-nhap-nv" name="TenDangNhapNV" class="py-1 px-2 rounded border border-1">
            </div>
        </div>
        <div class="col-6 flex-column d-flex gap-2">
            <label for="anh">Ảnh đồ ăn*</label>
            <input name="Anh" type="file" id="anh" accept="Anh/*" onchange="previewImage(event)">
            @if($anhURL)
            <img src="{{$anhURL}}" alt="" id="anh-hien-thi" class="img-thumbnail w-75">
            @else
            <img src="" alt="" id="anh-hien-thi" class="img-thumbnail w-75" style="display: none;">
            @endif

        </div>
        <div class="d-flex flex-column gap-2">
            <label for="NoiDung">Nội dung tin tức*</label>
            <textarea name="NoiDung" id="noi-dung" rows="10" placeholder="Nhập nội dung tin tức" class="py-1 px-2 rounded border border-1">{{$tintuc->NoiDung}}"</textarea>

        </div>

    </form>
</div>
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