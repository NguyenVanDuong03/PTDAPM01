@extends('layouts.admin')

@section('content')
    <div class="col-8 col-md-10">
        <a href="{{ route('phongchieus.index') }}">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 12H5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M12 19L5 12L12 5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>
        <h3 class="pt-3">
            Thêm phòng chiếu
        </h3>
        <form id="form" method="POST" action="{{ route('phongchieus.store') }}" class="d-grid gap-3 w-md-50 mx-auto">
            @csrf

            <div class="d-flex flex-column gap-2">
                <label for="TenPhong">Tên phòng*</label>
                <input type="text" id="TenPhong" name="TenPhong" placeholder="Nhập tên phòng"
                    class="py-1 px-2 rounded border border-1">
                @error('TenPhong')
                    <div class="text-danger fw-bold">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex flex-column gap-2">
                <label for="so-luong-ghe">Số lượng ghế*</label>
                <input type="text" id="so-luong-ghe" name="SoLuongGhe" placeholder="Nhập số lượng ghế"
                    class="py-1 px-2 rounded border border-1">
                @error('SoLuongGhe')
                    <div class="text-danger fw-bold">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex flex-column gap-2">
                <label for="tinh-trang">Tình trạng ghế*</label>
                <select id="tinh-trang" class="form-select form-select-sm" name="TinhTrang"
                    aria-label="Small select example">
                    <option value="" disabled selected>Chọn tình trạng ghế</option>
                    <option value="Bình thường">Bình thường</option>
                    <option value="Ngưng sử dụng">Tạm ngưng</option>
                    <option value="Tạm ngưng">Ngừng sử dụng</option>
                </select>
                @error('TinhTrang')
                    <div class="text-danger fw-bold">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex flex-column gap-2">
                <label for="LoaiPhong">Loại phòng*</label>
                <select id="LoaiPhong" class="form-select form-select-sm" name="LoaiPhong"
                    aria-label="Small select example">
                    <option value="" disabled selected>Chọn loại phòng</option>
                    @foreach ($loaiphongs as $item)
                        <option value="{{ $item->MaLoaiPhong }}">{{ $item->TenLoaiPhong }}</option>
                    @endforeach
                </select>
                @error('LoaiPhong')
                    <div class="text-danger fw-bold">{{ $message }}</div>
                @enderror
            </div>
            <div class="rounded text-center my-5" style="background-color: #5F6D7E">
                <button id="btn_submit" type="submit" class="border-0 bg-transparent py-2 w-100 text-white">
                    Thêm phòng chiếu
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
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            // Kiểm tra tên phòng
            fucntion roomName() {
                const roomName = $('#TenPhong');
                let roomNameVal = roomName.val();
                roomName.parent().find('.text-danger').remove();

                if (!roomNameVal) {
                    roomName.parent().append(
                        '<div class="text-danger fw-bold">Tên phòng không được bỏ trống</div>');
                    return = false;
                } else if (roomNameVal.length > 20) {
                    roomName.parent().append(
                        '<div class="text-danger fw-bold">Tên phòng không được vượt quá 20 ký tự</div>');
                    return = false;
                } else if (!/^[\p{L}\p{N}\s]+$/u.test(roomNameVal)) {
                    roomName.parent().append(
                        '<div class="text-danger fw-bold">Tên phòng chỉ gồm chữ cái, số và khoảng trắng</div>'
                    );
                    return = false;
                }
                else {
                    if (isRoomDuplicate(roomNameVal)) {
                        roomName.parent().append('<div class="text-danger fw-bold">Tên phòng đã tồn tại</div>');
                        return = false;
                    }
                }
                return true;
            }


            function isRoomDuplicate(roomNameVal) {
                let isDuplicate = false;
                $.ajax({
                    url: '{{ route('phongchieus.checkDuplicate') }}',
                    type: 'POST',
                    async: false,
                    data: {
                        _token: '{{ csrf_token() }}',
                        TenPhong: roomNameVal
                    },
                    success: function(response) {
                        isDublicate = response.isDublicate;
                    }
                });
                return isDuplicate;
            }

            // Kiểm tra số lượng ghế
            function soLuongGhe() {
                const soLuongGhe = $('#so-luong-ghe');
                let soLuongGheVal = soLuongGhe.val();
                soLuongGhe.parent().find('.text-danger').remove();

                if (!soLuongGheVal) {
                    soLuongGhe.parent().append(
                        '<div class="text-danger fw-bold">Số lượng ghế không được bỏ trống</div>');
                    return = false;
                } else if (!/^[1-9]\d*$/.test(soLuongGheVal)) {
                    soLuongGhe.parent().append(
                        '<div class="text-danger fw-bold">Số lượng ghế chỉ được phép là số nguyên lớn hơn 0</div>'
                        );
                    return = false;
                } else if (soLuongGheVal < 1) {
                    soLuongGhe.parent().append(
                        '<div class="text-danger fw-bold">Số lượng ghế phải là số nguyên lớn hơn 0</div>');
                    return = false;
                } else if (soLuongGheVal > 50) {
                    soLuongGhe.parent().append('<div class="text-danger fw-bold">Số lượng ghế tối đa là 50</div>');
                    return = false;
                }
                return true;
            }

            // Kiểm tra tình trạng
            function tinhTrang() {
                const tinhTrang = $('select[name="TinhTrang"]');
                let tinhTrangVal = tinhTrang.val();
                tinhTrang.parent().find('.text-danger').remove();

                if (!tinhTrangVal) {
                    tinhTrang.parent().append(
                        '<div class="text-danger fw-bold">Vui lòng chọn tình trạng của phòng</div>');
                    return = false;
                }
                return true;
            }

            // Kiểm tra loại phòng
            function loaiPhong() {
                const loaiPhong = $('select[name="LoaiPhong"]');
                let loaiPhongVal = loaiPhong.val();
                loaiPhong.parent().find('.text-danger').remove();

                if (!loaiPhongVal) {
                    loaiPhong.parent().append(
                        '<div class="text-danger fw-bold">Loại phòng không được bỏ trống</div>');
                    return = false;
                }
                return true;
            }

            // Kiểm tra dữ liệu trước khi submit
            $('#form').submit(function(e) {
                e.preventDefault();
                let isvalid = true;

                if (!roomName()) {
                    isvalid = false;
                }
                if (!soLuongGhe()) {
                    isvalid = false;
                }
                if (!tinhTrang()) {
                    isvalid = false;
                }
                if (!loaiPhong()) {
                    isvalid = false;
                }
                if (isvalid) {
                    $('#form').off('submit').submit();
                }
            });
        });

        // $(document).on('click', '#btn_submit', function(e) {
        //     e.preventDefault();
        //     let isvalid = true;

        //     // kiểm tra tên phòng
        //     const roomName = $('#TenPhong');
        //     let roomNameVal = roomName.val();
        //     roomName.parent().find('.text-danger').remove();

        //     if (!roomNameVal) {
        //         roomName.parent().append('<div class="text-danger fw-bold">Tên phòng không được bỏ trống</div>');
        //         isvalid = false;
        //     } else if (roomNameVal.length > 20) {
        //         roomName.parent().append(
        //             '<div class="text-danger fw-bold">Tên phòng không được vượt quá 20 ký tự</div>');
        //         isvalid = false;
        //     } else if (!/^[\p{L}\p{N}\s]+$/u.test(roomNameVal)) {
        //         roomName.parent().append(
        //             '<div class="text-danger fw-bold">Tên phòng chỉ gồm chữ cái, số và khoảng trắng</div>');
        //         isvalid = false;
        //     } else {
        //         if (isRoomDuplicate(roomNameVal)) {
        //             roomName.parent().append('<div class="text-danger fw-bold">Tên phòng đã tồn tại</div>');
        //             isvalid = false;
        //         }
        //     }

        // function isRoomDuplicate(roomNameVal) {
        //     let isDuplicate = false;
        //     $.ajax({
        //         url: '{{ route('phongchieus.checkDuplicate') }}',
        //         type: 'POST',
        //         async: false,
        //         data: {
        //             _token: '{{ csrf_token() }}',
        //             TenPhong: roomNameVal
        //         },
        //         success: function(response) {
        //             isDublicate = response.isDublicate;
        //         }
        //     });
        //     return isDuplicate;
        // }

        //     // kiểm tra số lượng ghế
        //     const soLuongGhe = $('#so-luong-ghe');
        //     let soLuongGheVal = soLuongGhe.val();
        //     soLuongGhe.parent().find('.text-danger').remove();

        //     if (!soLuongGheVal) {
        //         soLuongGhe.parent().append(
        //             '<div class="text-danger fw-bold">Số lượng ghế không được bỏ trống</div>');
        //         isvalid = false;
        //     } else if (!/^[1-9]\d*$/.test(soLuongGheVal)) {
        //         soLuongGhe.parent().append(
        //             '<div class="text-danger fw-bold">Số lượng ghế chỉ được phép là số nguyên lớn hơn 0</div>');
        //         isvalid = false;
        //     } else if (soLuongGheVal < 1) {
        //         soLuongGhe.parent().append(
        //             '<div class="text-danger fw-bold">Số lượng ghế phải là số nguyên lớn hơn 0</div>');
        //         isvalid = false;
        //     } else if (soLuongGheVal > 50) {
        //         soLuongGhe.parent().append('<div class="text-danger fw-bold">Số lượng ghế tối đa là 50</div>');
        //         isvalid = false;
        //     }

        //     // kiểm tra tình trạng
        //     const tinhTrang = $('#tinh-trang');
        //     let tinhTrangVal = tinhTrang.val();
        //     tinhTrang.parent().find('.text-danger').remove();

        //     if (!tinhTrangVal) {
        //         tinhTrang.parent().append(
        //             '<div class="text-danger fw-bold">Vui lòng chọn tình trạng của phòng</div>');
        //         isvalid = false;
        //     }

        //     // kiểm tra loại phòng
        //     const loaiPhong = $('#LoaiPhong');
        //     let loaiPhongVal = loaiPhong.val();
        //     loaiPhong.parent().find('.text-danger').remove();

        //     if (!loaiPhongVal) {
        //         loaiPhong.parent().append('<div class="text-danger fw-bold">Loại phòng không được bỏ trống</div>');
        //         isvalid = false;
        //     }

        //     if (isvalid) {
        //         this.submit();
        //     }

        // });
    </script>
@endsection
