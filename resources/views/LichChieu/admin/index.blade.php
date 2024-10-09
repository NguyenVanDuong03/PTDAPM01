@extends('layouts.admin')

@section('content')
    <div class=" col-8 col-md-10 ">
        <div class="">
            <div class="fs-4"> Quản lý lịch chiếu</div>
            {{-- <div class="d-flex justify-content-between py-3">
            <div class="">
                <a href="{{route('lichchieus.create')}}">
                    <button class="px-2 py-1 active-admin-aside text-white border-0 d-flex align-items-center gap-1">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 5V19M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Thêm
                    </button>
                </a>
            </div>
        </div> --}}
        </div>
        <div class="d-flex flex-column gap-2 col-12 col-md-6">
            <form id="findInfoWithDate" action="{{ route('lichchieus.index') }}" method="get">
                @csrf
                {{-- <input value="{{ $ngayDang }}" type="date" name="NgayDang" id="selectDate" onchange="checkAndSubmitForm()"> --}}
                <input value="" type="date" name="NgayDang" id="selectDate" onchange="checkAndSubmitForm()">
                <div class="text-danger fw-bold text-error mt-1"></div>
            </form>
        </div>
        <div class="row">
            @foreach ($infoLichChieus as $item)
                <div class="">

                    <div class="">
                        <div class="d-flex gap-2 align-items-center my-2">
                            <form method="POST" action="{{ route('lichchieus.create_form') }}">
                                @csrf
                                <button type="submit" class="rounded border border-2 phong-chieu"
                                    style="background-color: transparent; border-color: #E0E0E0">Phòng
                                    {{ $item->MaPhong }}</button>

                                <input type="hidden" name="MaPhong" value="{{ $item->MaPhong }}">
                                <input type="hidden" name="NgayChieu" value="{{ $item->NgayChieu }}">
                                {{-- <button type="submit" class="rounded border border-2" style="background-color: transparent; border-color: #E0E0E0">
                                <button class="d-flex align-items-center gap-1 px-2 py-1" style="color: #2A2A2A">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#2A2A2A" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                    </svg>
                                    Sửa
                                </button>
                            </button> --}}

                            </form>
                        </div>
                    </div>
                    <div class="">
                        {{-- BEGIN: một hàng trong bảng --}}
                        <div class="table-container" style="max-height: 200px; overflow-y: auto;">
                            <table class="table table-bordered">
                                <tbody>
                                    @foreach ($item->lichChieus as $lichchieu)
                                        @if ($lichchieu->getPhim() != null)
                                            <tr>
                                                <td class="px-3 py-2 w-25 text-center" style="transform: translateY(10%)">
                                                    {{ $lichchieu->getPhim()->TenPhim }}
                                                </td>
                                                <td class="px-3 py-2 w-75">
                                                    <div class="list-time d-flex gap-2">
                                                        {{ $lichchieu->GioChieu }}
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{-- END: một hàng trong bảng --}}
                    </div>
                </div>
                {{-- END: một bảng --}}
            @endforeach
        </div>
        @if (session('mes'))
            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div class="toast show bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <strong class="me-auto">Thông báo</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        {{ session('mes') }}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            if ($('#selectDate').val().trim() === '') {
                $('.phong-chieu').attr('disabled', true);
            }
        });

        $('#selectDate').change(function() {
            if (new Date(this.value) <= new Date(new Date().setDate(new Date().getDate() - 1))) {
                $('.text-error').text('Ngày chiếu không được là ngày trong quá khứ');
                $('.phong-chieu').attr('disabled', true);
            } else {
                $('.text-error').text('');
                $('.phong-chieu').attr('disabled', false);

                function checkAndSubmitForm() {
                    var selectDate = $('#selectDate').val();
                    $('#findInfoWithDate').submit();
                }
            }
        });

        
    </script>
@endsection
