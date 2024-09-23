@extends('layouts.customer')
@section('link')
    <link href="{{ asset('asset/css/vendor.min.css') }}?v=1.0.0" rel="stylesheet" />
@endsection
@section('main')
    <h2 class="text-center">Chọn giờ chiếu</h2>
    <div class="container">
        <div class="d-flex flex-wrap mt-2 gap-4">
            @foreach ($NgayChieus as $NCh)
                <a href="{{ route('datves.hienThoiGian', ['MaPhim' => session('MaPhim'), 'NgayChieu' => $NCh->NgayChieu]) }}"
                    class="px-1 col-2 text-center btn {{ $NCh->NgayChieu == $NgayChieu ? 'btn-success' : 'btn-light' }}">{{ $NCh->NgayChieu }}
                </a>
            @endforeach
        </div>
        <hr class="bg-black m-2 border border-1">
        <div class="row mb-5">
            <div class="col-4 text-center">
                {{-- ảnh phim --}}
                <img src="{{asset("$Phim->DuongDan")}}" alt="anhPhim" style="max-width: 400px">
                {{-- Tên phim --}}
                <h4>{{$Phim->TenPhim}}</h4>
            </div>
            <div class="col-8">
                <div class="d-flex flex-wrap mt-2 gap-4 ">
                    @foreach ($GioChieus as $GCh)
                        <a href="{{ route('datves.hienThongTinPhong', ['NgayChieu' => $NgayChieu, 'GioChieu' => $GCh->GioChieu]) }}"
                            class="px-1 col-2 text-center btn btn-light}">{{ $GCh->GioChieu }}</a>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
@endsection
