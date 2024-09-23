<?php

namespace App\Http\Controllers;

use App\Models\KhachHang;
use App\Models\Phim;
use App\Models\NhanVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class KhachHangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // echo("jjj");
        $phimDangChieus = Phim::where('TrangThai', 'Đang chiếu')->get();
        $phimSapChieus = Phim::where('TrangThai', 'Sắp chiếu')->get();
        return view('khach-hang.home', compact('phimDangChieus', 'phimSapChieus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        //return view('khach-hang.create-nv');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(KhachHang $khachHang)
    {
        // view info of account
        $user = Auth::user();
        if($user != null && $user->VaiTro == 3){
            $account = KhachHang::where('TenDangNhapKH', $user->email)->first();
            return view('khach-hang.xem-tai-khoan', compact('account'));
        }
        echo 'Tài khoản không tồn tại';
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KhachHang $khachHang)
    {
        // view info of account
        $user = Auth::user();
        if($user != null && $user->VaiTro == 3){
            $account = KhachHang::where('TenDangNhapKH', $user->email)->first();
            return view('khach-hang.sua-tai-khoan', compact('account'));
        }
        echo 'Tài khoản không tồn tại';
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KhachHang $khachHang)
    {
        //
        $user = Auth::user();
        if($user != null && $user->VaiTro == 3){
            $account = KhachHang::where('TenDangNhapKH', $user->email)->first();
            $account->update([
                'TenKhachHang' => $request->input('TenKhachHang'),
                'NgaySinh' =>  $request->input('NgaySinh'),
                'GioiTinh' =>  $request->input('GioiTinh'),
                'SDT' =>  $request->input('SDT'),
            ]);
            Session::put('SuaTaiKhoan', 'Chỉnh sửa tài khoản thành công!');
            return redirect()->route('home');
        }
        echo 'Tài khoản không tồn tại';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KhachHang $khachHang)
    {
        //
    }
}
