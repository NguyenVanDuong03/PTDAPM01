@extends('layouts.employee')
@section('content')
<!-- BEGIN: Content -->
<div class="col-8 col-md-10 ">
    <h3>Trang chủ</h3>
    <div class="row">

        <!-- BEGIN: Table Movie Is Showing  -->
        <div class="col-12 col-md-6 gap-3 d-flex flex-column ">
            <h4>Phim đang chiếu</h4>
            <table class="table border">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên phim</th>
                        <th scope="col">Ngày công chiếu</th>
                        <th scope="col">Thời lượng (phút)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($phimDangChieus as $key => $phim)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$phim->TenPhim}}</td>
                        <td>{{$phim->NgayCongChieu}}</td>
                        <td>{{$phim->ThoiLuong}}</td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
        <!-- END: Table Movie Is Showing  -->

        <!-- BEGIN: Upcoming Movie -->
        <div class="col-12 col-md-6 gap-3 d-flex flex-column ps-md-0">
            <h4>Phim sắp chiếu</h4>
            <table class="table border">
                <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên phim</th>
                            <th scope="col">Ngày công chiếu</th>
                            <th scope="col">Thời lượng (phút)</th>
                        </tr>
                </thead>
                <tbody>
                    @foreach($phimSapChieus as $key => $phim)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$phim->TenPhim}}</td>
                        <td>{{$phim->NgayCongChieu}}</td>
                        <td>{{$phim->ThoiLuong}}</td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
        <!-- END: Upcoming Movie -->
    </div>
<!-- END: Content -->

</div>
@endsection