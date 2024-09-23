<?php

namespace App\Http\Controllers;

use App\Models\NhanVien;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vouchers = Voucher::all();
        if (!Auth::check()) {
            return redirect()->route('home');
        } else {
            if (Auth::user()->VaiTro == 1) {
                return view('Voucher.admin.index', compact('vouchers'));
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nhanviens = NhanVien::all();
        if (Auth::user()->VaiTro == 1) {
            return view('Voucher.admin.create', compact('nhanviens'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'TiLeChietKhau' => ['required','numeric', 'min:0', 'max:0.5'],
            'HanMuc' => ['required', 'numeric', 'min:0'],
            'NgayTao' => ['required'],
            'TenDangNhapNV' => ['required', Rule::exists('nhan_viens', 'TenDangNhapNV')],
            'TinhTrang' => ['required'],
            'HanDung' => ['required'],
        ], [
            'TiLeChietKhau.required' => 'Tỷ lệ chiết khấu không được bỏ trống',
            'TiLeChietKhau.min' => 'Tỷ lệ chiết khấu không bé hơn 0',
            'TiLeChietKhau.max' => 'Tỷ lệ chiết khấu không lớn hơn 0.5',
            'HanMuc.min' => 'Hạn mức không bé hơn 0',
            'HanMuc.required' => 'Hạn mức không được bỏ trống',
            'NgayTao.required' => 'Ngày tạo không được bỏ trống',
            'TinhTrang.required' => 'Tình trạng không được bỏ trống',
            'HanDung.required' => '',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // if ($validator->fails()) {
        //     return redirect()->back()->with('mess_fail', 'Vui lòng nhập đầy đủ thông tin');
        // }
        Voucher::create($request->all());
        return redirect()->route('vouchers.index')->with('mess_success', 'Thêm thành công');
    }


    /**
     * Display the specified resource.
     */
    public function show(Voucher $voucher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Voucher $voucher)
    {
        $nhanviens = NhanVien::all();
        return view('Voucher.admin.edit', compact('nhanviens', 'voucher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Voucher $voucher)
    {
        $validator = Validator::make($request->all(), [
            'TiLeChietKhau' => ['required', 'numeric'],
            'HanMuc' => ['required', 'numeric'],
            'NgayTao' => ['required'],
            'TenDangNhapNV' => ['required', Rule::exists('nhan_viens', 'TenDangNhapNV')],
            'TinhTrang' => ['required'],
            'HanDung' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('mess_fail', 'Vui lòng nhập đầy đủ thông tin');
        }
        $voucher->update($request->all());
        return redirect()->route('vouchers.index')->with('mess_success', 'Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voucher $voucher)
    {
        $voucher->delete();
        return redirect()->route('vouchers.index')->with('mess_success', 'Xóa thành công');
    }
}
