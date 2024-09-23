@extends('layouts.employee')
@section('content')
<div class="col-8 col-md-10 ">
    <div class="">
        <div class="fs-4">Quy định</div>
        <div class="d-flex justify-content-between py-3">
            <div class="d-flex gap-2 px-2 py-1">
            </div>
            <div class="">
            </div>
        </div>
    </div>
    <div class="">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tiêu đề</th>
                    <th scope="col">Nội dung</th>
                </tr>
            </thead>
            <tbody>
                <!-- {{$stt = 1}} -->
                @foreach($quydinhs as $item)
                <tr>
                    <th scope="row">{{$stt++}}</th>
                    <td>
                        <div class="">
                            <a href="{{ route('quydinhs.show',$item->MaQuyDinh) }}" class="text-black">
                                {{$item->TieuDe}}
                            </a>
                        </div>
                    </td>
                    <td>
                        <div class="">
                            <a href="" class="text-black">
                                {{$item->NoiDung}}
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