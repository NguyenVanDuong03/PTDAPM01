@extends('layouts.admin')
@section('content')
    <div class="col-8 col-md-10">
        <div class="mb-4">
            {{-- Thêm đường dẫn qua lại index --}}
            <a href="{{ route('phims.index') }}">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 12H5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M12 19L5 12L12 5" stroke="black" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </a>
        </div>
        <h3>Thêm phim</h3>
        <form id="form" method="POST" enctype="multipart/form-data" action="{{ route('phims.store') }}"
            class="d-grid gap-3 w-md-50 mx-auto">
            @csrf
            <div class="flex-column d-flex gap-2">
                <label for="TenPhim" class="">Tên phim*</label>
                <input type="text" id="TenPhim" name="TenPhim" class="py-1 px-2 rounded border border-1"
                    placeholder="Nhập tên phim">
                @error('TenPhim')
                    <div class="text-danger fw-bold">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex-column d-flex gap-2">
                <label for="Anhphim" class="">Ảnh phim*</label>
                <input type="file" id="Anhphim" name="image" class="py-1 px-2 rounded border border-1">
                @error('image')
                    <div class="text-danger fw-bold">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex-column d-flex gap-2">
                <label for="MaTheLoai" class="">Thể loại phim*</label>
                <select class="form-control" id="MaTheLoai" name="MaTheLoai">
                    <option value="" disabled selected>Thể loại</option>
                    @foreach ($theloais as $theloai)
                        <option value="{{ $theloai->MaTheLoai }}">{{ $theloai->TenTheLoai }}</option>
                    @endforeach
                </select>
                @error('MaTheLoai')
                    <div class="text-danger fw-bold">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex-column d-flex gap-2">
                <label for="MaNCC" class="">Nhà cung cấp*</label>
                <select class="form-control" id="MaNCC" name="MaNCC">
                    <option value="" disabled selected>Nhà cung cấp</option>
                    @foreach ($nhacungcaps as $nhacungcap)
                        @if ($nhacungcap->TinhTrang == 'Đang hợp tác')
                            <option value="{{ $nhacungcap->MaNCC }}">{{ $nhacungcap->TenNCC }}</option>
                        @endif
                    @endforeach
                </select>
                @error('MaNCC')
                    <div class="text-danger fw-bold">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex-column d-flex gap-2">
                <label for="ThoiLuong" class="">Thời lượng*</label>
                <input type="text" id="ThoiLuong" name="ThoiLuong" class="py-1 px-2 rounded border border-1"
                    placeholder="Nhập thời lượng">
                @error('ThoiLuong')
                    <div class="text-danger fw-bold">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex-column d-flex gap-2">
                <label for="NgayCongChieu" class="">Ngày công chiếu*</label>
                <input type="date" id="NgayCongChieu" name="NgayCongChieu" class="py-1 px-2 rounded border border-1"
                    placeholder="Chọn ngày công chiếu" value="">
                @error('NgayCongChieu')
                    <div class="text-danger fw-bold">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex-column d-flex gap-2">
                <label for="TrangThai" class="">Trạng thái*</label>
                <select class="form-control" id="TrangThai" name="TrangThai">
                    <option value="" disabled selected>Trạng thái</option>
                    <option value="Đang chiếu">Đang chiếu</option>
                    <option value="Sắp chiếu">Sắp chiếu</option>
                </select>
                @error('TrangThai')
                    <div class="text-danger fw-bold">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex-column d-flex gap-2">
                <label for="TomTat" class="">Tóm tắt</label>
                <input type="text" id="TomTat" name="TomTat" class="py-1 px-2 rounded border border-1"
                    placeholder="Nhập mô tả">
                @error('TomTat')
                    <div class="text-danger fw-bold">{{ $message }}</div>
                @enderror
            </div>
            <div class="py-2 rounded text-center mt-5" style="background-color: #5F6D7E">
                <button id="btn_submit" type="submit" class="border-0 bg-transparent  text-white">
                    Thêm mới phim
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
        $(document).ready(function() {

            function isFilmNameDuplicate(filmName) {
                let isDuplicate = false;
                $.ajax({
                    url: '{{ route('phims.checkDuplicate') }}',
                    type: 'POST',
                    async: false,
                    data: {
                        _token: '{{ csrf_token() }}',
                        TenPhim: filmName
                    },
                    success: function(response) {
                        isDuplicate = response.isDuplicate;
                    }
                });
                return isDuplicate;
            }

            function film() {
                const film = $('#TenPhim');
                const filmInput = film.val();
                film.parent().find('.text-danger').remove();

                if (!filmInput) {
                    film.parent().append('<div class="text-danger fw-bold">Tên phim không được bỏ trống</div>');
                    return false;
                } else if (filmInput.length > 100) {
                    film.parent().append('<div class="text-danger fw-bold">Tên phim không được quá 100 ký tự</div>');
                    return false;
                } else if (!/^[\p{L}\p{N}\s]+$/u.test(filmInput)) {
                    film.parent().append(
                        '<div class="text-danger fw-bold">Tên phim không được chứa ký tự đặc biệt</div>');
                    return false;
                } else {
                    if (isFilmNameDuplicate(filmInput)) {
                        film.parent().append('<div class="text-danger fw-bold">Tên phim đã tồn tại</div>');
                        return false;
                    }
                }
            }

            function image() {
                const image = $('#Anhphim');
                let imageInput = image[0];
                image.parent().find('div.text-danger').remove();

                if (!imageInput.files.length) {
                    image.parent().append('<div class="text-danger fw-bold">Ảnh phim không được bỏ trống</div>');
                    return false;
                } else if (imageInput.files[0].size > 5 * 1024 * 1024) {
                    image.parent().append('<div class="text-danger fw-bold">Ảnh phim vượt quá 5MB</div>');
                    return false;
                } else {
                    const file = imageInput.files[0];
                    const fileType = file['type'];
                    const validImageTypes = ['image/jpeg', 'image/png'];
                    if (!validImageTypes.includes(fileType)) {
                        image.parent().append(
                            '<div class="text-danger fw-bold">Ảnh phải có định dạng JPEG, PNG.</div>');
                        return false;
                    }
                }
            }

            function category() {
                const category = $('#MaTheLoai');
                const categoryInput = category.val();
                category.parent().find('.text-danger').remove();

                if (!categoryInput) {
                    category.parent().append('<div class="text-danger fw-bold">Tên thể loại không được bỏ trống</div>');
                    return false;
                }
            }

            function supplier() {
                const supplier = $('#MaNCC');
                const supplierInput = supplier.val();
                supplier.parent().find('.text-danger').remove();

                if (!supplierInput) {
                    supplier.parent().append(
                        '<div class="text-danger fw-bold">Tên nhà cung cấp không được bỏ trống</div>');
                    return false;
                }
            }

            function duration() {
                const duration = $('#ThoiLuong');
                const durationInput = duration.val();
                duration.parent().find('.text-danger').remove();

                if (!durationInput) {
                    duration.parent().append(
                        '<div class="text-danger fw-bold">Thời lượng phim không được bỏ trống</div>');
                    return false;
                } else if (durationInput < 0) {
                    duration.parent().append('<div class="text-danger fw-bold">Thời lượng phim phải là số dương</div>');
                    return false;
                } else if (durationInput > 300) {
                    duration.parent().append('<div class="text-danger fw-bold">Thời lượng phim quá 300 phút</div>');
                    return false;
                } else if (!/^\d+$/.test(durationInput)) {
                    duration.parent().append(
                        '<div class="text-danger fw-bold">Thời lượng phim không được chứa ký tự đặc biệt và chữ</div>'
                        );
                    return false;
                }
            }

            function releaseDate() {
                const releaseDate = $('#NgayCongChieu');
                const releaseDateInput = releaseDate.val();
                releaseDate.parent().find('.text-danger').remove();

                if (!releaseDateInput) {
                    releaseDate.parent().append(
                        '<div class="text-danger fw-bold">Ngày công chiếu không được bỏ trống</div>');
                    return false;
                } else {
                    const currentDate = new Date();
                    const selectedDate = new Date(releaseDateInput);
                    if (selectedDate < currentDate) {
                        releaseDate.parent().append(
                            '<div class="text-danger fw-bold">Ngày công chiếu không được trong quá khứ</div>');
                        return false;
                    }
                }
            }

            function status() {
                const status = $('#TrangThai');
                const statusInput = status.val();
                status.parent().find('.text-danger').remove();

                if (!statusInput) {
                    status.parent().append('<div class="text-danger fw-bold">Trạng thái không được bỏ trống</div>');
                    return false;
                }
            }

            function description() {
                const description = $('#TomTat');
                const descriptionInput = description.val();
                description.parent().find('.text-danger').remove();

                if (!descriptionInput) {
                    description.parent().append('<div class="text-danger fw-bold">Tóm tắt không được bỏ trống</div>');
                    return false;
                } else if (descriptionInput.length < 50) {
                    description.parent().append(
                    '<div class="text-danger fw-bold">Tóm tắt phim không đủ 50 ký tự</div>');
                    return false;
                } else if (descriptionInput.length > 1000) {
                    description.parent().append(
                        '<div class="text-danger fw-bold">Tóm tắt phim vượt quá 1000 ký tự</div>');
                    return false;
                }
            }

            $('#form').submit(function(event) {
                event.preventDefault();
                let isValid = true;

                if (!film()) {
                    isValid = false;
                }

                if (!image()) {
                    isValid = false;
                }

                if (!category()) {
                    isValid = false;
                }

                if (!supplier()) {
                    isValid = false;
                }

                if (!duration()) {
                    isValid = false;
                }

                if (!releaseDate()) {
                    isValid = false;
                }

                if (!status()) {
                    isValid = false;
                }

                if (!description()) {
                    isValid = false;
                }

                if (isValid) {
                    this.submit();
                }
            });
        })


        // $(document).on('click', '#btn_submit', function(event) {
        //     event.preventDefault();
        //     let isValid = true;

        //     // Kiểm tra tên phim
        //     const film = $('#TenPhim');
        //     const filmInput = film.val();
        //     film.parent().find('.text-danger').remove();

        //     if (!filmInput) {
        //         film.parent().append('<div class="text-danger fw-bold">Tên phim không được bỏ trống</div>');
        //         isValid = false;
        //     } else if (filmInput.length > 100) {
        //         film.parent().append('<div class="text-danger fw-bold">Tên phim không được quá 100 ký tự</div>');
        //         isValid = false;
        //     } else if (!/^[\p{L}\p{N}\s]+$/u.test(filmInput)) {
        //         film.parent().append(
        //             '<div class="text-danger fw-bold">Tên phim không được chứa ký tự đặc biệt</div>');
        //         isValid = false;
        //     } else {
        //         if (isFilmNameDuplicate(filmInput)) {
        //             film.parent().append('<div class="text-danger fw-bold">Tên phim đã tồn tại</div>');
        //             isValid = false;
        //         }
        //     }

            // function isFilmNameDuplicate(filmName) {
            //     let isDuplicate = false;
            //     $.ajax({
            //         url: '{{ route('phims.checkDuplicate') }}',
            //         type: 'POST',
            //         async: false,
            //         data: {
            //             _token: '{{ csrf_token() }}',
            //             TenPhim: filmName
            //         },
            //         success: function(response) {
            //             isDuplicate = response.isDuplicate;
            //         }
            //     });
            //     return isDuplicate;
            // }

        //     // Kiểm tra ảnh phim
        //     const image = $('#Anhphim');
        //     let imageInput = image[0];
        //     image.parent().find('div.text-danger').remove();

        //     if (!imageInput.files.length) {
        //         image.parent().append('<div class="text-danger fw-bold">Ảnh phim không được bỏ trống</div>');
        //         isValid = false;
        //     } else if (imageInput.files[0].size > 5 * 1024 * 1024) {
        //         image.parent().append('<div class="text-danger fw-bold">Ảnh phim vượt quá 5MB</div>');
        //         isValid = false;
        //     } else {
        //         const file = imageInput.files[0];
        //         const fileType = file['type'];
        //         const validImageTypes = ['image/jpeg', 'image/png'];
        //         if (!validImageTypes.includes(fileType)) {
        //             image.parent().append(
        //                 '<div class="text-danger fw-bold">Ảnh phải có định dạng JPEG, PNG.</div>');
        //             isValid = false;
        //         }
        //     }

        //     // Kiểm tra thể loại
        //     const category = $('#MaTheLoai');
        //     const categoryInput = category.val();
        //     category.parent().find('.text-danger').remove();

        //     if (!categoryInput) {
        //         category.parent().append('<div class="text-danger fw-bold">Tên thể loại không được bỏ trống</div>');
        //         isValid = false;
        //     }

        //     // Kiểm tra nhà cung cấp
        //     const supplier = $('#MaNCC');
        //     const supplierInput = supplier.val();
        //     supplier.parent().find('.text-danger').remove();

        //     if (!supplierInput) {
        //         supplier.parent().append(
        //             '<div class="text-danger fw-bold">Tên nhà cung cấp không được bỏ trống</div>');
        //         isValid = false;
        //     }

        //     // Kiểm tra thời lượng
        //     const duration = $('#ThoiLuong');
        //     const durationInput = duration.val();
        //     duration.parent().find('.text-danger').remove();

        //     if (!durationInput) {
        //         duration.parent().append(
        //             '<div class="text-danger fw-bold">Thời lượng phim không được bỏ trống</div>');
        //         isValid = false;
        //     } else if (durationInput < 0) {
        //         duration.parent().append('<div class="text-danger fw-bold">Thời lượng phim phải là số dương</div>');
        //         isValid = false;
        //     } else if (durationInput > 300) {
        //         duration.parent().append('<div class="text-danger fw-bold">Thời lượng phim quá 300 phút</div>');
        //         isValid = false;
        //     } else if (!/^\d+$/.test(durationInput)) {
        //         duration.parent().append(
        //             '<div class="text-danger fw-bold">Thời lượng phim không được chứa ký tự đặc biệt và chữ</div>'
        //             );
        //         isValid = false;
        //     }

        //     // Kiểm tra ngày công chiếu
        //     const releaseDate = $('#NgayCongChieu');
        //     const releaseDateInput = releaseDate.val();
        //     releaseDate.parent().find('.text-danger').remove();

        //     if (!releaseDateInput) {
        //         releaseDate.parent().append(
        //             '<div class="text-danger fw-bold">Ngày công chiếu không được bỏ trống</div>');
        //         isValid = false;
        //     } else {
        //         const currentDate = new Date();
        //         const selectedDate = new Date(releaseDateInput);
        //         if (selectedDate < currentDate) {
        //             releaseDate.parent().append(
        //                 '<div class="text-danger fw-bold">Ngày công chiếu không được trong quá khứ</div>');
        //             isValid = false;
        //         }
        //     }

        //     // Kiểm tra trạng thái
        //     const status = $('#TrangThai');
        //     const statusInput = status.val();
        //     status.parent().find('.text-danger').remove();

        //     if (!statusInput) {
        //         status.parent().append('<div class="text-danger fw-bold">Trạng thái không được bỏ trống</div>');
        //         isValid = false;
        //     }

        //     // Kiểm tra tóm tắt
        //     const description = $('#TomTat');
        //     const descriptionInput = description.val();
        //     description.parent().find('.text-danger').remove();

        //     if (!descriptionInput) {
        //         description.parent().append('<div class="text-danger fw-bold">Tóm tắt không được bỏ trống</div>');
        //         isValid = false;
        //     } else if (descriptionInput.length < 50) {
        //         description.parent().append(
        //         '<div class="text-danger fw-bold">Tóm tắt phim không đủ 50 ký tự</div>');
        //         isValid = false;
        //     } else if (descriptionInput.length > 1000) {
        //         description.parent().append(
        //             '<div class="text-danger fw-bold">Tóm tắt phim vượt quá 1000 ký tự</div>');
        //         isValid = false;
        //     }

        //     if (isValid) {
        //         this.submit();
        //     }
        // });
    </script>
@endsection
