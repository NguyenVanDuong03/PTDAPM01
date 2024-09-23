@extends('layouts.admin')
@section('link')
    <link href="{{ asset('asset/css/vendor.min.css') }}?v=1.0.0" rel="stylesheet" />
@endsection

@section('content')
    <main class="col-8 col-md-10 p-2 pt-5 d-flex flex-column justify-content-between">
        <div class="">

            <div class="d-flex flex-column gap-3 ">

                {{--code sinh ghế theo vòng lặp--}}
                <form action="{{route('datves.hienThiDoAn')}}" method="post" id="FormGhe">
                @csrf
                <div class="container">
                    <div class="d-flex gap-3 justify-content-center row ">
                        <?php
                            $i = 0;
                        ?>

                        @foreach($Ghes as $row)
                            @foreach($row as $element)
                                @if($element->TrangThai == 0)
                                    <button type="button" disabled class="btn-ghe col-2 btn-danger" onclick="toggleColor(this, {{$i}}, {{$element->GiaVe}})">{{$Key[$element->ViTriDay-1]}}{{$element->ViTriCot}}</button>
                                    <input type="hidden" name="MaGhe[]" id="input0{{ $i }}" value="x">
                                    <input type="hidden" name="" id="input1{{ $i }}" value="{{$element->MaGhe}}">
                                @else
                                    <button type="button" class="btn-ghe col-2" onclick="toggleColor(this, {{$i}}, {{$element->GiaVe}})">{{$Key[$element->ViTriDay-1]}}{{$element->ViTriCot}}</button>
                                    <input type="hidden" name="MaGhe[]" id="input0{{ $i }}" value="x">
                                    <input type="hidden" name="" id="input1{{ $i }}" value="{{$element->MaGhe}}">
                                @endif
                                <?php
                                    $i++;
                                ?>
                            @endforeach
                        @endforeach


                    </div>
                        {{--cần 1 input để lưu tổng giá vé đã đặt phục vụ cho controller lấy ra ở request và lưu vào session--}}
                        <input type="hidden" name="TongGiaVe" id="TongGiaVe" value="">
                </div>
                </form>


                {{-- BEGIN: Ghế đôi --}}
                {{--<div class="d-flex justify-content-center gap-3">
                    <button class="btn-ghe btn-ghe-doi" disabled="true">X</button>
                    <button class="btn-ghe btn-ghe-doi" value="1" onclick="toggleColor(this)">A15</button>
                    <button class="btn-ghe btn-ghe-doi" onclick="toggleColor(this)">A15</button>
                    <button class="btn-ghe btn-ghe-doi" value="2" onclick="toggleColor(this)">A15</button>
                </div>--}}
                {{-- END: Ghế đôi --}}

                <span class="text-danger text-center" id="msg-waning" style="display: none">Vui lòng chọn chỗ
                    ngồi!
                </span>
            </div>


            <div class="d-flex gap-5 justify-content-center mt-3">
                {{--<div class="d-flex gap-2 align-items-center">
                    <span class="btn-ghe vip d-block"></span>
                    Ghế VIP
                </div>--}}
                <div class="d-flex gap-2 align-items-center">
                    <span class="btn-ghe choose d-block"></span>
                    Ghế bạn chọn
                </div>
                <style>
                    .choose {
                        background-color: #77D6FF;
                    }
                </style>
                {{--<div class="d-flex gap-2 align-items-center">
                    <span class="btn-ghe d-block"></span>
                    Ghế Thường
                </div>--}}
                <div class="d-flex gap-2 align-items-center">
                    <button disabled="true" class="btn-ghe btn-danger "></button>
                    Ghế đã được đặt
                </div>
                {{--<div class="d-flex gap-2 align-items-center">
                    <span class="btn-ghe btn-ghe-doi d-block"></span>
                    Ghế Đôi
                </div>--}}
            </div>
        </div>
        {{-- BEGIN --}}
        <div class="d-flex gap-2 align-items-center justify-content-between rounded-2 mt-5 text-white px-3 py-2"
            style="background-color: #525252">
            <div class="">
                <a href="" class="d-flex flex-column gap-2 text-center">
                    <svg width="56" height="56" viewBox="0 0 56 56" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M28 0C12.5375 0 0 12.5375 0 28C0 43.4625 12.5375 56 28 56C43.4625 56 56 43.4625 56 28C56 12.5375 43.4625 0 28 0ZM34.5 19.8062C34.5 20.4437 34.1937 21.05 33.675 21.425L24.5875 28L33.675 34.575C34.1937 34.95 34.5 35.55 34.5 36.1937V39.125C34.5 39.5312 34.0375 39.7687 33.7062 39.5312L18.3312 28.4062C18.2674 28.3602 18.2153 28.2997 18.1794 28.2296C18.1436 28.1595 18.1248 28.0819 18.1248 28.0031C18.1248 27.9244 18.1436 27.8468 18.1794 27.7767C18.2153 27.7066 18.2674 27.646 18.3312 27.6L33.7062 16.475C33.781 16.4208 33.8693 16.3883 33.9613 16.3811C34.0534 16.374 34.1456 16.3925 34.2278 16.4345C34.31 16.4766 34.3789 16.5406 34.427 16.6194C34.475 16.6983 34.5003 16.7889 34.5 16.8813V19.8062Z"
                            fill="white" />
                    </svg>
                    <span class="fw-medium fs-5 text-white">BACK</span>
                </a>
            </div>
            <div class=" d-flex gap-3">
                <img src="images/anh.png" style="max-width: 120px" alt="" class="rounded">
                <div class="d-flex align-items-center">
                    <p class ="d-flex flex-column gap-2">
                        Tên phim: {{session('TenPhim')}}
                        <span>
                            Thời lượng: {{session('ThoiLuong')}} Phút
                        </span>
                    </p>
                </div>
            </div>
            <div class="">
                <p>
                    Xuất chiếu: {{session('GioChieu')}}
                    <br>
                    Ngày chiếu: {{session('NgayChieu')}}
                    <br>
                    Phòng chiếu: Phòng {{session('MaPhong')}}
                </p>
            </div>
            <div class=>
                <p>
                    <span class="d-flex gap-4">
                        Đồ ăn:
                        <span>0,00 VNĐ</span>
                    </span>
                    <span class="d-flex gap-4">
                        Đặt vé:
                        <span id="TongTienVe">
                            0,00 VNĐ
                        </span>
                    </span>
                    <span class="d-flex gap-4">
                        Tổng tiền:
                        <span id="TongTienChung">
                            0,00 VNĐ
                        </span>
                    </span>
                </p>
            </div>
            <div class="">
                <a onclick="submitForm()" href="#" class="d-flex flex-column gap-2 text-center">
                    <svg width="56" height="56" viewBox="0 0 56 56" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M28 56C43.4625 56 56 43.4625 56 28C56 12.5375 43.4625 0 28 0C12.5375 0 0 12.5375 0 28C0 43.4625 12.5375 56 28 56ZM21.5 36.1938C21.5 35.5562 21.8063 34.95 22.325 34.575L31.4125 28L22.325 21.425C21.8063 21.05 21.5 20.45 21.5 19.8063V16.875C21.5 16.4688 21.9625 16.2313 22.2938 16.4688L37.6688 27.5938C37.7326 27.6398 37.7847 27.7003 37.8206 27.7704C37.8564 27.8405 37.8752 27.9181 37.8752 27.9969C37.8752 28.0756 37.8564 28.1532 37.8206 28.2233C37.7847 28.2934 37.7326 28.354 37.6688 28.4L22.2938 39.525C22.219 39.5792 22.1307 39.6117 22.0387 39.6189C21.9466 39.626 21.8544 39.6075 21.7722 39.5655C21.69 39.5234 21.6211 39.4594 21.573 39.3806C21.525 39.3017 21.4997 39.2111 21.5 39.1187V36.1938Z"
                            fill="white" />
                    </svg>
                    <span class="fw-medium fs-5 text-white">NEXT</span>
                </a>
            </div>
        </div>
        {{-- END --}}
    </main>
@endsection

@section('script')
    <script src={{ asset('asset/js/vendor.min.js') }}></script>
    <script>
        var SoGheDaChon = 0;
        var TongTien = 0;
        function toggleColor(button, index, giaVe) {
            event.preventDefault();
            let isActive = button.classList.contains("active-ghe");
            let value = button.getAttribute('value');
            let tienVeElement = document.getElementById('tien-ve');

            if (isActive) {
                button.classList.remove("active-ghe");
                SoGheDaChon--;
                TongTien -= giaVe;
            } else {
                button.classList.add("active-ghe");
                SoGheDaChon++;
                TongTien += giaVe;
            }
            document.getElementById('TongTienChung').innerHTML = (TongTien + ' VNĐ');
            document.getElementById('TongTienVe').innerHTML = (TongTien + ' VNĐ');
            document.getElementById('TongGiaVe').value = TongTien;

            if (value) {
                let currentValue = parseInt(tienVeElement
                    .innerText);
                let newValue = currentValue + parseInt(
                    value);
                tienVeElement.innerText = newValue;
            }

            // lưu trạng thái có được chọn hay không để lưu mã ghế vào sesion
            var input0 = document.getElementById('input0' + index);
            var input1 = document.getElementById('input1' + index);
            if (input0.value === 'x') {
                input0.value = input1.value;
            } else {
                input0.value = 'x';
            }
        }
        function submitForm() {
            if(SoGheDaChon == 0){
                alert('Vui lòng chọn ghế');
            }else{
                var form = document.getElementById('FormGhe');
                form.submit();
            }

        }

        function hasActiveClass() {
            let buttons = document.querySelectorAll(".btn-ghe");
            let hasActive = false;
            let count = 0;
            buttons.forEach(function(button) {
                if (button.classList.contains("active-ghe")) {
                    count++;
                }
            });
            count === 0 ? hasActive : hasActive = true;
            return hasActive;
        }

        function getTotalValue() {
            let totalValue = 0;
            let buttons = document.querySelectorAll('.btn-ghe-doi');
            buttons.forEach(function(button) {
                let value = button.getAttribute('value');
                if (value) {
                    totalValue += parseInt(value);
                }
            });
            return totalValue;
        }



        document.getElementsByClassName("thanh-toan")[0].addEventListener("click", () => {
            let check = hasActiveClass();
            console.log(check)
            if (check) {
                let myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
                document.getElementById("msg-waning") ? document.getElementById("msg-waning").style.display =
                    "none" : null;
                myModal.show();
            } else {
                document.getElementById("msg-waning").style.display = "block";
                document.getElementsByClassName("thanh-toan")[0].removeAttribute("data-bs-toggle", "modal");
            }
        })
    </script>
@endsection
