<?php

namespace App\Http\Controllers;

use App\Models\PhongChieu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Spatie\Ignition\Contracts\Solution;

class PhongChieuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $phongchieus = PhongChieu::all();
        if (!Auth::check()) {
            return redirect()->route('home');
        } else {
            if (Auth::user()->VaiTro == 1) {
        return view('PhongChieu.admin.index', compact('phongchieus'));
            }
            if (Auth::user()->VaiTro == 3) {
                return view('PhongChieu.customer.index', compact('phongchieus'));
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->VaiTro == 1) {
        return view('PhongChieu.admin.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'SoLuongGhe' => ['required'],
            'TinhTrang' => ['required'],
        ], [
            'TenDoAn.required' => 'Tên đồ ăn không được bỏ trống',
            'TenDoAn.regex' => 'Vui lòng nhập đầy đủ thông tin',
            'Anh.required' => 'Vui lòng nhập đầy đủ thông tin',
            'Anh.max' => 'Kích thước file ảnh không quá 5MB',
            'TenDoAn.max' => 'Tên đồ ăn không quá 50 ký tự',
            'Gia.required' => 'Giá không được bỏ trống',
            'Gia.min' => 'Thêm không thành công. Vui lòng nhập đầy đủ thông tin',
            'Gia.max' => 'Giá không quá 1.000.000',
            'MaTheLoai.required' => 'Vui lòng nhập đầy đủ thông tin',
        ]);
        // if (DoAn::where('TenDoAn', $request->TenDoAn)->exists()) {
        //     $validator->errors()->add('TenDoAn', 'Tên đồ ăn đã tồn tại');
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // if ($request->input('MaTheLoai') === "none" || $request->input('TinhTrang') === "none") {
        //     // $validator->errors()->add('MaTheLoai', 'Vui lòng nhập đầy đủ thông tin');
        //     // return redirect()->back()->withErrors($validator)->withInput();
        //     return redirect()->back()->with('mess_fail', 'Vui lòng nhập đầy đủ thông tin');
        // }

 
        $validator = Validator::make($request->all(), [
            'SoLuongGhe' => ['required'],
            'TinhTrang' => ['required'],
            // 'TenPhong' => ['TenPhong'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('mess_fail', 'Vui lòng nhập đầy đủ thông tin');
        }


        PhongChieu::create([
            // 'TenPhong' => $request->input('TenPhong'),
            'SoLuongGhe' => $request->input('SoLuongGhe'),
            'TinhTrang' => $request->input('TinhTrang'),
        ]);
        return redirect()->route('phongchieus.index')->with('mess_success', 'Thêm thành công');
    }


    public function show(PhongChieu $phongChieu)
    {
        //
    }

    public function edit(PhongChieu $phongchieu)
    {
        //
        return view('PhongChieu.admin.edit', compact('phongchieu'));
    }


    public function update(Request $request, PhongChieu $phongchieu)
    {
      
        $validator = Validator::make($request->all(), [
            'SoLuongGhe' => ['required'],
            'TinhTrang' => ['required'],
            // 'TenPhong' => ['TenPhong'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('mess_fail', 'Vui lòng nhập đầy đủ thông tin');
        }

        $phongchieu->update($request->all());
        return redirect()->route('phongchieus.index')->with('mess_success', ' Sửa thành công');
    }

    public function destroy(PhongChieu $phongchieu, Request $request)
    {
        $phongchieu->delete();
        return redirect()->route('phongchieus.index')->with('mess_success', 'Xóa phòng chiếu thành công!');
    }
}
