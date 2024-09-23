@extends('layouts.customer')
@section('link')
<link href="{{ asset('asset/css/doan.css') }}" rel="stylesheet" />
@endsection

@section('main')
<main class="bg-color">
    <div class="content">
        <div class=" title text-center">
            <h3>Sự Hài Lòng Của Các Bạn Là Sự Thành Công Của Chúng Tôi</h3>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6 container">
                        <img src="./images/6.png" class="card-img-top" alt="...">
                    </div>
                    <div class="col-md-6 d-flex align-items-center">
                        <div>
                            <h5 class="card-title text-danger">Combo Gia Đình</h5>
                            <p class="card-text">2 bắp, 4 pep nhỏ, 1 khoai lắc</p>
                            <p class="card-text">100.000 VND</p>
                            <a href="#" class="btn mt-auto gradient-background-btn" data-toggle="modal" data-target="#foodModal">Đặt Đồ Ăn</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <img src="./images/6.png" class="card-img-top" alt="...">
                    </div>
                    <div class="col-md-6 d-flex align-items-center">
                        <div>
                            <h5 class="card-title text-danger">Combo Cặp Đôi</h5>
                            <p class="card-text">1 bắp, 2 pep nhỏ</p>
                            <p class="card-text">50.000 VND</p>
                            <a href="#" class="btn mt-auto gradient-background-btn" data-toggle="modal" data-target="#foodModal">Đặt Đồ Ăn</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <img src="./images/6.png" class="card-img-top" alt="...">
                    </div>
                    <div class="col-md-6 d-flex align-items-center">
                        <div>
                            <h5 class="card-title text-danger">Combo FA</h5>
                            <p class="card-text">1 bắp, 1 pep nhỏ</p>
                            <p class="card-text">25.000 VND</p>
                            <a href="#" class="btn mt-auto btn-block gradient-background-btn" data-toggle="modal" data-target="#foodModal">Đặt Đồ Ăn</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <img src="./images/6.png" class="card-img-top" alt="...">
                    </div>
                    <div class="col-md-6 d-flex align-items-center">
                        <div>
                            <h5 class="card-title text-danger">Combo Khát Nước</h5>
                            <p class="card-text">2 bắp lớn</p>
                            <p class="card-text">40.000 VND</p>
                            <a href="#" class="btn mt-auto gradient-background-btn" data-toggle="modal" data-target="#foodModal">Đặt Đồ Ăn</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal đặt đồ ăn -->
    <div class="modal fade" id="foodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 container">
                            <img src="./images/6.png" class="card-img-top" alt="...">
                        </div>
                        <div class="col-md-6 order">
                            <div>
                                <h5 class="card-title text-danger">Combo Gia Đình</h5>
                                <p class="card-text">2 bắp, 4 pep nhỏ, 1 khoai lắc</p>
                                <p class="card-text">100.000 VND</p>
                                <label for="quantity">Số lượng:</label>
                                <input type="number" id="SoLuongMua" name="SoLuongMua" min="1" value="1">
                            </div>
                        </div>
                    </div>
                </div>
                <div id="payment" class="payment">
                    <div class="price">
                        <div class="row">
                            <div class="col-md-4 d-flex align-items-center">
                                <h6 class="title ">Phương thức thanh toán</h6>
                            </div>
                            <div class="form-group col-md-3 d-flex align-items-center">
                                <select id="paymentMethod" class="form-control">
                                    <option selected>ZaloPay</option>
                                    <option>Momo</option>
                                    <option>Momo</option>
                                    <option>Momo</option>
                                    <option>Momo</option>
                                </select>
                            </div>

                        </div>
                        <div>
                            <button type="button" class="btn btn-secondary">Thêm Voucher</button>
                        </div>
                        <div class="">
                            <p id="totalPrice">Thành tiền: .... VND</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection