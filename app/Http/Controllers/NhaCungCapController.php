<?php

namespace App\Http\Controllers;

use App\Models\NhaCungCap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NhaCungCapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nhacungcaps = NhaCungCap::orderBy('MaNCC', 'desc')->get();
        return view('NhaCungCap.admin.index', compact('nhacungcaps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('NhaCungCap.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'TenNCC' => ['required'],
            'TinhTrang' => ['required'],
            'QuocGia' => ['required'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('mess_fail', 'Thêm không thành công. Vui lòng nhập đầy đủ thông tin');
        }
        NhaCungCap::create([
            'TenNCC' => $request->input('TenNCC'),
            'TinhTrang' => $request->input('TinhTrang'),
            'QuocGia' => $request->input('QuocGia'),
        ]);

        return redirect()->route('nhacungcaps.index')->with('mess_success', 'Thêm mới thành công.');
    }

    public function edit($MaNCC)
    {
        $nhacungcap = NhaCungCap::find($MaNCC);
        return view('NhaCungCap.admin.edit', compact('nhacungcap'));
    }

    public function update(Request $request, $MaNCC)
    {
        $validator = Validator::make($request->all(), [
            'TenNCC' => ['required'],
            'TinhTrang' => ['required'],
            'QuocGia' => ['required'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('mess_fail', 'Thêm không thành công. Vui lòng nhập đầy đủ thông tin');
        }
        $nhacungcaps = NhaCungCap::find($MaNCC);
        $nhacungcaps->TenNCC = $request->input('TenNCC');
        $nhacungcaps->TinhTrang = $request->input('TinhTrang');
        $nhacungcaps->QuocGia = $request->input('QuocGia');
        $nhacungcaps->save();

        return redirect()->route('nhacungcaps.index')->with('mess_success', 'Chỉnh sửa thành công.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($MaNCC)
    {
        $nhacungcaps = NhaCungCap::findOrFail($MaNCC);
        $nhacungcaps->delete();
        return redirect()->route('nhacungcaps.index')->with('mess_success', 'Xoá thành công.');
    }
}
