@extends('layouts.admin')

@section('content')

<!-- END: Aside -->

<!-- BEGIN: Table -->
<div class="col-8 col-md-10 ">
    <div class="">

        <div class="fs-4">Lịch sử giá đồ ăn</div>
        <div class="d-flex justify-content-between py-3">
            <div class=" rounded-4 d-flex gap-2 px-2 py-1">

            </div>
            <div class="">
                <!-- <a href="{{route('lichsugiadoans.create')}}">
                                <button class="px-2 py-1 active-admin-aside text-white border-0 d-flex align-items-center gap-1">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 5V19M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    Thêm
                                </button>
                            </a> -->
            </div>
        </div>
    </div>
    <div class="">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tên đồ ăn</th>
                    <th scope="col">Thời gian tạo</th>
                    <th scope="col">Giá</th>

                </tr>
            </thead>
            <tbody>
                <!-- {{$stt=1}} -->
                @foreach($lichsugiadoans as $item)
                <tr>
                    <th scope="row">{{$stt++}}</th>
                    <td>
                        <div class="">
                            {{$item->getDoAn()->TenDoAn}}
                            {{-- {{$item->MaDoAn}} --}}
                        </div>
                    </td>
                    <td>
                        <div class="">{{$item->ThoiGianTao}}</div>
                    </td>
                    <td>
                        <div class="">
                            {{-- BEGIN:Giá tiền --}}
                            {{$item->Gia}}
                            {{-- END: Giá tiền --}}
                            VNĐ
                        </div>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection