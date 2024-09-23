@extends('layouts.admin')

@section('content')
<div class="col-8 col-md-10 ">
    <div class="">
        <div class="fs-4">Lịch sử giá vé</div>
    </div>
    <div class="">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Loại ghế ngồi</th>
                    <th scope="col">Giá vé</th>
                    <th scope="col">Thời gian tạo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lichsugiaves as $item)
                <tr>
                    <td>
                        <div class="">
                            <a href="" class="text-black">
                                {{$loop->iteration}}
                            </a>
                        </div>
                    </td>
                    <td>
                        <div class="">
                            <a href="" class="text-black">
                                {{$item->MaLoaiGhe}}
                            </a>
                        </div>
                    </td>
                    <td>
                        <div class="">
                            <a href="" class="text-black">
                                {{$item->GiaVe}}
                            </a>
                        </div>
                    </td>
                    <td>
                        <div class="">
                            <a href="" class="text-black">
                                {{$item->ThoiGianTao}}
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

