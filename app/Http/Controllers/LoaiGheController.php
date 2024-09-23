<?php

namespace App\Http\Controllers;

use App\Models\LichSuGiaVe;
use App\Models\LoaiGhe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoaiGheController extends Controller
{
    /**
     */
    public function index()
    {
        $loaighes = LoaiGhe::orderBy('MaLoaiGhe', 'desc')->get();
        return view('LoaiGhe.admin.index', compact('loaighes'));
        // if (Auth::user()->role == 1) {
        //     return view('LoaiGhe.admin.index', compact('loaighes'));
        // }
        // if (Auth::user()->role == 2) {
        //     return view('LoaiGhe.employees.index', compact('loaighes'));
        // }
        // if (Auth::user()->role == 3) {
        //     return view('LoaiGhe.customer.index', compact('loaighes'));
        // }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('LoaiGhe.admin.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'TenLoaiGhe' => ['required'],
            'GiaVe' => ['required', 'numeric'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('mess_fail', 'Thêm không thành công. Vui lòng nhập đầy đủ thông tin');
        }
        $tenLoaiGhe = $request->input('TenLoaiGhe');
        if (LoaiGhe::where('TenLoaiGhe', $tenLoaiGhe)->exists()) {
            return redirect()->back()->with('mess_fail', 'Thể loại ghế đã tồn tại');
        }
        $loaighe = new LoaiGhe();
        $loaighe->TenLoaiGhe = $request->TenLoaiGhe;
        $loaighe->GiaVe = $request->GiaVe;
        $loaighe->save();
        $lichSuGiaVe = new LichSuGiaVe();
        $lichSuGiaVe->MaLoaiGhe = $loaighe->MaLoaiGhe;
        $lichSuGiaVe->GiaVe = $loaighe->GiaVe;
        $lichSuGiaVe->ThoiGianTao = now(); // Lấy ngày hiện tại
        $lichSuGiaVe->save();
        return redirect()->route('loaighes.index')->with('mess_success', 'Thêm mới thành công');
    }

    public function edit($MaLoaiGhe)
    {
        $loaighe = LoaiGhe::find($MaLoaiGhe);
        return view('LoaiGhe.admin.edit', compact('loaighe'));
    }

    public function update(Request $request, $MaLoaiGhe)
    {
        $validator = Validator::make($request->all(), [
            'TenLoaiGhe' => ['required'],
            'GiaVe' => ['required', 'numeric'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('mess_fail', 'Chỉnh sửa không thành công. Vui lòng nhập đầy đủ thông tin');
        }
        $tenLoaiGhe = $request->input('TenLoaiGhe');

        $existingLoaiGhe = LoaiGhe::where('TenLoaiGhe', $tenLoaiGhe)
            ->where('MaLoaiGhe', '!=', $MaLoaiGhe)
            ->exists();

        if ($existingLoaiGhe) {
            return redirect()->back()->with('mess_fail', 'Thể loại ghế đã tồn tại!');
        }
        $loaighe = LoaiGhe::find($MaLoaiGhe);
        $loaighe->TenLoaiGhe = $request->input('TenLoaiGhe');
        $loaighe->GiaVe = $request->input('GiaVe');
        $lichSuGiaVe = new LichSuGiaVe();
        $lichSuGiaVe->MaLoaiGhe = $loaighe->MaLoaiGhe;
        $lichSuGiaVe->GiaVe = $loaighe->GiaVe;
        $lichSuGiaVe->ThoiGianTao = now(); // Lấy ngày hiện tại
        $lichSuGiaVe->save();
        return redirect()->route('loaighes.index')->with('mess_success', 'Cập nhật thành công!');
    }
    public function destroy($MaLoaiGhe)
    {
        $loaighes = LoaiGhe::findOrFail($MaLoaiGhe);
        $loaighes->delete();
        return redirect()->route('loaighes.index')->with('mess_success', 'Xóa thành công!');
    }
}
