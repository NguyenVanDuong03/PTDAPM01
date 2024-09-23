<?php

namespace App\Http\Controllers;

use App\Models\LichSuGiaDoAn;
use App\Models\DoAn;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LichSuGiaDoAnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lichsugiadoans = LichSuGiaDoAn::all()->sortByDesc('MaGiaDoAn');
        if (!Auth::check()) {
            return redirect()->route('home');
        } else {
            if (Auth::user()->VaiTro == 1) {
                return view('LichSuGiaDoAn.admin.index', compact('lichsugiadoans'));
            }
        }
    }

    public function create()
    {
        $doans = DoAn::all();
        $lichsugiadoans = LichSuGiaDoAn::all();
        if (Auth::user()->VaiTro == 1) {
            return view('LichSuGiaDoAn.admin.create', compact('lichsugiadoans', 'doans'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ThoiGianTao' => ['required'],
            'Gia' => ['required', 'numeric'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('mess_fail', 'Thêm không thành công. Vui lòng nhập đầy đủ thông tin');
        }
        LichSuGiaDoAn::create($request->all());
        return redirect()->route('lichsugiadoans.index')->with('mess_success', 'Thêm mới giá đồ ăn thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show($maGiaDoAn)
    {
        $lichsugiadoans = LichSuGiaDoAn::findOrFail($maGiaDoAn);
        if (Auth::user()->VaiTro == 1) {
            return view('LichSuGiaDoAn.admin.show', compact('lichsugiadoans'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LichSuGiaDoAn $lichsugiadoan)
    {
        $doans = DoAn::all();
        if (Auth::user()->VaiTro == 1) {
            return view('LichSuGiaDoAn.admin.edit', compact('doans', 'lichsugiadoan'));
        }
    }

    public function update(Request $request, LichSuGiaDoAn $lichsugiadoan)
    {
        $validator = Validator::make($request->all(), [
            'ThoiGianTao' => ['required'],
            'Gia' => ['required', 'numeric'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('mess_fail', 'Sửa không thành công. Vui lòng nhập đầy đủ thông tin');
        }
        $lichsugiadoan->update($request->all());
        return redirect()->route('lichsugiadoans.index')->with('mess_success', 'Cập nhật thông tin giá đồ ăn thành công.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($maGiaDoAn)
    {
        $lichsugiadoans = LichSuGiaDoAn::findOrFail($maGiaDoAn);
        $lichsugiadoans->delete();
        if (Auth::user()->VaiTro == 1) {
            return redirect()->route('lichsugiadoans.index')->with('mess_success', 'Xóa giá đồ ăn đã chọn thành công');
        }
    }
}
