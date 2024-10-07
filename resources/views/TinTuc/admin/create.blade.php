@extends('layouts.admin')

@section('content')
    <div class="col-8 col-md-10">

        <a href="{{ route('tintucs.index') }}">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 12H5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M12 19L5 12L12 5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>
        <h3>
            Thêm tin tức
        </h3>
        <form id="form" action="{{ route('tintucs.store') }}" method="POST" class="d-grid gap-3 w-md-50 mx-auto"
            enctype="multipart/form-data">
            @csrf
            <div class="d-flex flex-column gap-2">
                <label for="TenSuKien">Tên sự kiện*</label>
                <input value="{{ old('TenSuKien') }}" type="text" id="ten-su-kien" name="TenSuKien"
                    placeholder="Nhập tên sự kiện" class="py-1 px-2 rounded border border-1">
                @error('TenSuKien')
                    <div class="text-danger fw-bold">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex flex-column gap-2">
                <label for="MaLoaiTinTuc">Loại tin tức*</label>
                <select class="form-select form-select-sm py-1 px-2 rounded border border-1" name="MaLoaiTinTuc"
                    aria-label="Small select example">
                    <option value="" selected disabled>Vui lòng chọn loại tin tức</option>
                    @foreach ($loaitintucs as $tintuc)
                        <option value="{{ $tintuc->MaLoaiTinTuc }}">{{ $tintuc->TenLoaiTinTuc }}</option>
                    @endforeach
                </select>
                @error('MaLoaiTinTuc')
                    <div class="text-danger fw-bold">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex flex-column gap-2">
                <label for="TomTat">Tóm tắt*</label>
                <textarea name="TomTat" id="tom-tat" rows="2" placeholder="Nhập tóm tắt tin tức"
                    class="py-1 px-2 rounded border border-1">{{ old('TomTat') }}</textarea>
                @error('TomTat')
                    <div class="text-danger fw-bold">{{ $message }}</div>
                @enderror
            </div>
            <div class="row">
                <div class="d-flex flex-column gap-2 col-6">
                    <label for="NgayDang">Ngày đăng*</label>
                    <input value="{{ old('NgayDang') }}" type="datetime-local" id="ngay-dang" name="NgayDang"
                        class="py-1 px-2 rounded border border-1">
                    @error('NgayDang')
                        <div class="text-danger fw-bold">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex flex-column gap-2 col-6">
                    <label for="TenDangNhapNV">Tên nhân viên đăng bài*</label>
                    <select class="form-select form-select-sm py-1 px-2 rounded border border-1" name="TenDangNhapNV"
                        aria-label="Small select example">
                        <option value="" selected disabled>Vui lòng chọn nhân viên</option>
                        @foreach ($nhanviens as $nhanvien)
                            <option value="{{ $nhanvien->TenDangNhapNV }}">{{ $nhanvien->TenNhanVien }}</option>
                        @endforeach
                    </select>
                    @error('TenDangNhapNV')
                        <div class="text-danger fw-bold">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class=" flex-column d-flex gap-2">
                <label for="Anh">Ảnh tin tức</label>
                <input name="Anh" type="file" id="image" accept="Anh/*" onchange="previewImage(event)">
                <img alt="" id="anh-hien-thi" class="img-thumbnail" style="display: none; width: 150px">
                @error('Anh')
                    <div class="text-danger fw-bold">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex flex-column gap-2">
                <label for="NoiDung">Nội dung tin tức*</label>
                <textarea name="NoiDung" id="Noi-Dung" rows="10" placeholder="Nhập nội dung tin tức"
                    class="py-1 px-2 rounded border border-1">{{ old('NoiDung') }}</textarea>
                @error('NoiDung')
                    <div class="text-danger fw-bold">{{ $message }}</div>
                @enderror
            </div>

            <div class="rounded text-center my-5" style="background-color: #5F6D7E">
                <button id="btn_submit" type="submit " class="border-0 bg-transparent py-2 w-100 text-white">
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
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="black"
                        class="bi bi-x-lg" viewBox="0 0 16 16">
                        <path
                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                    </svg>
                </div>
            </div>
        </div>
    @endif
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
        $(document).ready(function() {
            
            function tenSuKien() {
                const tenSuKien = $('#ten-su-kien');
                let tenSuKienInput = tenSuKien.val();
                tenSuKien.parent().find('.text-danger').remove();
                if (!tenSuKienInput) {
                    tenSuKien.parent().append('<div class="text-danger fw-bold">Tên tin tức không được bỏ trống</div>');
                    return false;
                } else if (tenSuKienInput.length > 255) {
                    tenSuKien.parent().append('<div class="text-danger fw-bold">Tên tin tức không quá 255 ký tự</div>');
                    return false;
                } else if (!/^[a-zA-Z0-9 ]+$/.test(tenSuKienInput)) {
                    tenSuKien.parent().append(
                        '<div class="text-danger fw-bold">Tên tin tức không chứa ký tự đặc biệt</div>');
                    return false;
                }
                return true;
            }

            function loaiTinTuc() {
                const loaiTinTuc = $('select[name="MaLoaiTinTuc"]');
                let loaiTinTucInput = loaiTinTuc.val();
                loaiTinTuc.parent().find('.text-danger').remove();
                if (!loaiTinTucInput) {
                    loaiTinTuc.parent().append(
                        '<div class="text-danger fw-bold">Loại tin tức không được để trống</div>');
                    return false;
                }
                return true;
            }

            function tomTat() {
                const tomTat = $('#tom-tat');
                let tomTatInput = tomTat.val();
                tomTat.parent().find('.text-danger').remove();
                if (!tomTatInput) {
                    tomTat.parent().append('<div class="text-danger fw-bold">Tóm tắt không được bỏ trống</div>');
                    return false;
                } else if (tomTatInput.length > 500) {
                    tomTat.parent().append('<div class="text-danger fw-bold">Tóm tắt không quá 500 ký tự</div>');
                    return false;
                } else if (!/^[a-zA-Z0-9 ]+$/.test(tomTatInput)) {
                    tomTat.parent().append('<div class="text-danger fw-bold">Tóm tắt không chứa ký tự đặc biệt</div>');
                    return false;
                }
                return true;
            }

            function ngayDang() {
                const ngayDang = $('#ngay-dang');
                let ngayDangInput = ngayDang.val();
                ngayDang.parent().find('.text-danger').remove();
                if (!ngayDangInput) {
                    ngayDang.parent().append('<div class="text-danger fw-bold">Ngày đăng không được bỏ trống</div>');
                    return false;
                } else if (new Date(ngayDangInput) > new Date()) {
                    ngayDang.parent().append(
                        '<div class="text-danger fw-bold">Ngày đăng không vượt quá ngày hiện tại</div>');
                    return false;
                }
                return true;
            }

            function tenDangNhapNV() {
                const tenDangNhapNV = $('select[name="TenDangNhapNV"]');
                let tenDangNhapNVInput = tenDangNhapNV.val();
                tenDangNhapNV.parent().find('.text-danger').remove();
                if (!tenDangNhapNVInput) {
                    tenDangNhapNV.parent().append(
                        '<div class="text-danger fw-bold">Tên nhân viên không được bỏ trống</div>');
                    return false;
                }
                return true;
            }

            function image() {
                const image = $('#image');
                let imageInput = image[0];
                image.parent().find('div.text-danger').remove();

                if (!imageInput.files.length) {
                    return true;
                } else if (imageInput.files[0].size > 20 * 1024 * 1024) {
                    image.parent().append('<div class="text-danger fw-bold">Ảnh không vượt quá 20MB</div>');
                    return false;
                } else {
                    const file = imageInput.files[0];
                    const fileType = file['type'];
                    const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];
                    if (!validImageTypes.includes(fileType)) {
                        image.parent().append(
                            '<div class="text-danger fw-bold">Ảnh phải có định dạng JPG, PNG, GIF</div>');
                        return false;
                    }
                }
                return true;
            }

            function noiDung() {
                const noiDung = $('#Noi-Dung');
                let noiDungInput = noiDung.val();
                noiDung.parent().find('div.text-danger').remove();
                if (!noiDungInput) {
                    noiDung.parent().append(
                        '<div class="text-danger fw-bold">Nội dung tin tức không được bỏ trống</div>');
                    return false;
                } else if (noiDungInput.length < 50) {
                    noiDung.parent().append(
                        '<div class="text-danger fw-bold">Nội dung tin tức tối thiểu 50 ký tự</div>');
                    return false;
                } else if (!/^[a-zA-Z0-9 ]+$/.test(noiDungInput)) {
                    noiDung.parent().append(
                        '<div class="text-danger fw-bold">Nội dung tin tức không chứa ký tự đặc biệt</div>');
                    return false;
                }
                return true;
            }

            $('#form').submit(function(e) {
                e.preventDefault();
                let isValid = true;
                if (!tenSuKien()) {
                    isValid = false;
                }
                if (!loaiTinTuc()) {
                    isValid = false;
                }
                if (!tomTat()) {
                    isValid = false;
                }
                if (!ngayDang()) {
                    isValid = false;
                }
                if (!tenDangNhapNV()) {
                    isValid = false;
                }
                if (!image()) {
                    isValid = false;
                }
                if (!noiDung()) {
                    isValid = false;
                }
                if (isValid) {
                    $('#form').off('submit').submit();
                }
            });
        });

        // $(document).on('click', '#btn_submit', function(e) {
        //     e.preventDefault();


            // let isValid = true;

            // // Kiểm tra tên sự kiện
            // const tenSuKien = $('#ten-su-kien');
            // let tenSuKienInput = tenSuKien.val();
            // tenSuKien.parent().find('.text-danger').remove();
            // if (!tenSuKienInput) {
            //     tenSuKien.parent().append('<div class="text-danger fw-bold">Tên tin tức không được bỏ trống</div>');
            //     isValid = false;
            // } else if (tenSuKienInput.length > 255) {
            //     tenSuKien.parent().append('<div class="text-danger fw-bold">Tên tin tức không quá 255 ký tự</div>');
            //     isValid = false;
            // } else if (!/^[a-zA-Z0-9 ]+$/.test(tenSuKienInput)) {
            //     tenSuKien.parent().append(
            //         '<div class="text-danger fw-bold">Tên tin tức không chứa ký tự đặc biệt</div>');
            //     isValid = false;
            // }

            // // Kiểm tra loại tin tức
            // const loaiTinTuc = $('select[name="MaLoaiTinTuc"]');
            // let loaiTinTucInput = loaiTinTuc.val();
            // loaiTinTuc.parent().find('.text-danger').remove();
            // if (!loaiTinTucInput) {
            //     loaiTinTuc.parent().append(
            //         '<div class="text-danger fw-bold">Loại tin tức không được để trống</div>');
            //     isValid = false;
            // }

            // // Kiểm tra tóm tắt
            // const tomTat = $('#tom-tat');
            // let tomTatInput = tomTat.val();
            // tomTat.parent().find('.text-danger').remove();
            // if (!tomTatInput) {
            //     tomTat.parent().append('<div class="text-danger fw-bold">Tóm tắt không được bỏ trống</div>');
            //     isValid = false;
            // } else if (tomTatInput.length > 500) {
            //     tomTat.parent().append('<div class="text-danger fw-bold">Tóm tắt không quá 500 ký tự</div>');
            //     isValid = false;
            // } else if (!/^[a-zA-Z0-9 ]+$/.test(tomTatInput)) {
            //     tomTat.parent().append('<div class="text-danger fw-bold">Tóm tắt không chứa ký tự đặc biệt</div>');
            //     isValid = false;
            // }

            // // Kiểm tra ngày đăng
            // const ngayDang = $('#ngay-dang');
            // let ngayDangInput = ngayDang.val();
            // ngayDang.parent().find('.text-danger').remove();
            // if (!ngayDangInput) {
            //     ngayDang.parent().append('<div class="text-danger fw-bold">Ngày đăng không được bỏ trống</div>');
            //     isValid = false;
            // } else if (new Date(ngayDangInput) > new Date()) {
            //     ngayDang.parent().append(
            //         '<div class="text-danger fw-bold">Ngày đăng không vượt quá ngày hiện tại</div>');
            //     isValid = false;
            // }

            // // Kiểm tra tên nhân viên
            // const tenDangNhapNV = $('select[name="TenDangNhapNV"]');
            // let tenDangNhapNVInput = tenDangNhapNV.val();
            // tenDangNhapNV.parent().find('.text-danger').remove();
            // if (!tenDangNhapNVInput) {
            //     tenDangNhapNV.parent().append(
            //         '<div class="text-danger fw-bold">Tên nhân viên không được bỏ trống</div>');
            //     isValid = false;
            // }

            // // Kiểm tra ảnh
            // const image = $('#image');
            // let imageInput = image[0];
            // image.parent().find('div.text-danger').remove();

            // if (!imageInput.files.length) {
            //     isValid = true;
            // } else if (imageInput.files[0].size > 20 * 1024 * 1024) {
            //     image.parent().append('<div class="text-danger fw-bold">Ảnh không vượt quá 20MB</div>');
            //     isValid = false;
            // } else {
            //     const file = imageInput.files[0];
            //     const fileType = file['type'];
            //     const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];
            //     if (!validImageTypes.includes(fileType)) {
            //         image.parent().append(
            //             '<div class="text-danger fw-bold">Ảnh phải có định dạng JPG, PNG, GIF</div>');
            //         isValid = false;
            //     }
            // }

            // // Kiểm tra nội dung
            // const noiDung = $('#Noi-Dung');
            // let noiDungInput = noiDung.val();
            // noiDung.parent().find('div.text-danger').remove();
            // if (!noiDungInput) {
            //     noiDung.parent().append(
            //         '<div class="text-danger fw-bold">Nội dung tin tức không được bỏ trống</div>');
            //     isValid = false;
            // } else if (noiDungInput.length < 50) {
            //     noiDung.parent().append(
            //         '<div class="text-danger fw-bold">Nội dung tin tức tối thiểu 50 ký tự</div>');
            //     isValid = false;
            // } else if (!/^[a-zA-Z0-9 ]+$/.test(noiDungInput)) {
            //     noiDung.parent().append(
            //         '<div class="text-danger fw-bold">Nội dung tin tức không chứa ký tự đặc biệt</div>');
            //     isValid = false;
            // }

        // });
    </script>
@endsection
