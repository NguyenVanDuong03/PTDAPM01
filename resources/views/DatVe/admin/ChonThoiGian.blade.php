@extends("layouts.admin")
@section('content')
<div class="col-8 col-md-10">
    <h2 class="text-center">Chọn thời gian</h2>
    <div class="container" style="min-height: 400px;">
        <div class="row mt-2">
            @foreach($NgayChieus as $NCh)
                <a  href="{{route('datves.hienThoiGian', ['MaPhim' => session('MaPhim'), 'NgayChieu' => $NCh->NgayChieu])}}"
                     class="px-1 col-2 btn {{$NCh->NgayChieu==$NgayChieu?'btn-success':'btn-light'}}">{{$NCh->NgayChieu}}
                </a>
            @endforeach
        </div>
        <div style="background-color: black; margin: 10px; height: 2px"></div>
        <div class="row mt-2">
            @foreach($GioChieus as $GCh)
                <a href="{{route('datves.hienThongTinPhong', ['NgayChieu' => $NgayChieu, 'GioChieu' => $GCh->GioChieu])}}" class="px-1 col-2 btn btn-light}">{{$GCh->GioChieu}}</a>
            @endforeach
        </div>
    </div>
</div>

@endsection
