@extends('layouts.admin')
@section('content')
    <div style="min-height: 400px;">
        <h4 class="text-center text-success text-bold">Cảm ơn bạn đã tin tưởng dịch vụ của chúng tôi, yêu bạn rất nhiều <3333 </h4>
    </div>
    <p class="text-center text-success fw-bold fs-1 mt-3">Tổng giá trị đơn hàng: {{session('TongTienHoaDon')}}</p>
@endsection 