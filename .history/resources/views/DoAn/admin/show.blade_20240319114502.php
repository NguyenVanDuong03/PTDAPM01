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
    <h3>Thông tin đồ ăn</h3>
    <form action="" class="d-grid gap-3 w-md-50 mx-auto">
        <div class="row">
            <div class="col-6 flex-column d-flex gap-2">
                <label for="anh">Ảnh đồ ăn*</label>
                <img style="width: 200px; height: 200px;" src="{{$anhURL}}" alt="" id="anh-hien-thi" class="img-thumbnail w-75" style="display: none;">
            </div>
            <div class="col-3 flex-column d-flex gap-2">
                <label for="ten-do-an" class="">Tên đồ ăn*</label>
                <input value="{{$doan->TenDoAn}}" type="text" id="ten-do-an" class="py-1 px-2 rounded border border-1" placeholder="Nhập tên đồ ăn" disabled="true">
            </div>
            <div class="col-3 flex-column d-flex gap-2">
                <label for="ten-do-an" class="">Tên đồ ăn*</label>
                <input value="{{$doan->DoAn}}" type="text" id="ten-do-an" class="py-1 px-2 rounded border border-1" placeholder="Nhập tên đồ ăn" disabled="true">
            </div>
        </div>
        <div class="flex-column d-flex gap-2">
            <label for="the-loai-do-an">Thể loại đồ ăn*</label>
            <input value="{{$doan->getLoaiDoAn()->TenTheLoai}}" type="text" id="ten-do-an" class="py-1 px-2 rounded border border-1" placeholder="Nhập tên đồ ăn" disabled="true">
        </div>
        <div class="flex-column d-flex gap-2">
            <label for="trang-thai-do-an">Trạng thái đồ ăn*</label>
            <input value="{{$doan->TinhTrang}}" type="text" id="ten-do-an" class="py-1 px-2 rounded border border-1" placeholder="Nhập tên đồ ăn" disabled="true">
        </div>
        <div class="flex-column d-flex gap-2">
            <label for="trang-thai-do-an">Giá đồ ăn*</label>
            <input value="{{$lichsugiadoan->Gia}}" type="text" id="ten-do-an" class="py-1 px-2 rounded border border-1" placeholder="Nhập tên đồ ăn" disabled="true">
        </div>
    </form>
</div>
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