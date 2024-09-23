<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiDoAn;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Event\TestSuite\Loaded;

class LoaiDoAnConTroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loaidoans = LoaiDoAn::all();
        if (!Auth::check()) {
            return redirect()->route('home');
        } else {
            if (Auth::user()->VaiTro == 1) {
                return view('LoaiDoAn.admin.index', compact('loaidoans'));
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->VaiTro == 1) {
            return view('LoaiDoAn.admin.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'TenTheLoai' => ['required'],
            'MoTa' => ['required'],
        ], [
            'TenTheLoai.required' => 'Tên thể loại không được bỏ trống',
            'MoTa.required' => 'Mô tả không được bỏ trống',

        ]);
        if (LoaiDoAn::where('TenLoaiDoAn', $request->TenDoAn)->exists()) {
            $validator->errors()->add('TenTheLoai', 'Tên loại đồ ăn đã tồn tại');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // if ($validator->fails()) {
        //     return redirect()->back()->with('mess_fail', 'Vui lòng nhập đầy đủ thông tin');
        // }
        LoaiDoAn::create($request->all());
        return redirect()->route('loaidoans.index')->with('mess_success', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show($maLoaiDoAn)
    {
        $loaidoans = LoaiDoAn::findOrFail($maLoaiDoAn);
        if (Auth::user()->VaiTro == 1) {
            return view('LoaiDoAn.admin.show', compact('loaidoans'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($maLoaiDoAn)
    {
        $loaidoan = LoaiDoAn::find($maLoaiDoAn);
        if (Auth::user()->VaiTro == 1) {
            return view('LoaiDoAn.admin.edit', compact('loaidoan'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $loaidoan)
    {
        $validator = Validator::make($request->all(), [
            'TenTheLoai' => ['required'],
            'MoTa' => ['required'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('mess_fail', 'Vui lòng nhập đầy đủ thông tin');
        }
        // $loaidoan = $request->input('loaidoan');
        $loaidoan = LoaiDoAn::where('MaTheLoai', $loaidoan)->first();
        // echo($loaidoan->MaTheLoai);
        $loaidoan->update($request->all());
        return redirect()->route('loaidoans.index')->with('mess_success', 'Sửa thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($maLoaiDoAn)
    {
        $loaidoans = LoaiDoAn::findOrFail($maLoaiDoAn);
        $loaidoans->delete();
        if (Auth::user()->VaiTro == 1) {
            return redirect()->route('loaidoans.index')->with('mess_success', 'Xóa thành công!');
        }
    }
}
