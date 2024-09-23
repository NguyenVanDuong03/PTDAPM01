@extends('layouts.admin.aside')
@section('content')
  <!-- BEGIN: Form -->
  <div class="col-8 col-md-10">
                <h3>Thêm thông tin loại đồ ăn</h3>
                <form action="" class="d-grid gap-3 w-md-50 mx-auto">
                    <div class="flex-column d-flex gap-2">
                        <label for="ten-loai-do-an" class="">Tên loại đồ ăn*</label>
                        <input type="text" id="ten-loai-do-an" class="py-1 px-2 rounded border border-1"
                            placeholder="Nhập tên loại đồ ăn" disabled="true">
                    </div>
                    <div class="flex-column d-flex gap-2">
                        <label for="mo-ta">Mô tả*</label>
                        <textarea name="mo-ta" id="mo-ta" cols="30" rows="10" class="px-2 py-1 rounded-2"
                            placeholder="Nhập mô tả" disabled="true"></textarea>
                    </div>
                </form>
            </div>
            <!-- END: Form -->
@endsection
@section('script')

@endsection