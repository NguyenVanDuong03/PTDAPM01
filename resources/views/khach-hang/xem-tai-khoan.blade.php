@extends('layouts.customer')

@section('main')
<div class="container">
    <h3 class="text-center">Thông tin tài khoản</h3>
    <div class="row">
      <div class="col-md-6">
        <p>Tên người dùng: {{$account->TenKhachHang}}</p>
        <p>Email: {{$account->TenDangNhapKH}}</p>
      </div>
      <div style="width: 3px !important; min-height:400px; background-color: aqua; margin-bottom: 10px;"></div>
      <div class="col-md-5">
        <h4>Thông tin bổ sung</h4>
        <p>Ngày sinh: {{$account->NgaySinh}}</p>
        <p>Điện thoại: {{$account->SDT}}</p>
        <div>
            <a class="btn btn-success" href="{{route('khachhangs.edit')}}">Chỉnh sửa</a>
        </div>
      </div>
    </div>
  </div>

@endsection