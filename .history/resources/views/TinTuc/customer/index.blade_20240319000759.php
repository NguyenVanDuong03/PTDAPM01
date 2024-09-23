@extends('layouts.customer')
@section('link')
<link href="{{ asset('asset/css/tintuc.css') }}" rel="stylesheet" />
@endsection

@section('main')
<!-- BEGIN: Main -->
<main class="bg-color">
    <div class="bg-color">
        <div class="row bg">
            @foreach($tintucs as $item)
            <!-- Thêm các card tin tức khác -->
            <div class="col-md-3">
                <div class="card bg">
                    <img src="{{$item->Anh}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h6 class="card-title">{{$item->TenSuKien}}</h6>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- Thêm các card tin tức khác -->
        </div>
        <!-- Lặp lại các hàng nếu cần -->
    </div>
</main>

<!-- END: Main -->
@endsection