@extends('layouts.employee')
@section('content')
    <div class="col-8 col-md-10">
        <form action="{{ route('datves.xuatVeXong') }}" method="post" class="mt-5">
            @csrf
            <div class="d-flex gap-3 align-items-center mb-3">
                <label for="mahoadon">Nhập mã hóa đơn:</label>
                <input type="text" id="mahoadon" class="rounded-3 pe-5 py-1 border ps-2 w-25 w-md-50" name="MaHoaDon">
            </div>
            <div class="d-flex justify-content-around">
                <button type="submit" class="px-4 py-2 rounded-4 text-black border-0"
                    style="background-color: #BEADAD">Xuất
                    vé</button>
            </div>
        </form>
    </div>
@endsection
@if (session()->has('mesXuaHoaDon'))
    <?php $value = session('mesXuaHoaDon'); ?>
    <div id="toast">
        <div class="message">
            <div class="message__body">
                <h3 class="message__title mb-0">{{ $value }}</h3>
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
    <?php session()->forget('mesXuaHoaDon'); ?>
@endif
