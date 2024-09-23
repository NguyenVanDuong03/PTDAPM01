@extends('layouts.customer.layout')
@section('link')
    <link href="{{ asset('asset/css/giave.css') }}" rel="stylesheet" />
@endsection

@section('main')
    <main class="bg-color">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="text-light title text-center">
                        <h4>Sự Hài Lòng Của Các Bạn Là Sự Thành Công Của Chúng Tôi</h4>
                    </div>
                    <h6 class="text-light">Giá vé 2D</h6>
                    <table class="table">
                        <thead class="bg-light">
                            <tr>
                                <th colspan="2" class="text-center" style="border-radius: 15px 0px 0px 0px;">Thời
                                    Gian</th>
                                <th colspan="2" class="text-center">T2 đến T5</th>
                                <th colspan="3" class="text-center" style="border-radius: 0px 15px 0px 0px;">T6, T7,
                                    CN và ngày Lễ</th>
                            </tr>
                        </thead>
                        <tbody class=" text-light">
                            <tr>
                                <td></td>
                                <td class="text-center">Ghế thường</td>
                                <td class="text-center text-warning">Ghế vip</td>
                                <td class="text-center text-danger">Ghế đôi</td>
                                <td class="text-center">Ghế thường</td>
                                <td class="text-center text-warning">Ghế vip</td>
                                <td class="text-center text-danger">Ghế đôi</td>
                            </tr>
                            <tr>
                                <td>Trước 12h</td>
                                <td class="text-center">55.000 VND</td>
                                <td class="text-center text-warning">65.000 VND</td>
                                <td class="text-center text-danger">140.000 VND</td>
                                <td class="text-center">55.000 VND</td>
                                <td class="text-center text-warning">65.000 VND</td>
                                <td class="text-center text-danger">140.000 VND</td>
                            </tr>
                            <tr>
                                <td>Từ 12 đến trước 17h</td>
                                <td class="text-center">55.000 VND</td>
                                <td class="text-center text-warning">65.000 VND</td>
                                <td class="text-center text-danger">140.000 VND</td>
                                <td class="text-center">55.000 VND</td>
                                <td class="text-center text-warning">65.000 VND</td>
                                <td class="text-center text-danger">140.000 VND</td>
                            </tr>
                            <tr>
                                <td>Từ 17 đến trước 23h</td>
                                <td class="text-center">55.000 VND</td>
                                <td class="text-center text-warning">65.000 VND</td>
                                <td class="text-center text-danger">140.000 VND</td>
                                <td class="text-center">55.000 VND</td>
                                <td class="text-center text-warning">65.000 VND</td>
                                <td class="text-center text-danger">140.000 VND</td>
                            </tr>
                            <tr>
                                <td>Sau 23h</td>
                                <td class="text-center">55.000 VND</td>
                                <td class="text-center text-warning">65.000 VND</td>
                                <td class="text-center text-danger">140.000 VND</td>
                                <td class="text-center">55.000 VND</td>
                                <td class="text-center text-warning">65.000 VND</td>
                                <td class="text-center text-danger">140.000 VND</td>
                            </tr>
                            <!-- Thêm các dòng khác tùy ý -->
                        </tbody>
                    </table>
                    <br>
                    <h6 class="text-light">Giá vé 3D</h6>
                    <table class="table">
                        <thead class="bg-light">
                            <tr>
                                <th colspan="2" style="border-radius: 15px 0px 0px 0px;">Thời Gian</th>
                                <th colspan="2">T2 đến T5</th>
                                <th colspan="3" style="border-radius: 0px 15px 0px 0px;">T6, T7, CN và ngày Lễ</th>
                            </tr>
                        </thead>
                        <tbody class=" text-light">
                            <tr>
                                <td></td>
                                <td class="text-center">Ghế thường</td>
                                <td class="text-center text-warning">Ghế vip</td>
                                <td class="text-center text-danger">Ghế đôi</td>
                                <td class="text-center">Ghế thường</td>
                                <td class="text-center text-warning">Ghế vip</td>
                                <td class="text-center text-danger">Ghế đôi</td>
                            </tr>
                            <tr>
                                <td>Trước 12h</td>
                                <td class="text-center">55.000 VND</td>
                                <td class="text-center text-warning">65.000 VND</td>
                                <td class="text-center text-danger">140.000 VND</td>
                                <td class="text-center">55.000 VND</td>
                                <td class="text-center text-warning">65.000 VND</td>
                                <td class="text-center text-danger">140.000 VND</td>
                            </tr>
                            <tr>
                                <td>Từ 12 đến trước 17h</td>
                                <td class="text-center">55.000 VND</td>
                                <td class="text-center text-warning">65.000 VND</td>
                                <td class="text-center text-danger">140.000 VND</td>
                                <td class="text-center">55.000 VND</td>
                                <td class="text-center text-warning">65.000 VND</td>
                                <td class="text-center text-danger">140.000 VND</td>
                            </tr>
                            <tr>
                                <td>Từ 17 đến trước 23h</td>
                                <td class="text-center">55.000 VND</td>
                                <td class="text-center text-warning">65.000 VND</td>
                                <td class="text-center text-danger">140.000 VND</td>
                                <td class="text-center">55.000 VND</td>
                                <td class="text-center text-warning">65.000 VND</td>
                                <td class="text-center text-danger">140.000 VND</td>
                            </tr>
                            <tr>
                                <td>Sau 23h</td>
                                <td class="text-center">55.000 VND</td>
                                <td class="text-center text-warning">65.000 VND</td>
                                <td class="text-center text-danger">140.000 VND</td>
                                <td class="text-center">55.000 VND</td>
                                <td class="text-center text-warning">65.000 VND</td>
                                <td class="text-center text-danger">140.000 VND</td>
                            </tr>
                            <!-- Thêm các dòng khác tùy ý -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
