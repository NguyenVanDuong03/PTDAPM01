@extends('layouts.customer')

@section('link')
    <link href="{{ asset('asset/css/vendor.min.css') }}" rel="stylesheet" />
@endsection

@section('main')
    <main>
        <div class="">
            <h3 class="text-center mt-3">Sửa thông tin cá nhân</h3>
            <form action="{{route('khachhangs.update')}}" method="post" class="d-grid gap-3 w-md-50 m-auto">
                @csrf 
                <div class="flex-column d-flex gap-2">
                    <label for="">Họ và tên</label>
                    <input value="{{$account->TenKhachHang}}" name="TenKhachHang" type="text" placeholder="Họ tên của bạn" class="py-1 px-2 rounded border border-1">
                </div>
                <div class="flex-column d-flex gap-2">
                    <label for="">Ngày sinh</label>
                    <input  value="{{$account->NgaySinh}}" name="NgaySinh" type="date" style="color: #787676" class="py-1 px-2 rounded border border-1">
                </div>
                <div class="flex-column d-flex gap-2">
                    <label for="">Số điện thoại</label>
                    <input value="{{$account->SDT}}"  name="SDT" type="text" placeholder="Số điện thoại" class="py-1 px-2 rounded border border-1">
                </div>
                <div class="flex-column d-flex gap-2">
                    <label for="">Giới tính</label>
                    <select name="GioiTinh" id="">
                        <option {{$account->GioiTinh=="Nam"? 'selected':''}} value="Nam">Nam</option>
                        <option {{$account->GioiTinh=="Nữ"? 'selected':''}} value="Nữ">Nữ</option>
                        <option {{$account->GioiTinh=="Giới tính khác"? 'selected':''}} value="Giới tính khác">Giới tính khác</option>
                    </select>
                </div>
                <button type="submit" class="mt-3 mb-5 w-100 border rounded py-2 text-white"
                    style="background-color: #5F6D7E">Sửa</button>
            </form>
        </div>
    </main>
@endsection
