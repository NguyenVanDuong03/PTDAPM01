@extends('layouts.admin')
@section('content')
<!-- BEGIN: Table -->
<div class="col-8 col-md-10 ">
    <div class="">
        <div class="fs-4">Phim</div>
        <div class="d-flex justify-content-between py-3">
            <div class="">
                <a href="{{ route('phims.create') }}">
                    <button class="px-2 py-1 active-admin-aside text-white border-0 d-flex align-items-center gap-1">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 5V19M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        Thêm
                    </button>
                </a>
            </div>
        </div>
    </div>
    <div class="">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên phim</th>
                    <th scope="col">Ảnh</th>
                    <th scope="col">Thể loại</th>
                    <th scope="col">Nhà cung cấp</th>
                    <th scope="col">Thời lượng</th>
                    <th scope="col">Ngày công chiếu</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Tóm tắt</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($phims as $phim)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        {{ $phim->TenPhim }}
                    </td>
                    <td><img src="{{ $phim->DuongDan }}" alt="{{ $phim->TenPhim }}" style="max-width: 100px;"
                            class="img-fluid"></td>
                    <td>
                        {{ $phim->theloai->TenTheLoai }}
                    </td>
                    <td>
                        {{ $phim->nhacungcap->TenNCC }}
                    </td>
                    <td>
                        {{ $phim->ThoiLuong }}
                    </td>
                    <td>
                        {{ $phim->NgayCongChieu}}
                    </td>
                    <td>
                        {{ $phim->TrangThai}}
                    </td>
                    <td>
                        {{ $phim->MoTa}}
                    </td>
                    <td class="d-flex aligh-items-center gap-3">
                        <button class="rounded">
                            <a href="{{ route('phims.edit', $phim->MaPhim) }}"
                                class="d-flex align-items-center gap-1 px-2 text-black">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                </svg>
                                Sửa
                            </a>
                        </button>

                        <div class="btn-group dropup">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash" viewBox="0 0 16 16">
                                    <path
                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                    <path
                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                </svg>
                                Xóa
                            </button>
                            <ul class="dropdown-menu px-2">
                                <li>
                                    <!-- Thêm ID -->
                                    Vui lòng xác nhận có xoá không?
                                </li>
                                <li class="d-flex justify-content-end">
                                    <button class="bg-secondary px-1 border-0 text-white rounded">
                                        Không
                                    </button>
                                    <form action="{{ route('phims.destroy', $phim->MaPhim) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a class="text-white"><button type="submit"
                                                class="bg-primary px-1 border-0 rounded">Có</button></a>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- END: Table -->
@endsection
@if (session('mess_success'))
    <div id="toast">
        <div class="message message--success">
            <div class="message__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#47d864"
                    class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                    <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </svg>
            </div>
            <div class="message__body">
                <h3 class="message__title mb-0">{{ session('mess_success') }}</h3>

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
@endif
