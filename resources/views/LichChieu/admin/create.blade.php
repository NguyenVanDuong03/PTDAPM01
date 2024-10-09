@extends('layouts.admin')

@section('content')
    <!-- BEGIN: Form -->
    <div class="col-8 col-md-10">
        <a href="{{ route('lichchieus.index') }}">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 12H5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M12 19L5 12L12 5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>
        <h3 class="text-center">Chỉnh sửa thông tin lịch chiếu</h3>
        {{-- <form id="hidden-form"  action="{{route('lichchieus.create_form')}}" method="post">
            @csrf
            <div class="flex-column d-flex gap-2">
                <select id="select" onchange="checkAndSubmitForm()" class="form-select form-select-sm" aria-label="Small select example" name="MaPhong">
                    <!-- <option selected>Tên thể loại đồ ăn</option> -->
                    <option value="">Chọn phòng</option>
                    @foreach ($phongchieus as $item)
                    <option {{session('bat-dau-them-lich')&&$item->MaPhong==$MaPhong?'selected':''}} value="{{$item->MaPhong}}">Cinema_0{{$item->MaPhong}}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex-column d-flex gap-2">
                <label for="the-loai-do-an">Chọn thời gian</label>
                <input value="{{session('bat-dau-them-lich')?$NgayChieu:''}}" name="NgayChieu" type="date" id="date-input" onchange="checkAndSubmitForm()">
            </div>
        </form> --}}
        <div class="d-flex justify-content-center mb-3">
            <span>Phòng: {{ $MaPhong }}</span>
            <span style="width: 100px;"></span>
            <span>Ngày: {{ $NgayChieu }}</span>
        </div>
        @if (session('bat-dau-them-lich'))
            <form id="storeForm" action="{{ route('lichchieus.store') }}" class="d-grid gap-3 w-md-50 mx-auto"
                method="POST">
                @csrf
                {{-- Lưu lại ngày chiếu và mã phòng --}}
                <input type="hidden" value="{{ $NgayChieu }}" name="NgayChieu">
                <input type="hidden" value="{{ $MaPhong }}" name="MaPhong">

                @if ($infoLichChieu->LichChieus != null)
                    <div class="row">
                        @foreach ($infoLichChieu->LichChieus as $lch)
                            <input type="hidden" name="MaLichChieu[]" value="{{ $lch->MaLichChieu }}" id="">
                            <div class="col-3 flex-column d-flex gap-2">
                                <label class="">Thời gian*</label>
                                <input value="{{ $lch->GioChieu }}" name="GioChieu[]" type="time"
                                    class="py-1 px-2 rounded border border-1">
                                @error('ThoiGianBatDau')
                                    <div class="text-danger fw-bold">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="flex-column d-flex gap-2 col-3">
                                <label>Tên phim*</label>
                                <select class="form-select form-select-sm" aria-label="Small select example"
                                    name="MaPhim[]">
                                    <option value="-1" disabled selected>Lựa chọn</option>
                                    @foreach ($phims as $item)
                                        <option {{ $item->MaPhim == $lch->MaPhim ? 'selected' : '' }}
                                            value="{{ $item->MaPhim }}">{{ $item->TenPhim }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                        {{-- @for ($i = 0; $i < 2 - count($infoLichChieu->LichChieus); $i++) --}}
                        <input type="hidden" name="MaLichChieu[]" value="-1" id="">
                        <div class="col-3 flex-column d-flex">
                            <label for="ten-do-an" class="gap-2">Thời gian*</label>
                            <input id="GioChieu" name="GioChieu[]" type="time" class="py-1 px-2 rounded border border-1"
                                placeholder="Chọn thời gian chiếu phim">
                            @error('GioChieu')
                                <div class="text-danger fw-bold">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="flex-column d-flex gap-2 col-3">
                            <label for="the-loai-do-an">Tên phim*</label>
                            <select id="MaPhim" class="form-select form-select-sm" aria-label="Small select example"
                                name="MaPhim[]">
                                <!-- <option selected>Tên thể loại đồ ăn</option> -->
                                <option value="-1" disabled selected>Lựa chọn</option>
                                @foreach ($phims as $item)
                                    <option value="{{ $item->MaPhim }}">{{ $item->TenPhim }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- @endfor --}}
                    </div>
                @else
                    <div class="row">
                        {{-- @for ($i = 0; $i < 2; $i++) --}}
                        <input type="hidden" name="MaLichChieu[]" value="-1" id="">
                        <div class="col-3 flex-column d-flex">
                            <label for="ten-do-an" class="gap-2">Thời gian*</label>
                            <input value="00:00" name="GioChieu[]" type="time" class="py-1 px-2 rounded border border-1"
                                placeholder="Chọn thời gian chiếu phim">
                            @error('GioChieu')
                                <div class="text-danger fw-bold">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="flex-column d-flex gap-2 col-3">
                            <label for="the-loai-do-an">Tên phim*</label>
                            <select class="form-select form-select-sm" aria-label="Small select example" name="MaPhim[]">
                                <!-- <option selected>Tên thể loại đồ ăn</option> -->
                                <option value="-1" disabled selected>Lựa chọn</option>
                                @foreach ($phims as $item)
                                    <option value="{{ $item->MaPhim }}">{{ $item->TenPhim }}</option>
                                @endforeach
                            </select>
                            @error('MaPhim[]')
                                <div class="text-danger fw-bold">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- @endfor --}}
                    </div>
                @endif
                <div class="py-2 rounded text-center mt-5" style="background-color: #5F6D7E">
                    <button id="btn_submit" type="submit" class="border-0 bg-transparent  text-white">
                        Lưu lại
                    </button>
                </div>
            </form>
        @endif
        {{ session()->forget('bat-dau-them-lich') }}

        @if (session('error'))
            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div class="toast show bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <strong class="me-auto">Lỗi</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        {{ session('error') }}
                    </div>
                </div>
            </div>
        @endif
    </div>
    <!-- END: Form -->
@endsection
@section('script')
    <script>
        //     {{-- function checkAndSubmitForm() {
    //     var selectValue = document.getElementById('select').value;
    //     var dateInputValue = document.getElementById('date-input').value;

    //     if (selectValue !== '' && dateInputValue !== '') {
    //         document.getElementById('hidden-form').submit();
    //     }
    // }
    // $(document).ready(function() {
    //     function onFormSubmit(e){
    //         e.preventDefault(); // Ngăn chặn việc gửi form thông qua phương thức mặc định

    //         var formData = $(this).serialize(); // Lấy dữ liệu form

    //         $.ajax({
    //             url: '{{ route("lichchieus.store") }}', // Đường dẫn route đã được định nghĩa
    //             type: 'POST',
    //             data: formData,
    //             success: function(response) {
    //                 // Xử lý phản hồi từ server sau khi lưu form thành công
    //                 console.log(response);
    //             },
    //             error: function(xhr) {
    //                 // Xử lý lỗi trong trường hợp request không thành công
    //                 console.log(xhr.responseText);
    //             }
    //         });
    //     }
    // }); --}}
    </script>

    <script>
        $(document).ready(function() {

            function isDuplicate(arr) {
                const isDuplicate = arr.some((item, idx) => arr.indexOf(item) !== idx);
                if (isDuplicate) {
                    gioChieu.parent().append(
                        '<div class="text-danger fw-bold">Giờ chiếu không được trùng lặp với giờ chiếu của cùng một phim trong cùng một phòng chiếu vào ngày đó.</div>'
                    );
                }
                return isDuplicate;
            }

            function gioChieu() {
                const gioChieu = $('#GioChieu');
                let gioChieuInput = gioChieu.val();
                const gioChieuArr = [];
                gioChieu.parent().find('.text-danger').remove();

                if (!gioChieuInput) {
                    gioChieu.parent().append(
                        '<div class="text-danger fw-bold">Giờ chiếu không được bỏ trống.</div>');
                    return false;
                } else {
                    gioChieuInput = gioChieuInput.split(':');
                    const gioChieuHour = parseInt(gioChieuInput[0], 10);
                    const gioChieuMinute = parseInt(gioChieuInput[1], 10);

                    if (gioChieuHour < 8 || gioChieuHour > 22 || (gioChieuHour === 22 && gioChieuMinute > 0)) {
                        gioChieu.parent().append(
                            '<div class="text-danger fw-bold">Giờ chiếu phải nằm trong khoảng hoạt động của rạp  từ 8:00 đến 23:00.</div>'
                        );
                        return false;
                    } else if (isDuplicate(gioChieuArr)) {
                        return false;
                    }
                }
                return true;
            }

            function maPhim() {
                const maPhim = $('#MaPhim');
                const maPhimValue = maPhim.val();
                maPhim.parent().find('.text-danger').remove();

                if (!maPhimValue) {
                    maPhim.parent().append('<div class="text-danger fw-bold">Tên phim không được bỏ trống.</div>');
                    return false;
                }
                return true;
            }

            $(document).on('click', '#btn_submit', function(e) {
                e.preventDefault();
                let isValid = true;

                if (!gioChieu()) {
                    isValid = false;
                }

                if (!maPhim()) {
                    isValid = false;
                }

                if (isValid) {
                    $('#storeForm').submit();
                }
            });


        })

        // $(document).on('click', '#btn_submit', function(e) {
        //     e.preventDefault();
        //     let isValid = true;

        //     // Kiểm tra thời gian
        //     const gioChieu = $('#GioChieu');
        //     let gioChieuInput = gioChieu.val();
        //     gioChieu.parent().find('.text-danger').remove();
        //     const gioChieuArr = [];

        //     if (!gioChieuInput) {
        //         gioChieu.parent().append('<div class="text-danger fw-bold">Giờ chiếu không được bỏ trống.</div>');
        //         isValid = false;
        //     } else {
        //         gioChieuInput = gioChieuInput.split(':');
        //         const gioChieuHour = parseInt(gioChieuInput[0], 10);
        //         const gioChieuMinute = parseInt(gioChieuInput[1], 10);

        //         if (gioChieuHour < 8 || gioChieuHour > 22 || (gioChieuHour === 22 && gioChieuMinute > 0)) {
        //             gioChieu.parent().append(
        //                 '<div class="text-danger fw-bold">Giờ chiếu phải nằm trong khoảng hoạt động của rạp  từ 8:00 đến 23:00.</div>'
        //             );
        //             isValid = false;
        //         } else if (isDuplicate(gioChieuArr)) {
        //             isValid = false;
        //         }
        //     }

        // Hàm kiểm tra trùng lặp
        // function isDuplicate(arr) {
        //     const isDuplicate = arr.some((item, idx) => arr.indexOf(item) !== idx);
        //     if (isDuplicate) {
        //         gioChieu.parent().append(
        //             '<div class="text-danger fw-bold">Giờ chiếu không được trùng lặp với giờ chiếu của cùng một phim trong cùng một phòng chiếu vào ngày đó.</div>'
        //         );
        //     }
        //     return isDuplicate;
        // }

        //     // Kiểm tra tên phim
        //     const maPhim = $('#MaPhim');
        //     const maPhimValue = maPhim.val();
        //     maPhim.parent().find('.text-danger').remove();

        //     if (!maPhimValue) {
        //         maPhim.parent().append('<div class="text-danger fw-bold">Tên phim không được bỏ trống.</div>');
        //         isValid = false;
        //     }

        //     if (isValid) {
        //         $('#storeForm').submit();
        //     }
        // });
    </script>
@endsection
