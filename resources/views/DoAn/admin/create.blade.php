@extends('layouts.admin')
@section('content')
    <!-- BEGIN: Form -->
    <div class="col-8 col-md-10">
        <a href="{{ route('doans.index') }}">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 12H5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M12 19L5 12L12 5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>
        <h3>Thêm thông tin đồ ăn</h3>
        <form id="form" action="{{ route('doans.store') }}" class="d-grid gap-3 w-md-50 mx-auto" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class=" flex-column d-flex gap-2">
                <label for="Anh">Ảnh đồ ăn*</label>
                <input name="Anh" type="file" id="image" accept="Anh/*" onchange="previewImage(event)">
                <img alt="" id="anh-hien-thi" class="img-thumbnail" style="display: none; width: 150px">
                @error('Anh')
                    <div class="text-danger fw-bold">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex-column d-flex gap-2">
                <label for="ten-do-an" class="">Tên đồ ăn*</label>
                <input value="{{ old('TenDoAn') }}" name="TenDoAn" type="text" id="ten-do-an"
                    class="py-1 px-2 rounded border border-1" placeholder="Nhập tên đồ ăn">
                @error('TenDoAn')
                    <div class="text-danger fw-bold">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex-column d-flex gap-2">
                <label for="the-loai-do-an">Thể loại đồ ăn*</label>
                <select class="form-select form-select-sm" aria-label="Small select example" name="MaTheLoai">
                    <option value="" selected disabled>Vui lòng chọn loại đồ ăn</option>
                    @foreach ($loaidoans as $item)
                        <option value="{{ $item->MaTheLoai }}" {{ old('MaTheLoai') == $item->MaTheLoai ? 'selected' : '' }}>
                            {{ $item->TenTheLoai }}</option>
                    @endforeach
                </select>
                @error('MaTheLoai')
                    <div class="text-danger fw-bold">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex flex-column gap-2">
                <label for="MoTa">Mô tả*</label>
                <textarea name="MoTa" id="Mo-Ta" rows="2" placeholder="Nhập mô tả"
                    class="py-1 px-2 rounded border border-1">{{ old('MoTa') }}</textarea>
                @error('MoTa')
                    <div class="text-danger fw-bold">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex-column d-flex gap-2">
                <label for="Gia" class="">Giá đồ ăn*</label>
                <input value="{{ old('Gia') }}" name="Gia" type="number" id="Gia"
                    class="py-1 px-2 rounded border border-1" placeholder="Nhập giá đồ ăn">
                @error('Gia')
                    <div class="text-danger fw-bold">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex-column d-flex gap-2">
                <label for="TinhTrang">Trạng thái đồ ăn*</label>
                <select class="form-select form-select-sm" aria-label="Small select example" name="TinhTrang">
                    <option value="" selected disabled>Vui lòng chọn trạng thái đồ ăn</option>
                    <option value="Không có sẵn" {{ old('TinhTrang') == 'Không có sẵn' ? 'selected' : '' }}>Có sẵn</option>
                    <option value="Không có sẵn" {{ old('TinhTrang') == 'Không có sẵn' ? 'selected' : '' }}>Không có sẵn
                    </option>
                </select>
                @error('TinhTrang')
                    <div class="text-danger fw-bold">{{ $message }}</div>
                @enderror
            </div>




            <div class="py-2 rounded text-center mt-5" style="background-color: #5F6D7E">
                <button id="btn_submit" type="submit" class="border-0 bg-transparent text-white w-100">
                    Thêm
                </button>
            </div>
        </form>
    </div>

    @if (session('mess_fail'))
        <div id="toast">
            <div class="message message--error">
                <div class="message__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ff623d"
                        class="bi bi-x-circle-fill" viewBox="0 0 16 16">
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

    <script>
        $(document).on('click', '#btn_submit', function(e) {
            e.preventDefault();
            let isValid = true;

            // Kiểm tra ảnh
            const image = $('#image');
            let imageInput = image[0];
            image.parent().find('div.text-danger').remove();

            if (!imageInput.files.length) {
                image.parent().append('<div class="text-danger fw-bold">Ảnh đồ ăn không được bỏ trống</div>');
                isValid = false;
            } else if (imageInput.files[0].size > 20 * 1024 * 1024) {
                image.parent().append('<div class="text-danger fw-bold">Ảnh không vượt quá 20MB</div>');
                isValid = false;
            } else {
                const file = imageInput.files[0];
                const fileType = file['type'];
                const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];
                if (!validImageTypes.includes(fileType)) {
                    image.parent().append(
                        '<div class="text-danger fw-bold">Ảnh phải có định dạng JPG, PNG, GIF</div>');
                    isValid = false;
                }
            }

            // Kiểm tra tên đồ ăn
            const name = $('#ten-do-an');
            let naemInput = name.val();
            name.parent().find('div.text-danger').remove();
            if (!naemInput) {
                name.parent().append('<div class="text-danger fw-bold">Tên đồ ăn không được bỏ trống</div>');
                isValid = false;
            } else if (naemInput.length > 255) {
                name.parent().append('<div class="text-danger fw-bold">Tên đồ ăn không quá 255 ký tự</div>');
                isValid = false;
            } else if (!/^[a-zA-Z0-9 ]+$/.test(naemInput)) {
                name.parent().append('<div class="text-danger fw-bold">Tên đồ ăn không chứa ký tự đặc biệt</div>');
                isValid = false;
            }

            // Kiểm tra thể loại
            const category = $('select[name="MaTheLoai"]');
            let categoryInput = category.val();
            category.parent().find('div.text-danger').remove();
            if (!categoryInput) {
                category.parent().append(
                    '<div class="text-danger fw-bold">Thể loại đồ ăn không được bỏ trống</div>');
                isValid = false;
            }

            // Kiểm tra mô tả
            const description = $('#Mo-Ta');
            let descriptionInput = description.val();
            description.parent().find('div.text-danger').remove();
            if (!descriptionInput) {
                description.parent().append(
                    '<div class="text-danger fw-bold">Mô tả đồ ăn không được bỏ trống</div>');
                isValid = false;
            } else if (descriptionInput.length < 50) {
                description.parent().append(
                    '<div class="text-danger fw-bold">Mô tả đồ ăn tối thiểu 50 ký tự</div>');
                isValid = false;
            } else if (!/^[a-zA-Z0-9 ]+$/.test(descriptionInput)) {
                description.parent().append(
                    '<div class="text-danger fw-bold">Mô tả đồ ăn không chứa ký tự đặc biệt</div>');
                isValid = false;
            }

            // Kiểm tra giá
            const price = $('#Gia');
            let priceInput = price.val();
            price.parent().find('div.text-danger').remove();
            if (!priceInput) {
                price.parent().append('<div class="text-danger fw-bold">Giá đồ ăn không được bỏ trống</div>');
                isValid = false;
            } else if (isNaN(priceInput) || priceInput < 1000) {
                price.parent().append('<div class="text-danger fw-bold">Giá đồ ăn tối thiểu 1000 (VND)</div>');
                isValid = false;
            }

            // Kiểm tra tình trạng
            const status = $('select[name="TinhTrang"]');
            let statusInput = status.val();
            status.parent().find('div.text-danger').remove();
            if (!statusInput) {
                status.parent().append(
                    '<div class="text-danger fw-bold">Tình trạng đồ ăn không được bỏ trống</div>');
                isValid = false;
            }

            if (isValid) {
                $('#form').submit();
            }
        });
    </script>
@endsection
