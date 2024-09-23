@extends('layouts.admin')

@section('content')
    <div class="col-8 col-md-10 ">
        <div class="">
            <div class="fs-4">Nhân viên</div>
            <div class="d-flex justify-content-between py-3">
                <div class="border border-2 border-dark rounded-4 d-flex gap-2 px-2 py-1">
                    <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20.7094 18.7931L14.217 12.3006C15.2245 10.9981 15.7695 9.40561 15.7695 7.73062C15.7695 5.72563 14.987 3.84564 13.572 2.42814C12.157 1.01065 10.272 0.230652 8.2695 0.230652C6.26701 0.230652 4.38202 1.01315 2.96702 2.42814C1.54953 3.84314 0.769531 5.72563 0.769531 7.73062C0.769531 9.73311 1.55203 11.6181 2.96702 13.0331C4.38202 14.4506 6.26451 15.2306 8.2695 15.2306C9.94449 15.2306 11.5345 14.6856 12.837 13.6806L19.3295 20.1706C19.3485 20.1896 19.3711 20.2047 19.396 20.215C19.4209 20.2253 19.4475 20.2307 19.4744 20.2307C19.5014 20.2307 19.528 20.2253 19.5529 20.215C19.5778 20.2047 19.6004 20.1896 19.6194 20.1706L20.7094 19.0831C20.7285 19.064 20.7436 19.0414 20.7539 19.0165C20.7642 18.9917 20.7695 18.965 20.7695 18.9381C20.7695 18.9111 20.7642 18.8845 20.7539 18.8596C20.7436 18.8347 20.7285 18.8121 20.7094 18.7931ZM12.2295 11.6906C11.1695 12.7481 9.76449 13.3306 8.2695 13.3306C6.77451 13.3306 5.36951 12.7481 4.30952 11.6906C3.25202 10.6306 2.66952 9.22561 2.66952 7.73062C2.66952 6.23563 3.25202 4.82813 4.30952 3.77064C5.36951 2.71314 6.77451 2.13064 8.2695 2.13064C9.76449 2.13064 11.172 2.71064 12.2295 3.77064C13.287 4.83063 13.8695 6.23563 13.8695 7.73062C13.8695 9.22561 13.287 10.6331 12.2295 11.6906Z"
                            fill="#1A1A1A" />
                    </svg>
                    <form method="post" action="{{ route('nhanviens.search') }}">
                        @csrf
                        <input class="border-0" type="text" name="name" onkeydown="submitForm(event)" placeholder="Tìm kiếm nhân viên">
                        <button hidden type="submit">Submit</button>
                    </form>

                </div>
                <div class="">
                    <a href="{{route('nhanviens.create')}}">
                        <button class="px-2 py-1 active-admin-aside text-white border-0 d-flex align-items-center gap-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
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
                        <th scope="col">Tên nhân viên</th>
                        <th scope="col">Ngày sinh</th>
                        <th scope="col">Giới tính</th>
                        <th scope="col">Chức vụ</th>
                        <th scope="col">Sự kiện</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($nhanViens as $key => $item)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>
                            <div class="">
                                <a href="" class="text-black">
                                    {{$item->TenNhanVien}}
                                </a>
                            </div>
                        </td>
                        <td>
                            <div class="">
                            {{$item->NgaySinh}}
                            </div>
                        </td>
                        <td>
                            <div class="">
                            {{$item->GioiTinh}}
                            </div>
                        </td>
                        <td>
                            <div class="">
                            {{$item->ViTri}}
                            </div>
                        </td>
                        <td class="d-flex aligh-items-center gap-3">
                            <button class="rounded">
                                <a href="{{route('nhanviens.edit', $item->id)}}" class="d-flex align-items-center gap-1 px-2 text-black">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
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
                                        Bạn có muốn xóa
                                    </li>
                                    <li class="d-flex justify-content-end gap-1 mt-2">
                                        <button class="bg-secondary px-1 border-0 text-white rounded">
                                            Không
                                        </button>
                                        <form action="{{route('nhanviens.destroy', $item->id)}}" method="post"> 
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-primary px-1 border-0 rounded">
                                                <a class="text-white">
                                                    Xóa
                                                </a>
                                            </button>
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
    <!-- modal inform -->

   
    <div id="myDialog" style="display: none;" class="px-5 py-3 rounded-3">
        <h4 class="text-primary fw-bold fs-4">Thông báo</h4>
        <p class="text-success">{{ session('mes') }}</p>
        <button id="confirmButton" class="float-end rounded-2">Đồng ý</button>
    </div>
    <style>
        #myDialog {
            position: fixed;
            width: 500px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #ffffff;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        #confirmButton {
        padding: 10px 20px;
        background: #007bff;
        color: #ffffff;
        border: none;
        cursor: pointer;
        }
    </style>
    @if(session('mes'))
        <script>
            var dialog = document.getElementById("myDialog");
            var confirmButton = document.getElementById("confirmButton");

            dialog.style.display = "block";
            confirmButton.addEventListener("click", function() {
                dialog.style.display = "none";
            });
            // alert("{{ session('Success') }}")
        </script>
    @endif
@endsection
@section('script')
<script>
    function submitForm(event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Ngăn chặn sự kiện mặc định của phím Enter
            event.target.form.submit(); // Submit form
        }
    }
</script>
@endsection
