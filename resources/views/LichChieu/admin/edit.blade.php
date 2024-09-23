@extends('layouts.admin')

@section('content')
<div class="col-8 col-md-10">
    <h3>
        {{-- Thêm đường dẫn qua lại index --}}
        <a href="{{route('lichchieus.index')}}" class="text-black">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
            </svg>
        </a>
        Sửa thông tin lịch chiếu
    </h3>
    <form action="{{route('lichchieus.updatecustom')}}" method="POST" class="d-grid gap-3 w-md-50 mx-auto">
        @csrf
        @method('PUT')
        <table class="table table-bordered">
            <thead>

            </thead>
            <tbody>
                <tr class="text-center">
                    <a href="">
                        <td scope="row" colspan="2">Cinema_0{{$infolichchieu->MaPhong}}</td>
                        <input type="hidden" value="{{$infolichchieu->maphong}}" name="MaPhong" id="">
                        <td scope="row" colspan="2">{{$infolichchieu->NgayChieu}}</td>
                    </a>
                </tr>
                @foreach($infolichchieu->LichChieus as $lch)
                <tr class="text-center">
                    <input type="hidden" name="MaLichChieu[]" value="{{$lch->MaLichChieu}}" id="">
                    <td>
                        <select class="form-select form-select-sm" aria-label="Small select example" name="MaPhim[]">
                            <option value="1">Lựa chọn</option>
                            @foreach($phims as $phim)
                            <option value="{{$phim->MaPhim}}" {{$lch->getPhim()!=null && $phim->TenPhim == $lch->getPhim()->TenPhim ? 'selected' : '' }}>{{$phim->TenPhim}}</option>
                            @endforeach
                            <option value="1">None</option>
                        </select>
                    </td>
                    <td>
                        <input value="{{$lch->GioChieu}}" type="time" name="ThoiGian[]" placeholder="Thời gian chiếu phim">
                    </td>
                </tr>
                @endforeach
                <button type="submit">Lưu</button>
            </tbody>
        </table>


    </form>
</div>
@endsection