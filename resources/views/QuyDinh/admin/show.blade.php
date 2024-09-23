@extends('layouts.admin')
@section('content')
<!-- BEGIN: Form -->
<div class="col-8 col-md-10">
    <a href="{{route('quydinhs.index')}}">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M19 12H5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M12 19L5 12L12 5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </a>
    <h3>Thông tin quy định</h3>
    <form action="" class="d-grid gap-3 w-md-50 mx-auto">
        <div class="flex-column d-flex gap-2">
            <label for="ten-loai-do-an" class="">Tiêu đề*</label>
            <input type="text" id="ten-loai-do-an" class="py-1 px-2 rounded border border-1"
                placeholder="Nhập tên loại đồ ăn" disabled="true" value="{{ $quydinh->TieuDe }}">
        </div>
        <div class="flex-column d-flex gap-2">
            <label for="mo-ta">Nội dung*</label>
            <textarea name="mo-ta" id="mo-ta" cols="30" rows="10" class="px-2 py-1 rounded-2" placeholder="Nhập mô tả"
                disabled="true">
                        {{ $quydinh->NoiDung }}</textarea>
        </div>
    </form>
</div>
<!-- END: Form -->
@endsection
@section('script')

@endsection