<?php

use App\Http\Controllers\NhaCungCapController;
use App\Http\Controllers\PhimController;
use App\Http\Controllers\TheLoaiController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DatVeController;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\VnPayController;

use App\Http\Controllers\DoAnController;
use App\Http\Controllers\GheNgoiController;
use App\Http\Controllers\LichChieuController;
use App\Http\Controllers\LichSuGiaDoAnController;
use App\Http\Controllers\LichSuGiaVeController;
use App\Http\Controllers\LoaiDoAnConTroller;
use App\Http\Controllers\LoaiGheController;
use App\Http\Controllers\PhongChieuController;
use App\Http\Controllers\QuyDinhController;
use App\Http\Controllers\ThongKeController;
use App\Http\Controllers\TinTucController;
use App\Http\Controllers\VangLaiController;
use App\Http\Controllers\VoucherController;


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//Route cho branch NgocHuy_B
Route::resource('phongchieus', PhongChieuController::class);
Route::resource('tintucs', TinTucController::class);
Route::resource('vouchers', VoucherController::class);
Route::resource('nhanviens', NhanVienController::class);
Route::resource('thongkes', ThongKeController::class);

//
Route::resource('doans', DoAnController::class);
Route::resource('loaidoans', LoaiDoAnConTroller::class);
Route::resource('lichsugiadoans', LichSuGiaDoAnController::class);
// route phần của Phong



Route::controller(AuthController::class)->group(function () {

    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
    Route::get('/change-info', 'changeInfo')->name('change-info');
    Route::post('/store-info-change', 'storeInfoChange')->name('store-info-change');
});
//route quên mật khẩu
Route::get('/nhapemail', [AuthController::class, 'nhapEmail'])->name('qmk.nhapEmail');
Route::post('/nhapotp', [AuthController::class, 'nhapOTP'])->name('qmk.nhapOTP');
Route::post('/nhapmkmoi', [AuthController::class, 'nhapMatKhauMoi'])->name('qmk.nhapMatKhauMoi');
// nhập thành công mật khẩu mới thì hiển thị dialog đổi thành công và có route quay về login
//

Route::get('/admin', [AdminController::class, 'index'])->name('admin.home')->middleware('admin');
Route::get('/customer', [KhachHangController::class, 'index'])->name('customer.home')->middleware('customer');
Route::get('/employee', [NhanVienController::class, 'home'])->name('employee.home')->middleware('employee');
Route::get('/vanglai', [VangLaiController::class, 'home'])->name('vanglais.home');
Route::get('/home', [AuthController::class, 'home'])->name('home');
Route::get('/', [AuthController::class, 'home'])->name('home');
Route::get('/thongtintaikhoan', [KhachHangController::class, 'show'])->name('khachhangs.show');
Route::get('/chinhsuathongtin', [KhachHangController::class, 'edit'])->name('khachhangs.edit');
Route::post('/', [KhachHangController::class, 'update'])->name('khachhangs.update');
//Cổng thanh toán VNPay
Route::post('/vnpay_payment', [VnPayController::class, 'vnpay_payment'])->name('vnpay_payment');


Route::post('/searchnv', [NhanVienController::class, 'search'])->name('nhanviens.search')->middleware('admin');;
// Route::resource('nhanviens', NhanVienController::class)->middleware('admin');
// hết phần của Phong
// module A
Route::resource('phims', PhimController::class);
Route::post('/phims/check-duplicate', [PhimController::class, 'checkDuplicate'])->name('phims.checkDuplicate');
Route::resource('theloais', TheLoaiController::class);
Route::resource('nhacungcaps', NhaCungCapController::class);
// hết module A
//Module C
Route::resource('ghengois', GheNgoiController::class);
Route::resource('loaighes', LoaiGheController::class);
Route::resource('lichsugiaves', LichSuGiaVeController::class);


// route dat-ve
Route::post('/datve', [DatVeController::class, 'test'])->name('datve');
Route::get('/test', [DatVeController::class, 'index'])->name('datves.index');
Route::get('/datve/chonthoigian', [DatVeController::class, 'hienThoiGian'])->name('datves.hienThoiGian');
Route::get('/datve/chonphong', [DatVeController::class, 'hienThongTinPhong'])->name('datves.hienThongTinPhong');
Route::post('/datve/doan', [DatVeController::class, 'hienThiDoAn'])->name('datves.hienThiDoAn');
Route::post('/datve/thanhtoan', [DatVeController::class, 'chonHinhThucThanhToan'])->name('datves.chonHinhThucThanhToan');
Route::get('/datve/thanhtoan', [DatVeController::class, 'chonHinhThucThanhToan'])->name('datves.chonHinhThucThanhToan');
Route::get('/datve/hoanthanh', [DatVeController::class, 'taoHoaDon'])->name('datves.taoHoaDon');
Route::get('/xuatve', [DatVeController::class, 'xuatVe'])->name('datves.xuatVe');
Route::post('/xuatvexong', [DatVeController::class, 'xuatVeXong'])->name('datves.xuatVeXong');
Route::post('/thanhtoanonline', [DatVeController::class, 'thanhToanOnline'])->name('datves.thanhToanOnline');

Route::get('/admindv', [AdminController::class, 'datVe'])->name('admin.datVe');
// route lich-chieu
Route::resource('lichchieus', LichChieuController::class)->middleware('admin');
// ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
// Route::post('/lichchieus/edit', [LichChieuController::class, 'edit'])->name('lichchieus.edit_'); // chức năng edit
// Route::post('/lichchieus/edit_', [LichChieuController::class, 'edit__'])->name('lichchieus.edit__');
Route::post('/lichchieus/create/form', [LichChieuController::class, 'create_form'])->name('lichchieus.create_form')->middleware('admin');
Route::get('/lichchieus/create/form', [LichChieuController::class, 'create_form'])->name('lichchieus.create_form')->middleware('admin');
// Route::put('/lichchieus_updatecustom', [LichChieuController::class, 'updatecustom'])->name('lichchieus.updatecustom');

Route::resource('quydinhs', QuyDinhController::class);
