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
            'SoLuongGhe' => ['required', 'numeric', 'max:999'],
            'TinhTrang' => ['required'],
        ], [
            // 'SoLuongGhe.min' => 'Thêm không thành công. Vui lòng nhập đầy đủ thông tin',
            'SoLuongGhe.max' => 'Vui lòng nhập lại số lượng ghế',
            'SoLuongGhe.required' => 'Số lượng ghế không được bỏ trống',
            'TinhTrang.required' => 'Vui lòng nhập đầy đủ thông tin',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // if ($request->input('TinhTrang') === "none") {
        //     return redirect()->back()->with('mess_fail', 'Vui lòng nhập đầy đủ thông tin');
        // }


        PhongChieu::create([
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
        if (Auth::user()->VaiTro == 1) {
            return redirect()->route('phongchieus.index')->with('mess_success', 'Xóa thành công!');
        } else {
            return redirect()->route('home');
        }
    }
}
